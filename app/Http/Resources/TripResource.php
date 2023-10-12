<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                'id' => $this->id,
                'name' => $this->name,
                'bus' => $this->bus->name,
                'origin' => $this->origin->name,
                'origin_id' => $this->origin->id,
                'destination' => $this->destination->name,
                'destination_id' => $this->destination->id,
                'departure_time' => $this->departure_time->format('d/m/Y H:i A'),
                'arrival_time' => $this->arrival_time->format('d/m/Y H:i A'),
                'stops' => StopStationResource::collection($this->stops),
            ];
    }
}
