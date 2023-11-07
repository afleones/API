<?php

namespace App\Models\Meet;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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
