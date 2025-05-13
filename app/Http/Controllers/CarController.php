<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // List available cars
    public function index()
    {
        return Car::where('is_available', true)->get();
    }

    // Store a new car
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'is_available' => 'boolean',
        ]);

        $car = Car::create($request->all());

        return response()->json(['message' => 'Car added successfully', 'car' => $car], 201);
    }

    // Update a car
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'brand' => 'sometimes|string|max:255',
            'model' => 'sometimes|string|max:255',
            'year' => 'sometimes|integer',
            'price' => 'sometimes|numeric',
            'is_available' => 'boolean',
        ]);

        $car->update($request->all());

        return response()->json(['message' => 'Car updated successfully', 'car' => $car]);
    }

    // Delete a car
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return response()->json(['message' => 'Car deleted successfully']);
    }
}

