<?php

namespace App\Models\Inventory;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $table            = 'inventory';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['product_id', 'sede_id', 'stock'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Incrementa el stock de un producto en una sede específica
     * @param int $productId ID del producto
     * @param int $sedeId ID de la sede
     * @param int $quantity Cantidad a incrementar
     * @return bool
     */
    public function incrementStock(int $productId, int $sedeId, int $quantity): bool
    {
        try {
            $stockRow = $this->where('product_id', $productId)
                ->where('sede_id', $sedeId)
                ->first();

            if ($stockRow) {
                // Actualizar stock existente
                $newStock = $stockRow['stock'] + $quantity;
                return $this->update($stockRow['id'], ['stock' => $newStock]);
            } else {
                // Crear nuevo registro de inventario
                return $this->insert([
                    'product_id' => $productId,
                    'sede_id' => $sedeId,
                    'stock' => $quantity,
                ]) !== false;
            }
        } catch (\Exception $e) {
            log_message('error', 'Error incrementStock(): ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Decrementa el stock de un producto en una sede específica
     * @param int $productId ID del producto
     * @param int $sedeId ID de la sede
     * @param int $quantity Cantidad a decrementar
     * @return bool
     */
    public function decrementStock(int $productId, int $sedeId, int $quantity): bool
    {
        try {
            $stockRow = $this->where('product_id', $productId)
                ->where('sede_id', $sedeId)
                ->first();

            if (!$stockRow) {
                log_message('error', "No existe inventario para producto {$productId} en sede {$sedeId}");
                return false;
            }

            // Calcular nuevo stock (no permitir negativos)
            $newStock = max(0, $stockRow['stock'] - $quantity);

            return $this->update($stockRow['id'], ['stock' => $newStock]);
        } catch (\Exception $e) {
            log_message('error', 'Error decrementStock(): ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Transfiere stock de una sede a otra
     * @param int $productId ID del producto
     * @param int $sedeOrigenId ID de la sede origen
     * @param int $sedeDestinoId ID de la sede destino
     * @param int $quantity Cantidad a transferir
     * @return bool
     */
    public function transferStock(int $productId, int $sedeOrigenId, int $sedeDestinoId, int $quantity): bool
    {
        try {
            // Verificar stock disponible en origen
            $stockOrigen = $this->where('product_id', $productId)
                ->where('sede_id', $sedeOrigenId)
                ->first();

            if (!$stockOrigen || $stockOrigen['stock'] < $quantity) {
                log_message('error', "Stock insuficiente en sede origen {$sedeOrigenId} para producto {$productId}");
                return false;
            }

            // Decrementar en origen
            if (!$this->decrementStock($productId, $sedeOrigenId, $quantity)) {
                return false;
            }

            // Incrementar en destino
            if (!$this->incrementStock($productId, $sedeDestinoId, $quantity)) {
                // Revertir cambios en origen si falla el destino
                $this->incrementStock($productId, $sedeOrigenId, $quantity);
                return false;
            }

            return true;
        } catch (\Exception $e) {
            log_message('error', 'Error transferStock(): ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtiene el stock actual de un producto en una sede
     * @param int $productId ID del producto
     * @param int $sedeId ID de la sede
     * @return int Stock actual (0 si no existe)
     */
    public function getStock(int $productId, int $sedeId): int
    {
        $stockRow = $this->where('product_id', $productId)
            ->where('sede_id', $sedeId)
            ->first();

        return $stockRow ? (int)$stockRow['stock'] : 0;
    }

    /**
     * Verifica si hay suficiente stock para una operación
     * @param int $productId ID del producto
     * @param int $sedeId ID de la sede
     * @param int $requiredQuantity Cantidad requerida
     * @return bool
     */
    public function hasEnoughStock(int $productId, int $sedeId, int $requiredQuantity): bool
    {
        $currentStock = $this->getStock($productId, $sedeId);
        return $currentStock >= $requiredQuantity;
    }

    /**
     * Actualiza múltiples productos en una sola transacción
     * @param array $updates Array de actualizaciones ['product_id' => X, 'sede_id' => Y, 'quantity' => Z, 'operation' => 'increment/decrement']
     * @return bool
     */
    public function batchUpdateStock(array $updates): bool
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            foreach ($updates as $update) {
                $productId = $update['product_id'];
                $sedeId = $update['sede_id'];
                $quantity = $update['quantity'];
                $operation = $update['operation'];

                switch ($operation) {
                    case 'increment':
                        if (!$this->incrementStock($productId, $sedeId, $quantity)) {
                            throw new \RuntimeException("Error al incrementar stock para producto {$productId}");
                        }
                        break;
                    case 'decrement':
                        if (!$this->decrementStock($productId, $sedeId, $quantity)) {
                            throw new \RuntimeException("Error al decrementar stock para producto {$productId}");
                        }
                        break;
                    default:
                        throw new \RuntimeException("Operación no válida: {$operation}");
                }
            }

            $db->transComplete();
            return $db->transStatus();
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Error batchUpdateStock(): ' . $e->getMessage());
            return false;
        }
    }
}
