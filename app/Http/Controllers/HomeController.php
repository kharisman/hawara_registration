<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use App\Models\User;
use App\Models\Registration;
use App\Models\Reseller;
use App\Models\ResellerPayment;
use App\Models\TimML;
use App\Models\TimMLV;

class HomeController extends Controller
{
    public function index()
    {
        $registration = Registration::get();
        $countregistrationall = $registration->count();
        $resellerAll = Reseller::get()->count();
        $resellerPaymentAll  = ResellerPayment::orderBy("id","DESC")->get()->count();
        $timML = TimML::where("session",'2')->get()->count();


        return view('home',compact('countregistrationall','resellerAll','resellerPaymentAll','timML'));
    }


}
