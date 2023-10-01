<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maite extends Model
{
    use HasFactory;


    protected $connection = 'maite';
    protected $table = 'factura_orden'; //as maitees';

    protected $fillable = [
        'order_id',
        'order_receiver_name',
        'order_date',
        'order_date',
        'order_total_after_tax',
        'order_total_after_tax',
        'order_total_after_tax',
        'status',
        
        ];

    public static function obtenerConsecutivo($condicion)
    {
        $consecutivo = self::where($condicion)->max('order_id');
        return $consecutivo + 1;
    }

}