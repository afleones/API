<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_enterprises extends Model
{
    //use HasFactory;
    protected $fillable = [
        'id_users',
        'id_enterprises',
        'state',
    ];
}
