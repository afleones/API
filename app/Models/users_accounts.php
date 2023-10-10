<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_accounts extends Model
{
    use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password'
    ];


    protected $connection = 'maite';
    protected $table = 'users';

    public function roles()
    {
        return $this->belongsToMany(role::class);
    }
}
