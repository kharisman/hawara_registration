<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reseller;
use App\Models\ResellerPayment;
use App\Models\TimML;
use App\Models\TimMLV;

class ReportController extends Controller
{
    //
    public function pendaftaran_mitra(Request $request)
    {
        $resellers = Reseller::get();
        // return $resellers;
        return view('report.mitra.mitra',compact('resellers'));
    }

    public function transaksi_mitra(Request $request)
    {
        $trxs = ResellerPayment::orderBy("id","DESC")->with("reseller")->with('product')->get();
        return view('report.mitra.transaksi',compact('trxs'));
    }

    public function vote_ml(Request $request)
    {
        $datas = TimMLV::orderBy("id","DESC")->with("tim")
        ->where(\DB::raw("LENGTH(tlp)"), ">", "10")
        ->where(\DB::raw("LENGTH(tlp)"), "<", "16")
        ->where(\DB::raw("LENGTH(nama)"), ">", "3")
        ->where(\DB::raw("LENGTH(sekolah)"), ">", "5")
        ->get();
        // return $datas;
        return view('report.ml.voting',compact('datas'));
    }


    public function pendaftaran(Request $request)
    {
        $data1 = \DB::table('registrations')->join('product_branch_options','registrations.product_branch_options_uid','=','product_branch_options.uid')->join('product_branches','product_branch_options.product_branch_uid','=','product_branches.uid')->join('products','product_branches.product_uid','=','products.uid')->join('branches','product_branches.branch_uid','=','branches.uid')->join('payments','registrations.uid','=','payments.registration_uid')->select('registrations.*', 'products.product_name', 'branches.uid as branch_uid', 'branches.branch_name','payments.status','payments.totalPay','payments.datePay')->orderBy('registrations.created_at','DESC')->get();
      
        $data2 = \DB::table('registrations')->join('webinars','registrations.product_branch_options_uid','=','webinars.uid')->join('branches','webinars.branch_uid','=','branches.uid')->join('payments','registrations.uid','=','payments.registration_uid')->select('registrations.*', 'webinars.webinar_name', 'branches.uid as branch_uid', 'branches.branch_name','payments.status','payments.totalPay','payments.datePay')->orderBy('registrations.created_at','DESC')->get();
      
        $data3 = \DB::table('registrations')->join('product_branches','registrations.product_branch_options_uid','=','product_branches.uid')->join('products','product_branches.product_uid','=','products.uid')->join('branches','product_branches.branch_uid','=','branches.uid')->join('payments','registrations.uid','=','payments.registration_uid')->select('registrations.*', 'products.product_name', 'branches.uid as branch_uid', 'branches.branch_name','payments.status','payments.totalPay','payments.datePay')->orderBy('registrations.created_at','DESC')->get();
      
        // return [$data1,$data2, $data3];
        return view('report.pendaftaran.data',compact('data1','data2' ,'data3'));
    }
}
