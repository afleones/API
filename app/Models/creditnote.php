<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class creditnote extends Model
{
    use HasFactory;

    protected $connection = 'maite';
    protected $table = 'nc_orden'; // as creditnotes';

    public static function obtenerConsecutivo($condicion)
    {
        $consecutivo = self::where($condicion)->max('order_id');
        return $consecutivo + 1;
    }
}
