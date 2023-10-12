<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'trip' => $this->trip->name,
            'seat' => $this->seat->number,
            'departure_station' => $this->departureStation->name,
            'departure_time' => $this->trip->departure_time->format('d/m/Y H:i A'),
            'arrival_station' => $this->arrivalStation->name,
            'arrival_time' => $this->trip->arrival_time->format('d/m/Y H:i A'),
        ];
    }
}
