<?php

namespace App\Http\Controllers;

use App\Models\Car; // Assuming you have the Car model
use App\Models\CarSale;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarSalesController extends Controller
{
    /**
     * Get available cars.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAvailableCars()
    {
        $cars = Car::where('is_available', true)->get(); // Only get cars where is_available is true
        return response()->json(['available_cars' => $cars]);
    }

    /**
     * Get all car sales.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return CarSale::with(['agent', 'vehicle', 'user'])->get();
    }

    /**
     * Store a new car sale.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'user_id' => 'required|exists:users,id',
            'sale_price' => 'required|numeric',
            'sale_date' => 'required|date',
        ]);

        return CarSale::create($validated);
    }

    /**
     * Show a specific car sale.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return CarSale::with(['agent', 'vehicle', 'user'])->findOrFail($id);
    }

    /**
     * Update a car sale.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $carSale = CarSale::findOrFail($id);
        $carSale->update($request->all());
        return $carSale;
    }

    /**
     * Delete a car sale.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        CarSale::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
