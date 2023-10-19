<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademyStudent extends Model
{
    use HasFactory;

    protected $connection = 'academy';
    protected $table = 'Category_Course_Class_Student';
}
    