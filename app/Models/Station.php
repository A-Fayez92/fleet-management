<?php

namespace App\Models;

use App\Models\Trip;
use App\Models\StopStation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
