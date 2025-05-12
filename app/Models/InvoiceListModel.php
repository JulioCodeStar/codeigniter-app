<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceListModel extends Model
{
    protected $table            = 'cotizaciones_list';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'id', 'cotizacion_id', 'title', 'descripcion', 'cantidad' ];
}



?>