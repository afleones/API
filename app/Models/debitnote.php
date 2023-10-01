<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class debitnote extends Model
{
    use HasFactory;

    protected $connection = 'maite';
    protected $table = 'nd_orden as debitnotes';
}
