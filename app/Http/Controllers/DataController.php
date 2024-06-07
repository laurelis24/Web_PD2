<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Car;
use Illuminate\Http\JsonResponse;

class DataController extends Controller
{
    
        // Return 3 published cars in random order
    public function getTopCars(): JsonResponse
    {
        $cars = Car::where('display', true)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return response()->json($cars);
    }
    


   public function getCar(Car $car): JsonResponse
{
$selectedCar = Car::where([
'id' => $car->id,
'display' => true,
])
->firstOrFail();
return response()->json($selectedCar);
}



public function getRelatedCars(Car $car): JsonResponse

{
$cars = Car::where('display', true)
->where('id', '<>', $car->id)
->whereOr("manufacturer_id", "=", $car->manufacturer->id)  // same manufacturer
->where("category_id", "=", $car->category->id)   // same category
->inRandomOrder()
->take(3)
->get();
return response()->json($cars);
}


public function getNotRelatedCars(Car $car): JsonResponse

{
$cars = Car::where('display', true)
->where('id', '<>', $car->id)
->whereOr("manufacturer_id", "!=", $car->manufacturer->id)  // not same manufacturer
->where("category_id", "!=", $car->category->id)   // not same category
->inRandomOrder()
->take(5)
->get();

return response()->json($cars);
}


}
