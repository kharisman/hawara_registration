<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentFlashController extends Controller
{
    public function index($id){
    	$data = Payment::where('registration_uid','=',$id)->orderBy('created_at','DESC')->first();
    	$return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function home(){
      $data1 = DB::table('payments')->join('registrations','payments.registration_uid','=','registrations.uid')->join('product_branch_options','registrations.product_branch_options_uid','=','product_branch_options.uid')->join('product_branches','product_branch_options.product_branch_uid','=','product_branches.uid')->join('products','product_branches.product_uid','=','products.uid')->join('branches','product_branches.branch_uid','=','branches.uid')->select('payments.*', 'registrations.name', 'registrations.phone', 'registrations.email' , 'products.product_name', 'branches.uid as branch_uid', 'branches.branch_name')->orderBy('created_at','desc')->get();
      $data2 = DB::table('payments')->join('registrations','payments.registration_uid','=','registrations.uid')->join('webinars','registrations.product_branch_options_uid','=','webinars.uid')->join('branches','webinars.branch_uid','=','branches.uid')->select('payments.*', 'registrations.name', 'registrations.phone', 'registrations.email' , 'webinars.webinar_name', 'branches.uid as branch_uid', 'branches.branch_name')->orderBy('created_at','desc')->get();
      return view('payment',['data1' => $data1, 'data2' => $data2]);
    }

    public function paid($id){
      $date = Carbon::now();
    	$data = Payment::where('uid','=',$id)->update(['datePay' => $date, 'status' => 'paid', 'statusPay' => 'Offline']);
    	return redirect('/home/payments')->with('status', 'Data Pembayaran Berhasil diinput');
    }

    public function reset($id){
      $data = Payment::where('uid','=',$id)->update(['status' => 'waiting', 'statusPay' => 'Online']);
      return redirect('/home/payments')->with('status', 'Data Pembayaran Berhasil direset');
    }
}
