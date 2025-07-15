<?php

namespace App\Models\Inventory;

use CodeIgniter\Model;

class TrasladosModel extends Model
{
    protected $table            = 'inventory_traslados';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'codigo',
        'requirement_id',
        'sede_origen',
        'sede_destino',
        'detalles',
        'estado',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generarCodigo'];

    protected function generarCodigo(array $data)
    {
        // Si el campo ya viene seteado, no lo modificamos
        if (isset($data['data']['codigo']) && !empty($data['data']['codigo'])) {
            return $data;
        }

        // Obtener el último código de orden de compra
        $lastRecord = $this->orderBy('codigo', 'DESC')->first();

        // Obtener el año actual
        $currentYear = date('Y');

        // Si no hay registros previos, empezamos con ORQ-YYYY-0001
        if (empty($lastRecord)) {
            $newCode = "TRAS-{$currentYear}-0001";
        } else {
            // Extraer el número del último código
            preg_match('/TRAS-([0-9]{4})-([0-9]{4})/', $lastRecord['codigo'], $matches);
            if (isset($matches[2])) {
                $lastNumber = intval($matches[2]);
                $newNumber = $lastNumber + 1;
                $newCode = sprintf("TRAS-%s-%04d", $currentYear, $newNumber);
            } else {
                // Si el formato no coincide, empezamos desde 0001
                $newCode = "TRAS-{$currentYear}-0001";
            }
        }

        $data['data']['codigo'] = $newCode;
        return $data;
    }
}
