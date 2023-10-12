<?php

namespace App\Http\Controllers;


use App\Models\Trip;
use App\Models\Reservation;
use App\Http\Resources\ReservationResource;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\StopStation;

class ReservationController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        $trip = Trip::findOrfail($request->trip_id);

        try {
            $reservations = [];
            foreach ($request->stops as $key => $stop) {
                $stop_station = StopStation::findOrfail($stop['id']);
                $reservations[] = Reservation::create([
                    'user_id' => auth('api')->id(),
                    'trip_id' => $request->trip_id,
                    'seat_id' => $stop['seat_id'],
                    'departure_station_id' => $key == 0 ? $trip->departure_station_id : StopStation::findOrfail($request->stops[$key - 1]['id'])->station_id,
                    'arrival_station_id' => $stop_station->station_id,
                ]);
            }

            return response()->json([
                'message' => 'You have successfully reserved a seat on this trip.',
                'reservations' => $reservations ? ReservationResource::collection($reservations) : null,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
