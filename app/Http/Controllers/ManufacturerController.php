<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ManufacturerController extends Controller
{
    // display all Manufacturers
    public function list(): View {
        $items = Manufacturer::orderBy("name", "asc")->get();

        return view("manufacturer.list", 
        ["title" => "Izgatavotāji", 
        "items" => $items
    ]);
    }
    
    /// dispaly new Author
    // create new Author data
// display new Author form
    public function create(): View
    {
        return view(
            'manufacturer.form',
            [
                'title' => 'Pievienot izgatavotāju'
            ]
        );
    }

   // creates new Author data
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $manufacturer = new Manufacturer();
        $manufacturer->name = $validatedData['name'];
        $manufacturer->save();

        return redirect('/manufacturers');
    }
}
