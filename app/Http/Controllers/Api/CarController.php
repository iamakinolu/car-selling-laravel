<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        return response()->json(Car::all());
    }

    public function show(Car $car)
    {
        return response()->json($car);
    }

    public function store()
    {
        return response()->json([
            'message' => 'Store endpoint working'
        ]);
    }

    public function update(Car $car)
    {
        return response()->json([
            'message' => 'Update endpoint working',
            'car' => $car
        ]);
    }

    public function destroy(Car $car)
    {
        return response()->json([
            'message' => 'Delete endpoint working',
            'car' => $car
        ]);
    }
}