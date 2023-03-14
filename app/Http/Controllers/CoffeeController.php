<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Menu;

class CoffeeController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        return view('coffee', compact('menu'));
    }
}
