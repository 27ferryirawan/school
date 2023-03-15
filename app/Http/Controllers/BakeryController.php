<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Menu;

class BakeryController extends Controller
{
    public function index(){
        $menu = Menu::all();
        return view('bakery', compact('menu'));
    }
}
