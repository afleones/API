<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class livingplaceCompleted extends Model
{
    use HasFactory;

    protected $connection = 'maite';
    protected $table = 'view_livingplace_completed';
}
