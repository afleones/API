<?php

namespace App\Models\AutoSchedule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $connection = 'maite_sai';
    protected $table = 'gxmedicos';
}
