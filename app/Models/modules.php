<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modules extends Model
{
    use HasFactory;

    protected $connection = 'master';

    public function items()
    {
        return $this->hasMany(Menu::class, 'id_module');
    }
}
