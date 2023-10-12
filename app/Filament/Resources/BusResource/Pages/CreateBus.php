<?php

namespace App\Filament\Resources\BusResource\Pages;

use App\Filament\Resources\BusResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBus extends CreateRecord
{
    protected static string $resource = BusResource::class;

    protected function afterCreate(): void
    {
        $bus = $this->record;

        try {
            $bus->BusSeats()->createMany(
                array_map(
                    fn ($seat) => ['number' => $seat],
                    range(1, $bus->seats)
                )
            );
        } catch (\Exception $e) {
            $bus->delete();
            throw new \Exception($e->getMessage());
        }
    }
}
