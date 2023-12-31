<?php

namespace App\Models;

use App\Models\Trip;
use App\Models\Station;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StopStation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'arrival_time' => 'datetime',
        'departure_time' => 'datetime',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function scopeAvailableSeats($query)
    {
        return $this->trip->bus->BusSeats()->whereDoesntHave('reservations')
            ->orWhereHas('reservations', function ($query) {
                $query->where('arrival_station_id', '!=', $this->station_id);
            })->get();
    }
}
