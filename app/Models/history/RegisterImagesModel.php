<?php

namespace App\Models\History;

use CodeIgniter\Model;

class RegisterImagesModel extends Model
{
    protected $table            = 'history_register_images';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['history_register_process_id', 'ruta_imagen'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
}
