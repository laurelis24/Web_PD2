<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class CategoryController extends Controller {
      public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

     public function list(): View {
        $categories = Category::orderBy("name", "asc")->get();
        
        return view("category.list", 
        ["title" => "Kategorijas", 
        "categories" => $categories
         ]);
    }

     public function create(): View
    {
        return view(
            'category.form',
            [
                'title' => 'Pievienot kategoriju',
                'category' => new Category,
            ]
        );
    }

     public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->name = $validatedData['name'];
        $category->save();

        return redirect('/categories');
    }
    

     public function update(Category $category): View
    {
        return view(
            'category.form',
            [
                'title' => 'Rediģēt kategoriju',
                'category' => $category,
            ]
        );
    }

    public function patch(Category $category, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        //$category = new Category();
        $category->name = $validatedData['name'];
        $category->save();

        return redirect('/categories');
    }

    public function delete(Category $category): RedirectResponse{
        $category->delete();
        return redirect("/categories");
    }
}
