<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Analytics;
use Carbon\Carbon;
use Spatie\Analytics\Period;
use App\Models\Flash;
use App\Models\Payment;
use DateTime;
use Illuminate\Support\Facades\DB;

class FlashController extends Controller
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
    public function index()
    {
        $flash = Flash::with('pay')->orderBy('id','DESC')->get();
        return view('flash', ['flash' => $flash]);
    }
}
