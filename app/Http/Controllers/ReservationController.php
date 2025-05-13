<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // List all reservations
    public function index()
    {
        return Reservation::with(['user', 'car'])->get();
    }

    // Store a new reservation
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'reservation_date' => 'required|date',
            'status' => 'required|string'
        ]);

        $reservation = Reservation::create($request->all());

        return response()->json(['message' => 'Reservation created', 'reservation' => $reservation], 201);
    }

    // Update a reservation
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $request->validate([
            'reservation_date' => 'sometimes|date',
            'status' => 'sometimes|string'
        ]);

        $reservation->update($request->all());

        return response()->json(['message' => 'Reservation updated', 'reservation' => $reservation]);
    }

    // Delete a reservation
    public function destroy($id)
    {
        Reservation::destroy($id);
        return response()->json(['message' => 'Reservation deleted']);
    }
}
