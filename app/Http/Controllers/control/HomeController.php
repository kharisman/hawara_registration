<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Analytics;
use Carbon\Carbon;
use Spatie\Analytics\Period;
use App\Models\Category;
use App\Models\Branch;
use App\Models\ProductBranch;
use App\Models\Product;
use App\Models\Webinar;
use App\Models\User;
use App\Models\Gimmick;
use App\Models\Promo;
use App\Models\Registration;
use App\Models\Payment;
use App\Models\Leech;
use App\Models\Blog;
use App\Models\Voucher;
use App\Models\Register;
use App\Models\MGM;
use App\Models\Chat;
use App\Models\ClickRegister;
use App\Models\ChatDKV;
use App\Models\ClickRegisterDKV;
use App\Models\ChatKerja;
use App\Models\ClickRegisterKerja;
use App\Models\ChatSI;
use App\Models\ClickRegisterSI;
use App\Models\ChatIF;
use App\Models\ClickRegisterIF;
use App\Models\ChatAK;
use App\Models\ClickRegisterAK;
use App\Models\ChatMI;
use App\Models\ClickRegisterMI;
use DateTime;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
        $category = Category::get();
        $countcategory = $category->count();

        $product = Product::get();
        $countproduct = $product->count();

        $branch = Branch::get();
        $countbranch = $branch->count();

        $product_branch = ProductBranch::get();
        $countproduct_branch = $product_branch->count();

        $user = User::get();
        $countuser = $user->count();

        $webinar = Webinar::get();
        $countwebinarall = $webinar->count();

        $register = Register::get();
        $countregister = $register->count();

        $mgm = MGM::get();
        $countmgm = $mgm->count();

        $web = Webinar::where('branch_uid','=',Auth::user()->branch_uid)->get();
        $countwebinar = $web->count();

        $blog = Blog::get();
        $countblog = $blog->count();

        $gimmick = Gimmick::get();
        $countgimmick = $gimmick->count();

        $promo = Promo::get();
        $countpromo = $promo->count();

        $voucher = Voucher::get();
        $countvoucher = $voucher->count();

        $registration = Registration::get();
        $countregistrationall = $registration->count();

        $data1 = DB::table('registrations')->join('product_branch_options','registrations.product_branch_options_uid','=','product_branch_options.uid')->join('product_branches','product_branch_options.product_branch_uid','=','product_branches.uid')->join('products','product_branches.product_uid','=','products.uid')->join('branches','product_branches.branch_uid','=','branches.uid')->select('registrations.*', 'products.product_name', 'branches.uid as branch_uid', 'branches.branch_name')->where('branches.uid','=',Auth::user()->branch_uid)->get();
        $data2 = DB::table('registrations')->join('webinars','registrations.product_branch_options_uid','=','webinars.uid')->join('branches','webinars.branch_uid','=','branches.uid')->select('registrations.*', 'webinars.webinar_name', 'branches.uid as branch_uid', 'branches.branch_name')->where('branches.uid','=',Auth::user()->branch_uid)->get();
        $count1 = $data1->count();
        $count2 = $data2->count();
        $countregistration = $count1+$count2;

        //$fu = Leech::where('branch_uid','=',Auth::user()->branch_uid)->get();
        //$countfu = $fu->count();

        /*$fua = Leech::get();
        $countfuall = $fua->count();*/

        $payment = Payment::get();
        $countpaymentall = $payment->count();

        $analyticsData1 = Analytics::performQuery(
                    Period::days(31),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/beasiswa/'
                    ]
                );
        $pagesbea = $analyticsData1['rows'];

        $analyticsData2 = Analytics::performQuery(
                    Period::days(31),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/dkv/'
                    ]
                );
        $pagesdkv = $analyticsData2['rows'];

        $analyticsData3 = Analytics::performQuery(
                    Period::days(31),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/'
                    ]
                );
        $pagespalcom = $analyticsData3['rows'];

        $analyticsData4 = Analytics::performQuery(
                    Period::days(31),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/SarjanaSistemInformasi/'
                    ]
                );
        $pagessi = $analyticsData4['rows'];

        $analyticsData5 = Analytics::performQuery(
                    Period::days(31),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/SarjanaInformatika/'
                    ]
                );
        $pagesif = $analyticsData5['rows'];

        $analyticsDataK = Analytics::performQuery(
                    Period::days(31),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/kuliahsambilkerja/'
                    ]
                );
        $pageskerja = $analyticsDataK['rows'];

        $analyticsData6 = Analytics::performQuery(
                    Period::days(31),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/D3Akuntansi/'
                    ]
                );
        $pagesak = $analyticsData6['rows'];

        $analyticsData7 = Analytics::performQuery(
                    Period::days(31),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/D3SistemInformasi/'
                    ]
                );
        $pagesmi = $analyticsData7['rows'];

        $today = date('Ymd');

        $regtodaybea = ClickRegister::select('views')->where('tanggal',$today)->first();
        $chattodaybea = Chat::select('views')->where('tanggal',$today)->first();

        $regtodaydkv = ClickRegisterDKV::select('views')->where('tanggal',$today)->first();
        $chattodaydkv = ChatDKV::select('views')->where('tanggal',$today)->first();

        $regtodaysi = ClickRegisterSI::select('views')->where('tanggal',$today)->first();
        $chattodaysi = ChatSI::select('views')->where('tanggal',$today)->first();

        $regtodayif = ClickRegisterIF::select('views')->where('tanggal',$today)->first();
        $chattodayif = ChatIF::select('views')->where('tanggal',$today)->first();

        $regtodaykerja = ClickRegisterKerja::select('views')->where('tanggal',$today)->first();
        $chattodaykerja = ChatKerja::select('views')->where('tanggal',$today)->first();

        $regtodayak = ClickRegisterAK::select('views')->where('tanggal',$today)->first();
        $chattodayak = ChatAK::select('views')->where('tanggal',$today)->first();

        $regtodaymi = ClickRegisterMI::select('views')->where('tanggal',$today)->first();
        $chattodaymi = ChatMI::select('views')->where('tanggal',$today)->first();

        $visit1 = Analytics::performQuery(
                    Period::days(1),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/beasiswa/'
                    ]
                );

        $visittodaybea = $visit1['rows'][1][1];

        $visit2 = Analytics::performQuery(
                    Period::days(1),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/dkv/'
                    ]
                );

        $visittodaydkv = $visit2['rows'][1][1];

        $visit3 = Analytics::performQuery(
                    Period::days(1),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/SarjanaSistemInformasi/'
                    ]
                );

        $visittodaysi = $visit3['rows'][1][1];

        $visitk = Analytics::performQuery(
                    Period::days(1),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/kuliahsambilkerja/'
                    ]
                );

        $visittodaykerja = $visitk['rows'][1][1];

        $visit4 = Analytics::performQuery(
                    Period::days(1),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/SarjanaInformatika/'
                    ]
                );

        $visittodayif = $visit4['rows'][1][1];

        $visit6 = Analytics::performQuery(
                    Period::days(1),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/D3SistemInformasi/'
                    ]
                );

        $visittodaymi = $visit6['rows'][1][1];

        $visit5 = Analytics::performQuery(
                    Period::days(1),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/D3Akuntansi/'
                    ]
                );

        $visittodayak = $visit5['rows'][1][1];

        $tanggal1 = date("Ymd", strtotime('-31 days'));
        $tanggal2 = date("Ymd", strtotime(now()));

        $chatbea = Chat::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();
        $clickregisterbea = ClickRegister::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();

        $chatdkv = ChatDKV::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();
        $clickregisterdkv = ClickRegisterDKV::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();

        $chatsi = ChatSI::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();
        $clickregistersi = ClickRegisterSI::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();

        $chatif = ChatIF::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();
        $clickregisterif = ClickRegisterIF::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();

        $chatkerja = ChatKerja::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();
        $clickregisterkerja = ClickRegisterKerja::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();

        $chatak = ChatAK::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();
        $clickregisterak = ClickRegisterAK::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();

        $chatmi = ChatMI::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();
        $clickregistermi = ClickRegisterMI::whereBetween('tanggal',[$tanggal1,$tanggal2])->get();

        $d1 = DB::table('payments')->join('registrations','payments.registration_uid','=','registrations.uid')->join('product_branch_options','registrations.product_branch_options_uid','=','product_branch_options.uid')->join('product_branches','product_branch_options.product_branch_uid','=','product_branches.uid')->join('products','product_branches.product_uid','=','products.uid')->join('branches','product_branches.branch_uid','=','branches.uid')->select('payments.*', 'registrations.name', 'registrations.phone', 'registrations.email' , 'products.product_name', 'branches.uid as branch_uid', 'branches.branch_name')->where('branches.uid','=',Auth::user()->branch_uid)->get();
        $d2 = DB::table('payments')->join('registrations','payments.registration_uid','=','registrations.uid')->join('webinars','registrations.product_branch_options_uid','=','webinars.uid')->join('branches','webinars.branch_uid','=','branches.uid')->select('payments.*', 'registrations.name', 'registrations.phone', 'registrations.email' , 'webinars.webinar_name', 'branches.uid as branch_uid', 'branches.branch_name')->where('branches.uid','=',Auth::user()->branch_uid)->get();
        $c1 = $d1->count();
        $c2 = $d2->count();
        $countpayment = $c1+$c2;

		if(empty($regtodaybea['views'])){ $regtodaybea['views'] = 0; }

		if(empty($chattodaybea['views'])){ $chattodaybea['views'] = 0; }

		if(empty($regtodaydkv['views'])){ $regtodaydkv['views'] = 0; }

		if(empty($chattodaydkv['views'])){ $chattodaydkv['views'] = 0; }

		if(empty($regtodaysi['views'])){ $regtodaysi['views'] = 0; }

		if(empty($chattodaysi['views'])){ $chattodaysi['views'] = 0; }

		if(empty($regtodayif['views'])){ $regtodayif['views'] = 0; }

		if(empty($chattodayif['views'])){ $chattodayif['views'] = 0; }

        if(empty($regtodaykerja['views'])){ $regtodaykerja['views'] = 0; }

        if(empty($chattodaykerja['views'])){ $chattodaykerja['views'] = 0; }

		if(empty($regtodayak['views'])){ $regtodayak['views'] = 0; }

		if(empty($chattodayak['views'])){ $chattodayak['views'] = 0; }

		if(empty($regtodaymi['views'])){ $regtodaymi['views'] = 0; }

		if(empty($chattodaymi['views'])){ $chattodaymi['views'] = 0; }

        return view('home', ['cc' => $countcategory, 'cp' => $countproduct, 'cb' => $countbranch, 'cpb' => $countproduct_branch, 'cu' => $countuser, 'cw' => $countwebinar, 'cwa' => $countwebinarall, 'cg' => $countgimmick, 'cpr' => $countpromo, 'cwb' => $countblog, 'cre' => $countregistration, 'crea' => $countregistrationall, 'cv' => $countvoucher, 'cpay' => $countpayment, 'cpaya' => $countpaymentall,  'creg' => $countregister, 'cmgm' => $countmgm, 'pagesbea' => $pagesbea, 'chatbea' => $chatbea, 'clregbea' => $clickregisterbea, 'chattodaybea' => $chattodaybea, 'regtodaybea' => $regtodaybea, 'visittodaybea' => $visittodaybea, 'pagesdkv' => $pagesdkv, 'chatdkv' => $chatdkv, 'clregdkv' => $clickregisterdkv, 'chattodaydkv' => $chattodaydkv, 'regtodaydkv' => $regtodaydkv, 'visittodaydkv' => $visittodaydkv, 'pagessi' => $pagessi, 'chatsi' => $chatsi, 'clregsi' => $clickregistersi, 'chattodaysi' => $chattodaysi, 'regtodaysi' => $regtodaysi, 'visittodaysi' => $visittodaysi, 'pagesif' => $pagesif, 'chatif' => $chatif, 'clregif' => $clickregisterif, 'pageskerja' => $pageskerja,  'chatkerja' => $chatkerja, 'clregkerja' => $clickregisterkerja, 'chattodaykerja' => $chattodaykerja, 'regtodaykerja' => $regtodaykerja, 'visittodaykerja' => $visittodaykerja, 'chattodayif' => $chattodayif, 'regtodayif' => $regtodayif, 'visittodayif' => $visittodayif, 'pagesak' => $pagesak, 'chatak' => $chatak, 'clregak' => $clickregisterak, 'chattodayak' => $chattodayak, 'regtodayak' => $regtodayak, 'visittodayak' => $visittodayak, 'pagesmi' => $pagesmi, 'chatmi' => $chatmi, 'clregmi' => $clickregistermi, 'chattodaymi' => $chattodaymi, 'regtodaymi' => $regtodaymi, 'visittodaymi' => $visittodaymi, 'pagespalcom' => $pagespalcom]);
    }

    public function filter(Request $request){
        $data = [];
        $date = str_replace("-", "", $request->query('value1'));

        $tgla = $request->query('value1');
        $tglb = $request->query('value2');
        $data1 = Chat::where('tanggal',$date)->first();
        $data2 = ClickRegister::where('tanggal',$date)->first();

        $dataanalytic1 = Analytics::performQuery(
                    Period::create(new \DateTime("$tgla 00:00:00"),new \DateTime("$tglb 00:00:00")),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/beasiswa/',
                    ]
                );

        $cdt1 = count($dataanalytic1['rows']);
        $sum1 = 0;
        for($i=0;$i<$cdt1;$i++){
            $sum1 += ($dataanalytic1['rows'][$i][1]);
        }
        $data3 = $sum1;

        $data4 = ChatDKV::where('tanggal',$date)->first();
        $data5 = ClickRegisterDKV::where('tanggal',$date)->first();

        $dataanalytic2 = Analytics::performQuery(
                    Period::create(new \DateTime("$tgla 00:00:00"),new \DateTime("$tglb 00:00:00")),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/dkv/',
                    ]
                );

        $cdt2 = count($dataanalytic2['rows']);
        $sum2 = 0;
        for($i=0;$i<$cdt2;$i++){
            $sum2 += ($dataanalytic2['rows'][$i][1]);
        }
        $data6 = $sum2;

        $data7 = ChatSI::where('tanggal',$date)->first();
        $data8 = ClickRegisterSI::where('tanggal',$date)->first();

        $dataanalytic3 = Analytics::performQuery(
                    Period::create(new \DateTime("$tgla 00:00:00"),new \DateTime("$tglb 00:00:00")),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/SarjanaSistemInformasi/',
                    ]
                );

        $cdt3 = count($dataanalytic3['rows']);
        $sum3 = 0;
        for($i=0;$i<$cdt3;$i++){
            $sum3 += ($dataanalytic3['rows'][$i][1]);
        }
        $data9 = $sum3;

        $data10 = ChatIF::where('tanggal',$date)->first();
        $data11 = ClickRegisterIF::where('tanggal',$date)->first();

        $dataanalytic4 = Analytics::performQuery(
                    Period::create(new \DateTime("$tgla 00:00:00"),new \DateTime("$tglb 00:00:00")),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/SarjanaInformatika/',
                    ]
                );

        $cdt4 = count($dataanalytic4['rows']);
        $sum4 = 0;
        for($i=0;$i<$cdt4;$i++){
            $sum4 += ($dataanalytic4['rows'][$i][1]);
        }
        $data12 = $sum4;

        $data13 = ChatAK::where('tanggal',$date)->first();
        $data14 = ClickRegisterAK::where('tanggal',$date)->first();

        $dataanalytic5 = Analytics::performQuery(
                    Period::create(new \DateTime("$tgla 00:00:00"),new \DateTime("$tglb 00:00:00")),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/D3Akuntansi/',
                    ]
                );

        $cdt5 = count($dataanalytic5['rows']);
        $sum5 = 0;
        for($i=0;$i<$cdt5;$i++){
            $sum5 += ($dataanalytic5['rows'][$i][1]);
        }
        $data15 = $sum5;

        $data16 = ChatMI::where('tanggal',$date)->first();
        $data17 = ClickRegisterMI::where('tanggal',$date)->first();

        $dataanalytic6 = Analytics::performQuery(
                    Period::create(new \DateTime("$tgla 00:00:00"),new \DateTime("$tglb 00:00:00")),
                    'ga:pageviews',
                    [
                        'metrics' => 'ga:pageviews',
                        'dimensions' => 'ga:date',
                        'filters' => 'ga:pagePath==/D3SistemInformasi/',
                    ]
                );

        $cdt6 = count($dataanalytic6['rows']);
        $sum6 = 0;
        for($i=0;$i<$cdt6;$i++){
            $sum6 += ($dataanalytic6['rows'][$i][1]);
        }
        $data18 = $sum6;

        return response()->json(['data1' => $data1, 'data2' => $data2, 'data3' => $data3, 'data4' => $data4, 'data5' => $data5, 'data6' => $data6, 'data7' => $data7, 'data8' => $data8, 'data9' => $data9, 'data10' => $data10, 'data11' => $data11, 'data12' => $data12, 'data13' => $data13, 'data14' => $data14, 'data15' => $data15, 'data16' => $data16, 'data17' => $data17, 'data18' => $data18]);
    }


    public function logout(Request $request) {
      Auth::logout();
      return redirect('/login');
    }
}
