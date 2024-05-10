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

    /*
    public function __construct(){
        $this->middleware("auth");
    }
    */
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
                'title' => 'Pievienot izgatavotāju',
                'manufacturer' => new Manufacturer,
            ]
        );
    }

   // puts new Author data
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


    public function update(Manufacturer $manufacturer): View
    {
        return view(
            'manufacturer.form',
            [
                'title' => 'Rediģēt izgatavotāju',
                'manufacturer' => $manufacturer,
            ]
        );
    }

   // patches new Author data
    public function patch(Manufacturer $manufacturer, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $manufacturer = new Manufacturer();
        $manufacturer->name = $validatedData['name'];
        $manufacturer->save();

        return redirect('/manufacturers');
    }

    public function delete(Manufacturer $manufacturer): RedirectResponse{
        $manufacturer->delete();
        return redirect("/manufacturers");
    }
}
