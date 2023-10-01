<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    protected $connection = 'master';

    public function items()
    {
        return $this->hasMany(items::class, 'id_menu');
    }
}
