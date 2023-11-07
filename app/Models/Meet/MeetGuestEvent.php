<?php

namespace App\Models\Meet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetGuestEvent extends Model
{
    use HasFactory;

    protected $connection = 'meet';
    protected $table = 'meetGuestsEvents';

    public function MeetEvent()
    {
        return $this->belongsToMany(Event::class, 'eventsMeetsGuests', 'meetGuestEventId', 'eventId');
    }

}