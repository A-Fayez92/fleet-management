<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StopStationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'station' => $this->station->name,
            'station_id' => $this->station->id,
            'arrival_time' => $this->arrival_time ? $this->arrival_time->format('d/m/Y H:i A') : null,
            'departure_time' => $this->departure_time ? $this->departure_time->format('d/m/Y H:i A') : null,
            'duration' => $this->arrival_time->diffForHumans($this->departure_time, true),
            'seats' => $this->AvailableSeats() ? SeatResource::collection($this->AvailableSeats()) : null,
        ];
    }
}
