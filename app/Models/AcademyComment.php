<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademyComment extends Model
{
    use HasFactory;

    protected $connection = 'academy';
    protected $table = 'Comment';
}
    