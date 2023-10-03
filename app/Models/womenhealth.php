<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class womenhealth extends Model
{
    use HasFactory;

    protected $connection = 'maite';
    protected $table = 'womenhealth';
}