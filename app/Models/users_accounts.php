<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_accounts extends Model
{
    use HasFactory;

    protected $connection = 'maite';
    protected $table = 'users';
}
