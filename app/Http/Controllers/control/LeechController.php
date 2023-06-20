<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Leech;
use App\Models\Product;
use App\Models\Branch;
use Ramsey\Uuid\Uuid;

class LeechController extends Controller
{
    public function index(){
      $data = Leech::get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function send_wa($phone_no, $message)
    {
        if(!empty($phone_no) && !empty($message)) {

        		$message = preg_replace("/(\r)/", "<ENTER>", $message);

            $phone_no = preg_replace("/(\r)/", "", $phone_no);

        		$curl = curl_init();

        		$data = array(
            	"phone_no" => $phone_no,
            	"key" => "b8942c2b2e8869728c5ddd9f1c8c37b2e0454010540c43c3",
            	"message" => $message);
            $data_string = json_encode($data);

						curl_setopt_array($curl, array(
						  CURLOPT_URL => 'http://116.203.92.59/api/send_message',
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

    public function home(){
      $data = Leech::with('product')->get();
      return view('booking',['data' => $data]);
    }

    public function create(Request $request){
    	$validator = Validator::make($request->all(), [
          'credential' => 'required|string|min:3',
          'name' => 'required|string|min:3',
      ]);

      if($validator->fails()){
          $return['status'] = 'error';
      		$return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $leech = new Leech;
      $leech->uid = Uuid::uuid4()->getHex();
      $leech->credential = $request->credential;
      $leech->name = $request->name;
      $leech->product_uid = $request->product_uid;
      $leech->branch_uid = $request->branch_uid;
      $leech->save();

      $product = Product::where('uid','=',$request->product_uid)->first();
      $branch = Branch::where('uid','=',$request->branch_uid)->first();

      $message="Hi *".$request->name."*,\nTerimakasih telah melakukan booking pada program ".$product->product_name.", mohon menunggu anda akan segera di follow up oleh admin kami";

      $msg="Hi Admin,\nAda yang booking nih pada program ".$product->product_name." dari ".$request->name." (".$request->credential.")" ;

      $this->send_wa($phone,$message);
      $this->send_wa("6281368330786",$msg);
      $this->send_wa($branch->phone_number,$msg);

      $return['status'] = 'success';
      return response()->json($return,200);
    }

}
