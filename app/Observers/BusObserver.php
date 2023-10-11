<?php

namespace App\Observers;

use App\Models\Bus;

class BusObserver
{
    /**
     * Handle the Bus "created" event.
     */
    public function created(Bus $bus): void
    {
        //try to create seats for the bus else throw an exception and delete the bus
        try {
            $bus->seats()->createMany(
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

    /**
     * Handle the Bus "updated" event.
     */
    public function updated(Bus $bus): void
    {
        try {
            if ($bus->isDirty('seats')) {
                $bus->seats()->delete();
                $bus->seats()->createMany(
                    array_map(
                        fn ($seat) => ['number' => $seat],
                        range(1, $bus->seats)
                    )
                );
            }
        } catch (\Exception $e) {
            $bus->update(['seats' => $bus->getOriginal('seats')]);
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Handle the Bus "deleted" event.
     */
    public function deleted(Bus $bus): void
    {
        //
    }

    /**
     * Handle the Bus "restored" event.
     */
    public function restored(Bus $bus): void
    {
        //
    }

    /**
     * Handle the Bus "force deleted" event.
     */
    public function forceDeleted(Bus $bus): void
    {
        //
    }
}
