<?php

namespace App\Models\Production;

use CodeIgniter\Model;

class ProductionsOrdersItemsUnidModel extends Model
{
    protected $table            = 'production_orders_items_unidades';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['production_order_item_id', 'numero_serie_production', 'especificaciones'];

    protected bool $allowEmptyInserts = false;

    public function getLastSerialIndexByProduct(int $productId): int
    {
        $builder = $this->select("MAX(CAST(RIGHT(production_orders_items_unidades.numero_serie_production, 3) AS UNSIGNED)) AS last")
            ->join('production_orders_items i', 'i.id = production_orders_items_unidades.production_order_item_id', 'left')
            ->where('i.production_producto_id', $productId)
            ->get();

        $row = $builder->getRow();
        return $row ? (int)$row->last : 0;
    }

    public function generateNextSerialsByProduct(int $productId, int $quantity): array
    {
        // 1) Obtengo el prefijo desde production_products
        $prod = $this->db->table('production_products')
            ->select('codigo')
            ->where('id', $productId)
            ->get()
            ->getRow();
        if (! $prod) {
            throw new \RuntimeException("Producto {$productId} no encontrado.");
        }
        $prefix = $prod->codigo;

        // 2) Calculo el último índice usado
        $lastIndex = $this->getLastSerialIndexByProduct($productId);
        $year      = date('Y');
        $serials   = [];

        // 3) Genero la secuencia COD-AÑO-NNNN
        for ($i = 1; $i <= $quantity; $i++) {
            $num    = $lastIndex + $i;
            $suffix = str_pad($num, 4, '0', STR_PAD_LEFT);
            $serials[] = "{$prefix}-{$year}-{$suffix}";
        }

        return $serials;
    }
}
