<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class putsendmaite extends Model
{
    use HasFactory;
    protected $connection = 'maite';
    
    protected $table_customer = 'factura_clientes';
    protected $table_register = 'factura_companies';
    protected $table_detalle = 'factura_orden_producto';
    protected $table = 'factura_orden';
}
