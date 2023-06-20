<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Registration;
use App\Models\ProductBranchOption;
use App\Models\ProductBranch;
use App\Models\Product;
use App\Models\Branch;
use App\Models\Webinar;
use App\Models\Register;
use App\Models\MGM;
use App\Models\ClickRegisterKerja;
use App\Models\ChatKerja;
use App\Models\ClickRegister;
use App\Models\Chat;
use App\Models\ClickRegisterDKV;
use App\Models\ChatDKV;
use App\Models\ClickRegisterSI;
use App\Models\ChatSI;
use App\Models\ClickRegisterIF;
use App\Models\ChatIF;
use App\Models\ClickRegisterAK;
use App\Models\ChatAK;
use App\Models\ClickRegisterMI;
use App\Models\ChatMI;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class RegistrationController extends Controller
{

    public function index(){
      $data = Registration::get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    function sendMail ($users="",$mails="",$body="") {
      $mail             = new PHPMailer(true);
      $mail->IsSMTP();
      $mail->SMTPAuth   = true;                  // enable SMTP authentication
      $mail->SMTPKeepAlive = true;
      $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
      $mail->Host       = "mail.andikawidyanto.com";      // sets GMAIL as the SMTP server
      $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
      $mail->Username   = "admin@andikawidyanto.com";  // GMAIL username
      $mail->Password   = "4nd1k4@W1dyant0!@Dika";            // GMAIL password
      $mail->AddReplyTo("info@palcomtech.com","palcomtech.com");
      $mail->From       = "info@palcomtech.com";
      $mail->FromName   = "PalComTech.com Registration";
      $mail->Subject    = "PalComTech.com Registration";
      $mail->Body       = "$body";   //HTML Body
      $mail->AddAddress("$mails", "$users");
      $mail->IsHTML(true); // send as HTML
      if(!$mail->Send()) {
        $se = "gagal". $mail->ErrorInfo;
      }else{
        $se = "success";
      }
      return $se ;
    }

    public function home(){
      $data1 = DB::table('registrations')->join('product_branch_options','registrations.product_branch_options_uid','=','product_branch_options.uid')->join('product_branches','product_branch_options.product_branch_uid','=','product_branches.uid')->join('products','product_branches.product_uid','=','products.uid')->join('branches','product_branches.branch_uid','=','branches.uid')->join('payments','registrations.uid','=','payments.registration_uid')->select('registrations.*', 'products.product_name', 'branches.uid as branch_uid', 'branches.branch_name','payments.status','payments.totalPay','payments.datePay')->orderBy('registrations.created_at','DESC')->get();
      
      $data2 = DB::table('registrations')->join('webinars','registrations.product_branch_options_uid','=','webinars.uid')->join('branches','webinars.branch_uid','=','branches.uid')->join('payments','registrations.uid','=','payments.registration_uid')->select('registrations.*', 'webinars.webinar_name', 'branches.uid as branch_uid', 'branches.branch_name','payments.status','payments.totalPay','payments.datePay')->orderBy('registrations.created_at','DESC')->get();
      
      $data3 = DB::table('registrations')->join('product_branches','registrations.product_branch_options_uid','=','product_branches.uid')->join('products','product_branches.product_uid','=','products.uid')->join('branches','product_branches.branch_uid','=','branches.uid')->join('payments','registrations.uid','=','payments.registration_uid')->select('registrations.*', 'products.product_name', 'branches.uid as branch_uid', 'branches.branch_name','payments.status','payments.totalPay','payments.datePay')->orderBy('registrations.created_at','DESC')->get();
      
      return view('register',['data1' => $data1, 'data2' => $data2, 'data3' => $data3]);
    }

    public function regis(){
      $regis = Register::orderBy('id','desc')->get();
      return view('register_new')->with('regis',$regis);
    }

    public function mgm_view(){
      $mgm = MGM::get();
      return view('mgm_new')->with('mgm',$mgm);
    }

    public function send_wa($phone_no, $message)
    {
        if(!empty($phone_no) && !empty($message)) {

        		$message = preg_replace("/(\r)/", "<ENTER>", $message);

            $phone_no = preg_replace("/(\r)/", "", $phone_no);

        		$curl = curl_init();

        		$data = array(
            	"phone_no" => $phone_no,
            	"key" => "33ad77ffaa67d2a25de2020c4dff34654b40b3ea0cdb3a1d",
            	"message" => $message);
            $data_string = json_encode($data);

						curl_setopt_array($curl, array(
						  CURLOPT_URL => 'http://116.203.92.59/api/async_send_message',
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'POST',
						  CURLOPT_POSTFIELDS => $data_string,
						  CURLOPT_HTTPHEADER => array(
						    'Content-Type: application/json'
						  ),
						));

						$result = curl_exec($curl);

						//curl_close($curl);
						/*echo $response;
						*/
            //$message = preg_replace("/(\r)/", "<ENTER>", $message);

            //$phone_no = preg_replace("/(\r)/", "", $phone_no);


            /*$ch = curl_init('http://116.203.92.59/api/send_message');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            $result = curl_exec($ch);*/
            return $result;
        }
    }

    public function create(Request $request){
    	$validator = Validator::make($request->all(), [
          'email' => 'required|email|min:3',
          'name' => 'required|string|min:3',
          'phone' => 'required|string|min:3'
      ]);

      if($validator->fails()){
          $return['status'] = 'error';
      		$return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $name = $request->name;
      $email = $request->email;
      $phone = $request->phone;
      $checkid = $request->checkid;
      $registration = new Registration;
      $registration->uid = Uuid::uuid4()->getHex();
      $registration->product_branch_options_uid = $request->product_branch_options_uid;
      //$registration->voucher_uid = $request->voucher_uid;
      $registration->email = $request->email;
      $registration->name = $request->name;
      $registration->phone = $request->phone;
      $registration->save();

      if($checkid == 0){
      	$product_branch = ProductBranch::where('uid','=',$request->product_branch_uid)->first();

      	$branch = Branch::where('uid','=',$product_branch->branch_uid)->first();

        $product = Product::where('uid','=',$product_branch->product_uid)->first();

        $product_name = $product->product_name;

      	$message="Hi *".$request->name."*,\nTerimakasih telah mendaftar pada program ".$product_name." (".$branch->branch_name."), untuk melanjutkan transaksi silahkan pilih metode pembayaran";

        $msg="Ada pendaftaran baru nih pada program ".$product_name."(".$branch->branch_name.") dari ".$name." (".$phone.") dengan e-mail ".$email." yuk di follow up" ;

        $this->send_wa($phone,$message);
        $this->send_wa($branch->phone_number,$msg);
        $this->send_wa('081368330786',$msg);

	      $return['status'] = 'success';
	      return response()->json($return,200);

      }else{
      	/*$product_branch_options_uid = ProductBranchOption::where('uid','=',$request->product_branch_options_uid)->first();*/
      	$count = ProductBranchOption::where('uid','=',$registration->product_branch_options_uid)->count();

        if($count>0){
          $product_branch = ProductBranch::where('uid','=',$request->product_branch_uid)->first();

          $product = Product::where('uid','=',$product_branch->product_uid)->first();

          $branch = Branch::where('uid','=',$product_branch->branch_uid)->first();


          $product_name = $product->product_name;
        }else{
          $product = Webinar::where('uid','=',$registration->product_branch_options_uid)->first();

          $branch = Branch::where('uid','=',$product->branch_uid)->first();

          $product_name = $product->webinar_name;
        }

        $message="Hi *".$request->name."*,\nTerimakasih telah mendaftar pada program ".$product_name."(".$branch->branch_name."), untuk melanjutkan transaksi silahkan pilih metode pembayaran";

        $msg="Ada pendaftaran baru nih pada program ".$product_name."(".$branch->branch_name.") dari ".$name." (".$phone.") dengan e-mail ".$email." yuk di follow up" ;

        $this->send_wa($phone,$message);
        $this->send_wa($branch->phone_number,$msg);
        $this->send_wa('081368330786',$msg);

	      $return['status'] = 'success';
	      return response()->json($return,200);
      }

    }

    public function register(Request $request){
      $validator = Validator::make($request->all(), [
          'email' => 'required|email|min:3',
          'nama' => 'required|string|min:3',
          'prodi' => 'required|string',
          'no_hp' => 'required|string',
          'asal_sekolah' => 'required|string',
          'domisili' => 'required|string',
          'instagram' => 'required|string',
          'tahun_lulus' => 'required|string',
      ]);

      if($validator->fails()){
          $return['status'] = 'error';
          $return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $register = new Register;
      $register->nama = $request->nama;
      $register->email = $request->email;
      $register->prodi = $request->prodi;
      $register->no_hp = $request->no_hp;
      $register->no_hp2 = $request->phone2;
      $register->asal_sekolah = $request->asal_sekolah;
      $register->domisili = $request->domisili;
      $register->instagram = $request->instagram;
      $register->facebook = $request->fb;
      $register->tahun_lulus = $request->tahun_lulus;
      $register->save();

      $return['status'] = 'success';
      return response()->json($return,200);
    }

    public function mgm(Request $request){
      $validator = Validator::make($request->all(), [
          'nama' => 'required|string|min:3',
          'prodi' => 'required|string',
          'no_hp' => 'required|string',
          'semester' => 'required|integer',
          'instagram' => 'required|string',
          'rek1' => 'required|string'
      ]);

      if($validator->fails()){
          $return['status'] = 'error';
          $return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $mgm = new MGM;
      $mgm->nama = $request->nama;
      $mgm->prodi = $request->prodi;
      $mgm->no_hp = $request->no_hp;
      $mgm->semester = $request->semester;
      $mgm->instagram = $request->instagram;
      $mgm->rek1 = $request->rek1;
      $mgm->rek2 = $request->rek2;
      $mgm->rek3 = $request->rek3;
      $mgm->save();

      $return['status'] = 'success';
      return response()->json($return,200);
    }

    public function select($id,$email){
      $data = Registration::where('product_branch_options_uid','=',$id)->where('email','=',$email)->orderByDesc('id')->first();
      $count = $data->count();
      if($count<1){
        $return['status'] = "error";
        return response()->json($return, 422);
      }else{
        $return['status'] = "success";
        $return['data'] = $data;
        return response()->json($return, 200);
      }
    }

    public function clickRegister(Request $request){
      $cek = ClickRegister::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new ClickRegister();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        ClickRegister::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }

    public function clickChat(Request $request){
      $cek = Chat::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new Chat();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        Chat::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }

    public function clickRegisterDKV(Request $request){
      $cek = ClickRegisterDKV::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new ClickRegisterDKV();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        ClickRegisterDKV::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }

    public function clickChatDKV(Request $request){
      $cek = ChatDKV::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new ChatDKV();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        ChatDKV::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }

    public function clickRegisterKerja(Request $request){
      $cek = ClickRegisterKerja::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new ClickRegisterKerja();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        ClickRegisterKerja::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }

    public function clickChatKerja(Request $request){
      $cek = ChatKerja::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new ChatKerja();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        ChatKerja::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }

    public function clickRegisterSI(Request $request){
      $cek = ClickRegisterSI::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new ClickRegisterSI();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        ClickRegisterSI::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }

    public function clickChatSI(Request $request){
      $cek = ChatSI::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new ChatSI();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        ChatSI::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }

    public function clickRegisterIF(Request $request){
      $cek = ClickRegisterIF::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new ClickRegisterIF();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        ClickRegisterIF::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }

    public function clickChatIF(Request $request){
      $cek = ChatIF::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new ChatIF();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        ChatIF::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }

    public function clickRegisterAK(Request $request){
      $cek = ClickRegisterAK::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new ClickRegisterAK();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        ClickRegisterAK::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }

    public function clickChatAK(Request $request){
      $cek = ChatAK::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new ChatAK();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        ChatAK::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }

    public function clickRegisterMI(Request $request){
      $cek = ClickRegisterMI::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new ClickRegisterMI();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        ClickRegisterMI::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }

    public function clickChatMI(Request $request){
      $cek = ChatMI::where('tanggal',$request->tanggal)->get()->count();
      if($cek<1){
        $reg = new ChatMI();
        $reg->tanggal = $request->tanggal;
        $reg->views = 1;
        $reg->save();
      }else{
        ChatMI::where('tanggal',$request->tanggal)
                    ->update(['views'=> DB::raw('views+1')]);
      }
    }
}
