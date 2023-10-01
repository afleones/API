<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registercompany extends Model
{
    use HasFactory;

    protected $connection = 'maite';
    protected $table_customer = 'factura_clientes';
    protected $table = 'factura_companies';
}
