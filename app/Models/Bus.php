<?php

namespace App\Models;

use App\Models\Seat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'seats',
    ];

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }
}
