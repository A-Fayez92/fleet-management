<?php

namespace App\Filament\Resources\TripResource\Pages;

use App\Filament\Resources\TripResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTrip extends CreateRecord
{
    protected static string $resource = TripResource::class;

    protected function afterCreate(): void
    {
        $trip = $this->record;
        try {
            $trip->name = $trip->origin->name . ' - ' . $trip->destination->name;
            $trip->save();

            $trip->stops()->createMany([
                [
                    'station_id' => $trip->destination->id,
                    'arrival_time' => $trip->arrival_time,
                    'departure_time' => null,
                ]
            ]);
        } catch (\Exception $e) {
            $trip->delete();
            throw new \Exception($e->getMessage());
        }
    }
}
