<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $data = [
            ['meja' => 'out 4', 'tanggal' => '11 Mar 2023', 'jam' => '12.00', 'biaya' => '15.000'],
            ['meja' => 'out 5', 'tanggal' => '12 Mar 2023', 'jam' => '13.00', 'biaya' => '15.000'],
            ['meja' => 'out 6', 'tanggal' => '13 Mar 2023', 'jam' => '15.00', 'biaya' => '15.000'],
        ];
    
        return view('reservation', compact('data'));
        // return view('reservation');
    }

}
