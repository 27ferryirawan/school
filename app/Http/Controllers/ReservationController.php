<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableDetail;

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
        $tableDetail = TableDetail::all();
        return view('reservation', compact('tableDetail'));
        // return view('reservation');
    }

    public function insertPayment(Request $request){
        DB::table('reservation')->insert([
            'payment_status' => 1,
            'payment_type' => 'BCA',
            'total_fee' => $request->input('PaymentTotalFee'),
            'created_by' => $request->input('CreatedBy')
        ]);

        return response()->json(['success' => true]);
    }

}
