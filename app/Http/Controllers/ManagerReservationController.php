<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\TableDetail;
use App\Models\Payment;
use App\Models\PaymentType;

class ManagerReservationController extends Controller
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
        $reservations = Reservation::select('reservation_detail.id', DB::raw("CASE WHEN reservation_detail.status= '1' THEN 'On Reserve' WHEN reservation_detail.status= '2' THEN 'Guest In' WHEN reservation_detail.status= '3' THEN 'Guest Out' WHEN reservation_detail.status= '4' THEN 'Cancel Reservation' ELSE '' END AS status"), 'reservation.total_fee', 'payment.payment_name', 'payment_type.payment_type_name', 'users.name', 'table_detail.table_name', 'reservation_detail.reservation_date', 'reservation_detail.fee', 'users.profile_picture', 'users.email', 'table_detail.id as table_id')
                        ->join('reservation_detail', 'reservation.id', '=', 'reservation_detail.reservation_id')
                        ->join('payment', 'reservation.payment_id', '=', 'payment.id')
                        ->join('payment_type', 'payment.payment_type_id', '=', 'payment_type.id')
                        ->join('users', 'reservation.created_by', '=', 'users.id')
                        ->join('table_detail', 'reservation_detail.table_id', '=', 'table_detail.id')
                        ->get();

        $totalFee = Reservation::sum('total_fee');
        return view('manager_reservation', compact('tableDetail', 'reservations', 'totalFee'));
    }

    public function updateReservationStatus(Request $request){
        DB::table('reservation_detail')
        ->where('id', $request->input('ReservationId'))
        ->update(['status' => $request->input('ReservationStatus'), 'updated_by' => $request->input('UpdatedBy')]);

        //0 = available, 1 = on reserve, 2 = guest in , 3 = guest out, 4 = cancel
        //0 = available, 1 = on reserve, 2 = guest in 
        $tabStatus = 0;
        if($request->input('ReservationStatus') == 0 || $request->input('ReservationStatus') == 3 || $request->input('ReservationStatus') == 4){
            $tabStatus = 0;
        } else {
            $tabStatus = $request->input('ReservationStatus');
        } 

        DB::table('table_detail')
        ->where('id', $request->input('TableId'))
        ->update(['status' => $tabStatus, 'updated_by' => $request->input('UpdatedBy')]);


        return response()->json(['success' => true]);
    }


}
