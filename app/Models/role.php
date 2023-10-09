<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $connection = 'maite';
    protected $table = 'roles';

    public function users()
    {
        return $this->belongsToMany(Users::class);
    }

}
