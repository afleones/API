<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accounts extends Model
{
    protected $fillable = [
        'dbprefix',
        'codename',
        'dbsufix',
        'id_plans',    
    ];
}
    