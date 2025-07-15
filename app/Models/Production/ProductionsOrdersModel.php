<?php

namespace App\Models\Production;

use CodeIgniter\Model;

class ProductionsOrdersModel extends Model
{
    protected $table            = 'production_orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['codigo', 'tip_orden', 'paciente_id', 'nombre_externo', 'area_respon', 'fecha_solicitud', 'fecha_entrega', 'notas', 'estado'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generarCodigo'];
    protected $beforeUpdate   = ['verificarEstadoAtrasado'];

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
            $newCode = "ORQ-{$currentYear}-0001";
        } else {
            // Extraer el número del último código
            preg_match('/ORQ-([0-9]{4})-([0-9]{4})/', $lastRecord['codigo'], $matches);
            if (isset($matches[2])) {
                $lastNumber = intval($matches[2]);
                $newNumber = $lastNumber + 1;
                $newCode = sprintf("ORQ-%s-%04d", $currentYear, $newNumber);
            } else {
                // Si el formato no coincide, empezamos desde 0001
                $newCode = "ORQ-{$currentYear}-0001";
            }
        }

        $data['data']['codigo'] = $newCode;
        return $data;
    }

    /**
     * Verifica si una orden está atrasada y actualiza su estado si es necesario
     * @param array $data Datos de la orden
     * @return array Datos actualizados
     */
    protected function verificarEstadoAtrasado(array $data)
    {
        $id = $data['id'];
        $order = $this->find($id);
        
        if (!$order) {
            return $data;
        }

        // Si el estado ya es 'terminado' o 'atrasado', no hacemos nada
        if ($order['estado'] === 'terminado' || $order['estado'] === 'atrasado') {
            return $data;
        }

        // Convertir las fechas a objetos DateTime para comparar
        $fechaEntrega = new \DateTime($order['fecha_entrega']);
        $fechaActual = new \DateTime();

        // Si la fecha de entrega es menor que la fecha actual y el estado no es 'terminado'
        if ($fechaEntrega < $fechaActual) {
            // Actualizamos el estado a 'atrasado'
            $data['data']['estado'] = 'atrasado';
        }

        return $data;
    }
}
