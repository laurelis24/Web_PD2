<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class ManufacturerController extends Controller implements HasMiddleware{

     public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function list(): View {
        $items = Manufacturer::orderBy("name", "asc")->get();

        return view("manufacturer.list", 
        ["title" => "Ražotāji", 
        "items" => $items
         ]);
    }
    
    
    public function create(): View
    {
        return view(
            'manufacturer.form',
            [
                'title' => 'Pievienot ražotāju',
                'manufacturer' => new Manufacturer,
            ]
        );
    }

   
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $manufacturer = new Manufacturer();
        $manufacturer->name = $validatedData['name'];
        $manufacturer->country = $validatedData['country'];
        $manufacturer->save();

        return redirect('/manufacturers');
    }


    public function update(Manufacturer $manufacturer): View
    {
        return view(
            'manufacturer.form',
            [
                'title' => 'Rediģēt ražotāju',
                'manufacturer' => $manufacturer,
            ]
        );
    }

   
    public function patch(Manufacturer $manufacturer, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        //$manufacturer = new Manufacturer();
        $manufacturer->name = $validatedData['name'];
        $manufacturer->country = $validatedData['country'];
        $manufacturer->save();

        return redirect('/manufacturers');
    }

    public function delete(Manufacturer $manufacturer): RedirectResponse{
        $manufacturer->delete();
        return redirect("/manufacturers");
    }
}
