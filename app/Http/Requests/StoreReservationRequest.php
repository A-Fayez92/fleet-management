<?php

namespace App\Http\Requests;

use App\Models\Trip;
use App\Models\StopStation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'trip_id' => 'required|exists:trips,id',
            "departure_station_id" => "required|exists:stations,id",
            "stops" => "required|array",
            "stops.*.id" => "required|exists:stop_stations,id",
            "stops.*.seat_id" => "required|exists:seats,id",
        ];
    }

    public function withValidator($validator)
    {
        $trip = Trip::findOrFail($this->trip_id);
        $validator->after(function ($validator) use ($trip) {

            $this->validateStops($validator, $trip);
            $this->validateDepartureStation($validator, $trip);
            $this->validateSeats($validator, $trip);
        });
    }

    public function validateStops($validator, $trip)
    {
        $stops = $this->stops;
        $trip_stops = $trip->stops->pluck('id')->toArray();
        $stops_ids = array_column($stops, 'id');
        $diff = array_diff($stops_ids, $trip_stops);
        if (count($diff) > 0) {
            $validator->errors()->add('stops', 'Stops are not valid');
        }
    }

    public function validateDepartureStation($validator, $trip)
    {
        $departure_station_id = $this->departure_station_id;
        if ($trip->origin->id === $departure_station_id)
            return;

        $trip_stops_station_ids = $trip->stops->pluck('station_id')->toArray();
        array_pop($trip_stops_station_ids);

        if (!in_array($departure_station_id, $trip_stops_station_ids)) {
            $validator->errors()->add('departure_station_id', 'Departure station is not valid');
        }
    }

    public function validateSeats($validator, $trip)
    {
        $bus_seats = $trip->bus->busseats->pluck('id')->toArray();

        foreach ($this->stops as $stop) {
            $stop_Avilaible_seats = StopStation::findOrFail($stop['id'])->AvailableSeats()->pluck('id')->toArray();
            if (!in_array($stop['seat_id'], $bus_seats)) {
                $validator->errors()->add('stops', 'Seat Not Belong To This Bus');
            }
            if (!$stop_Avilaible_seats || !in_array($stop['seat_id'], $stop_Avilaible_seats)) {
                $validator->errors()->add('stops', 'Seat is not valid');
            }
        }
    }
}
