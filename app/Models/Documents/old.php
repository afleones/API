<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class old extends Model
{
    use HasFactory;

    protected $connection = 'maite';
    protected $table = 'old';
}
