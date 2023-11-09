<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $connection = 'maite';
    protected $table = 'roles';

    public function users()
    {
        return $this->belongsToMany(user_accounts::class);
    }

}
