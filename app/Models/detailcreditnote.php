<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailcreditnote extends Model
{
    use HasFactory;

    protected $connection = 'maite';
    protected $table = 'nc_orden_producto'; //as maitees';

    protected $fillable = [
        'order_id',
        'item_code',
        'order_receiver_name',
        'order_date',
        'order_date',
        'order_total_after_tax',
        'order_total_after_tax',
        'order_total_after_tax',
        'status',
        
        ];
}
