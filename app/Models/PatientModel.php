<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class PatientModel extends Model
{
    protected $table            = 'pacientes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'cod_paciente', 'tip_paciente', 'financia_protesis', 'entidad_financiera', 'contacto_financiera', 'telefono_financiera', 'nombre_hospital', 'mayor_edad', 'nombres_apoderado', 'apellidos_apoderado', 'dni_apoderado', 'vinculo_apoderado', 'presenta_ampu', 'nombres', 'apellidos', 'dni', 'genero', 'edad', 'contacto', 'fecha_nacimiento', 'direccion', 'sede', 'nacionalidad', 'email', 'vendedor', 'otro_contacto', 'nombre_contacto', 'canal', 'usa_protesis', 'enfermedad', 'time_ampu', 'expectativa', 'motivo_amputacion', 'observaciones'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateUUID', 'generateCode'];

    protected function generateUUID(array $data)
    {
        $data['data']['id'] = Uuid::uuid4()->toString();
        return $data;
    }

    protected function generateCode(array $data)
    {
        // Si el campo ya viene seteado, no lo modificamos
        if (isset($data['data']['cod_paciente']) && !empty($data['data']['cod_paciente'])) {
            return $data;
        }

        // Obtenemos el último registro según cod_paciente
        $lastRecord = $this->orderBy('cod_paciente', 'DESC')->first();

        if ($lastRecord && isset($lastRecord['cod_paciente'])) {
            // Quitamos el prefijo "P" y convertimos a entero el valor numérico
            $lastNumber = intval(substr($lastRecord['cod_paciente'], 1));
            $newNumber  = $lastNumber + 1;
        } else {
            // Si no existe ningún registro, iniciamos en 1
            $newNumber = 1;
        }

        // Formateamos el nuevo código con prefijo "P" y rellenamos con ceros hasta 5 dígitos
        $data['data']['cod_paciente'] = 'P' . str_pad($newNumber, 5, "0", STR_PAD_LEFT);

        return $data;
    }
}
