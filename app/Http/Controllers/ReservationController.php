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
        $paymentTypes = PaymentType::all();
        $payments = Payment::orderBy('payment_type_id')->get()->groupBy('payment_type_id');
        return view('reservation', compact('tableDetail', 'payments', 'paymentTypes'));
    }

    public function insertPayment(Request $request){
        $reservationId = DB::table('reservation')->insertGetId([
            'payment_status' => 1,
            'payment_type' => 'BCA',
            'total_fee' => $request->input('PaymentTotalFee'),
            'created_by' => $request->input('CreatedBy')
        ]);

        $paymentDetail = $request->input('PaymentDetail');        
        foreach ($paymentDetail as &$element) {
            $element['reservation_id'] = $reservationId;
            $element['created_by'] = $request->input('CreatedBy');
            $element['reservation_date'] = Carbon::createFromFormat('d M Y H:i', $request->input('PaymentDate'));
        }
        unset($element);
        DB::table('reservation_detail')->insert($paymentDetail);

        foreach ($request->input('PaymentDetail') as $paymentDetail) {
            DB::table('table_detail')->where('id', $paymentDetail['table_id'])->update([
                'status' => 1,
                'updated_by' => $request->input('CreatedBy')
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function getTableDetailData(){
        $tableDetail = TableDetail::all();
        return response()->json($tableDetail);
    }

}
