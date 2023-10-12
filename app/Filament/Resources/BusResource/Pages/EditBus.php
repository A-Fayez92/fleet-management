<?php

namespace App\Filament\Resources\BusResource\Pages;

use App\Filament\Resources\BusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBus extends EditRecord
{
    protected static string $resource = BusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $bus = $this->record;

        try {
            $bus->BusSeats()->delete();
            $bus->BusSeats()->createMany(
                array_map(
                    fn ($seat) => ['number' => $seat],
                    range(1, $bus->seats)
                )
            );
        } catch (\Exception $e) {
            $bus->update(['seats' => $bus->getOriginal('seats')]);
            throw new \Exception($e->getMessage());
        }
    }
}
