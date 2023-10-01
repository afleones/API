<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documentsupport extends Model
{
    use HasFactory;

    protected $connection = 'maite';
    protected $table = 'ds_orden as documentsupports';
}
