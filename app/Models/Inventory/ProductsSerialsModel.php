<?php

namespace App\Models\Inventory;

use CodeIgniter\Model;

class ProductsSerialsModel extends Model
{
    protected $table            = 'inventory_products_serials';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'inventory_product_id',
        'serial',
        'estado',
        'sede_id',
        'inventory_entries_details_id',
        'inventory_exits_details_id',
        'inventory_entries_details_id_dest'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

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
     * Genera $quantity seriales nuevos para $productId,
     * con formato COD-AÑO-0001, 0002, … continuando la secuencia.
     *
     * @param int $productId
     * @param int $quantity
     * @return string[]
     */
    public function generateSerials(int $productId, int $quantity): array
    {
        // 1) Buscamos el mayor sufijo existente
        $builder = $this->db->table($this->table);
        $row = $builder
            ->select('MAX(CAST(RIGHT(serial,4) AS UNSIGNED)) AS max_seq')
            ->where('inventory_product_id', $productId)
            ->get()
            ->getRow();

        $lastSeq = (int) ($row->max_seq ?? 0);

        // 2) Obtenemos el producto
        $productModel = model('App\Models\Inventory\ProductsModel');
        $product      = $productModel->find($productId);

        if (empty($product)) {
            // Manejo de error: producto no existe
            throw new \InvalidArgumentException(
                "No se encontró ningún producto con el ID {$productId}."
            );
        }

        // 3) Extraemos el campo 'codigo'
        // A veces tu modelo devuelve entidad, a veces array; probamos ambos
        $code = is_array($product)
            ? ($product['codigo']  ?? null)
            : ($product->codigo    ?? null);

        if (empty($code)) {
            throw new \RuntimeException(
                "El producto con ID {$productId} no tiene un código válido."
            );
        }

        $year = date('y');

        // 4) Generamos la nueva secuencia
        $newSerials = [];
        for ($i = 1; $i <= $quantity; $i++) {
            $seq  = str_pad($lastSeq + $i, 4, '0', STR_PAD_LEFT);
            $newSerials[] = "{$code}-{$year}-{$seq}";
        }

        return $newSerials;
    }
}
