<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetGuestsEvent extends Model
{
    use HasFactory;

    protected $connection = 'meet';
    protected $table = 'meetGuestsEvents';
}