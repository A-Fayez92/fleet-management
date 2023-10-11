<?php

namespace App\Models;

use App\Models\Bus;
use App\Models\Seat;
use App\Models\Trip;
use App\Models\Station;
use App\Models\StopStation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
    ];

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }

    public function origin(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'departure_station_id');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'arrival_station_id');
    }

    public function seats()
    {
        return $this->hasManyThrough(Seat::class, Bus::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Trip::class, 'parent_id');
    }

    public function stops(): HasMany
    {
        return $this->hasMany(StopStation::class);
    }
}
