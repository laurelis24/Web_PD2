<?php

namespace App\Http\Controllers;


use App\Http\Requests\CarRequest;
use App\Models\Category;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\View\View;
use App\Models\Car;
use App\Models\Manufacturer;
use Illuminate\Http\RedirectResponse;


class CarController extends Controller implements HasMiddleware
{
    // call auth middleware
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }


    public function list(): View
    {
        $cars = Car::orderBy('model', 'asc')->get();

        return view(
            'car.list',
            [
                'title' => 'Automašīnas',
                'cars' => $cars
            ]
        );
    }

    public function singleView(Car $car): View
    {
        //$cars = Car::orderBy('model', 'asc')->get();
      
        return view(
            'car.single',
            [
                'title' => 'Automašīnas',
                'car' => $car
            ]
        );
    }

    public function create(): View
    {
        $manufacturers = Manufacturer::orderBy('name', 'asc')->get();
        $categories = Category::orderBy("name", "asc")->get();

        return view(
            'car.form',
            [
                'title' => 'Pievienot automašīnu',
                'car' => new Car(),
                'manufacturers' => $manufacturers,
                'categories' => $categories
            ]
        );
    }


    public function put(CarRequest $request): RedirectResponse{
        $this->saveCarData(new Car(), $request);
        return redirect('/cars');
    }
  
    public function update(Car $car): View
    {
        $manufacturers = Manufacturer::orderBy('name', 'asc')->get();
        $categories = Category::orderBy("name", "asc")->get();

        return view(
            'car.form',
            [
                'title' => 'Rediģēt automašīnu',
                'car' => $car,
                'manufacturers' => $manufacturers,
                'categories' => $categories
            ]
        );
    }

    public function patch(Car $car, CarRequest $request): RedirectResponse {
        $this->saveCarData($car, $request);
        return redirect('/cars');
    }

    private function saveCarData(Car $car, CarRequest $request): void
    {
        /*
        $validatedData = $request->validate([
            'model' => 'required|min:2|max:256',
            'manufacturer_id' => 'required',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
            'year' => 'numeric',
            'image' => 'nullable|image',
            'display' => 'nullable',
        ]);
        */

        $validatedData = $request->validated(); 
        $car->fill($validatedData);
        $car->display = (bool) ($validatedData['display'] ?? false);
        
        
        if ($request->hasFile('image')){
            if ($car->image) {
                unlink(getcwd() . '/images/' . $car->image);
            }
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension(); 
            $name = uniqid();
            $car->image = $uploadedFile->storePubliclyAs(
                '/', $name . '.' . $extension, 'uploads' 
            );
        } 

        $car->save();

        //return redirect('/cars' . $car->id);
    }



        
    public function delete(Car $car): RedirectResponse
    {
         
        if ($car->image) {
            unlink(getcwd() . '/images/' . $car->image);
        }

        $car->delete();
        return redirect('/cars');
    }

}
