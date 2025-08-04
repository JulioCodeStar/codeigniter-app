<?php

namespace App\Models\History;

use CodeIgniter\Model;

class RegisterProcessModel extends Model
{
    protected $table            = 'history_register_process';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['history_patient_process_id', 'fecha_register', 'evaluacion', 'diagnostico', 'pruebas_encaje', 'observaciones', 'tecnico'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
