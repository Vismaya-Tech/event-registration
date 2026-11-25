<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'event_date', 'description'];

    protected $casts = ['event_date' => 'date'];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
