<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetEvent extends Model
{
    use HasFactory;

    protected $connection = 'meet';
    protected $table = 'events';

    public function meetGuestEvent()
    {
        return $this->belongsToMany(MeetGuestEvent::class, 'eventsMeetsGuests', 'eventId', 'meetGuestEventId');
    }




}
