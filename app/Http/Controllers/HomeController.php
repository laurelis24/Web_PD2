<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view(
            'home.public',     // new -> 'home.public'     // old-> home.index 
            [
                'title' => 's23kairlaur',
                
            ]
        );
    }
}
