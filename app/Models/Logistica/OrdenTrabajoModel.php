<?php

namespace App\Models\Logistica;

use CodeIgniter\Model;

class OrdenTrabajoModel extends Model
{
    protected $table            = 'orden_trabajo';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['codigo', 'necesidad', 'area_responsable', 'aprobado_por', 'actividad', 'descripcion', 'requerido_a', 'responsable', 'tiempo_eje'];

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

    protected function generarCodigo(array $data) {
        // Si el campo ya viene seteado, no lo modificamos
        if (isset($data['data']['codigo']) && !empty($data['data']['codigo'])) {
            return $data;
        }

        // Obtener el último código de orden de compra
        $lastRecord = $this->orderBy('codigo', 'DESC')->first();
        
        // Obtener el año actual
        $currentYear = date('Y');
        
        // Si no hay registros previos, empezamos con OT-YYYY-0001
        if (empty($lastRecord)) {
            $newCode = "OT-{$currentYear}-0001";
        } else {
            // Extraer el número del último código
            preg_match('/OT-([0-9]{4})-([0-9]{4})/', $lastRecord['codigo'], $matches);
            if (isset($matches[2])) {
                $lastNumber = intval($matches[2]);
                $newNumber = $lastNumber + 1;
                $newCode = sprintf("OC-%s-%04d", $currentYear, $newNumber);
            } else {
                // Si el formato no coincide, empezamos desde 0001
                $newCode = "OC-{$currentYear}-0001";
            }
        }
        
        // Asignar el nuevo código al data
        $data['data']['codigo'] = $newCode;
        return $data;
    }
}
