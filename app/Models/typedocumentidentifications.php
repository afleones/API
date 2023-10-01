<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typedocumentidentifications extends Model
{
    use HasFactory;

    protected $connection = 'maite';
    protected $table = 'type_document_identifications'; 
}
