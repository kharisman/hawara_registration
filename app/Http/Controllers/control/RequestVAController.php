<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\NicepayLib;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Payment;
use App\Models\Registration;
use App\Models\ProductBranchOption;
use App\Models\ProductBranch;
use App\Models\Product;
use App\Models\Branch;
use App\Models\Webinar;
use Ramsey\Uuid\Uuid;

class RequestVAController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

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

        public function index(Request $request)
        {
        	$nicepay = new NicepayLib();
        	function generateReference()
        	{
        		$micro_date = microtime();
        		$date_array = explode(" ", $micro_date);
        		$date = date("YmdHis", $date_array[1]);
        		$date_array[0] = preg_replace('/[^\p{L}\p{N}\s]/u', '', $date_array[0]);
        		return "PCT" . $date_array[0] . rand(100, 999);
        	}


        //$payMethod = $request->input('payMethod');
        //$referenceNo = $request->input('referenceNo');
        //$request->input('amt')
        //$nicepay->set('billingNm', 'John Doe'); // Customer name
        //$nicepay->set('billingPhone', '02112345678'); // Customer phone number
        //$nicepay->set('billingEmail', 'john@example.com'); // Customer Email
        	$payMethod = "02";
        	$fee=4400;
        	$webtime = 1440;
        	$dateExpired = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " +" . $webtime . " minutes"));
        	$referenceNo = generateReference();
        	$code_method = $request->bank;
        	$name = $request->name;
        	$email = $request->email;
        	$phone = $request->phone;
        	$total = $request->total;
        	$check = $request->check;
        	$totalPay = $total;
        	$expired_at=$dateExpired;
        	$timestamp = date('YmdHis');

        	if (isset($payMethod) && $payMethod == '02') {

            // Populate Mandatory parameters to send
        		$nicepay->set('payMethod', '02');
        		$nicepay->set('currency', 'IDR');

        		if (!isset($referenceNo) || $referenceNo == null) {
                $nicepay->set('referenceNo', generateReference()); // Invoice Number or Reference Number Generated by merchant
              } else {
              	$nicepay->set('referenceNo', $referenceNo);
              }

            $nicepay->set('amt', $totalPay); // Total gross amount
            $nicepay->set('description', 'Payment of Invoice No ' . $nicepay->get('referenceNo')); // Transaction description

            $nicepay->set('timestamp', $timestamp);
            $nicepay->set('billingNm', $name); // Customer name
            $nicepay->set('billingPhone', $phone); // Customer phone number
            $nicepay->set('billingEmail', $email); // Customer Email
            $nicepay->set('billingAddr', 'Jl. Jend. Sudirman No. 28');
            $nicepay->set('billingCity', 'Jakarta Pusat');
            $nicepay->set('billingState', 'DKI Jakarta');
            $nicepay->set('billingPostCd', '10210');
            $nicepay->set('billingCountry', 'Indonesia');

            $nicepay->set('deliveryNm', 'John Doe'); // Delivery name
            $nicepay->set('deliveryPhone', '02112345678');
            $nicepay->set('deliveryEmail', 'john@example.com');
            $nicepay->set('deliveryAddr', 'Jl. Jend. Sudirman No. 28');
            $nicepay->set('deliveryCity', 'Jakarta Pusat');
            $nicepay->set('deliveryState', 'DKI Jakarta');
            $nicepay->set('deliveryPostCd', '10210');
            $nicepay->set('deliveryCountry', 'Indonesia');
            $nicepay->set('vacctValidDt', date('Ymd',strtotime($expired_at)));
            $nicepay->set('vacctValidTm', date('His',strtotime($expired_at)));
            $nicepay->set('instmntType','1');
            $nicepay->set('reqClientVer','');
            $nicepay->set('instmntMon','');
            $nicepay->set('recurrOpt','0');
            $nicepay->set('bankCd', $code_method);
            // Send Data
            $response = $nicepay->requestVA();

            // Response from NICEPAY
            if (isset($response->resultCd) && $response->resultCd == "0000") {

            	$payment = new Payment();
            	$payment->uid = Uuid::uuid4()->getHex();
            	$payment->registration_uid = $request->uid;
            	$payment->codePay = $payMethod.'-'.$code_method;
            	$payment->noPay = $referenceNo;
            	$payment->txId = $response->tXid;
            	$payment->total = $total;
            	$payment->checkid = $check;
            	$payment->fee = 0;
            	$payment->totalPay = $totalPay;
            	$payment->status = 'waiting';
            	$payment->json = json_encode($response);
            	$payment->dateExpired = $dateExpired;
            	$payment->save();

            	$registration = Registration::where('uid','=',$request->uid)->first();

            	if($check == 0){
          			$product_branch = ProductBranch::where('uid','=',$registration->product_branch_options_uid)->first();

          			$product = Product::where('uid','=',$product_branch->product_uid)->first();

          			$branch = Branch::where('uid','=',$product_branch->branch_uid)->first();

          			$json = json_decode($payment->json);

          			$uid = json_decode(json_encode($payment->uid));

          			$product_name = $product->product_name;
            	}else{
            		$product_branch_options_uid = ProductBranchOption::where('uid','=',$registration->product_branch_options_uid)->first();
            		$count = ProductBranchOption::where('uid','=',$registration->product_branch_options_uid)->count();

            		if($count>0){
            			$product_branch = ProductBranch::where('uid','=',$product_branch_options_uid->product_branch_uid)->first();

            			$product = Product::where('uid','=',$product_branch->product_uid)->first();

            			$branch = Branch::where('uid','=',$product_branch->branch_uid)->first();

            			$json = json_decode($payment->json);

            			$uid = json_decode(json_encode($payment->uid));

            			$product_name = $product->product_name;
            		}else{
            			$product = Webinar::where('uid','=',$registration->product_branch_options_uid)->first();

            			$branch = Branch::where('uid','=',$product->branch_uid)->first();

            			$json = json_decode($payment->json);

            			$uid = json_decode(json_encode($payment->uid));

            			$product_name = $product->webinar_name;
            		}

            	}

            	$message="Hi *".$request->name."*,\nTerimakasih telah mendaftar pada program ".$product_name."(".$branch->branch_name."), informasi pembayaran silahkan klik link berikut :\n"."https://register.palcomtech.com/status/".$request->uid;


            	$msg="Hi Admin,\nAda pendaftaran baru nih pada program ".$product_name."(".$branch->branch_name.") dari ".$name." (".$phone.") dengan e-mail ".$email ;

            	$msgemail="<h5>Hi ".$request->name."</h5>
            	<p>Terima kasih telah mendaftar di PalComTech pada<br>
            	Program : ".$product_name."<br>
            	Outlet : ".$branch->branch_name."
            	Total Pembayaran : Rp ".number_format($totalPay,2,",",".")."<br>
            	Info detil pembayaran silahkan klik <a href='https://register.palcomtech.com/status/".$request->uid."'> disini </a>
            	</p>";

                //$this->sendMail($name,$email,$msgemail);
            	//$this->sendMail('Dika','dika21.pct@gmail.com',$msg);
            	$this->send_wa($phone,$message);
            	$this->send_wa($branch->phone_number,$msg);

            	$return['success'] = 'success';
            	$return['data'] = $response;
                //$return['data'] = $response->requestURL. "?optDisplayCB=1&optDisplayBL=1&tXid=" . $response->tXid;
                //$return['paynumber'] = $paynumber;

            	return response()->json($return, 200);

            } elseif (isset($response->resultCd)) {
            	$msg = $response->resultCd . ": " . $response->resultMsg;
            	$return['error'] = 'error';
            	$return['msg'] = $msg;
            	return response()->json($return, 200);
            } else {
            	$return['error'] = 'error';
            	$return['msg'] = $response;
            	return response()->json($return, 422);
                //$request->session()->flash('msg', 'Connection Timeout. Please Try Again!');
                //return redirect()->route('otherError');
            }
        } // Unknown Pay Method
        else {
        	$return['error'] = 'error';
        	$return['msg'] = 'Failed';
        	return response()->json($return, 200);
            //$request->session()->flash('msg', 'Please Set Amount, ReferenceNo and tXid.');
            //return redirect()->route('otherError');
        }


      }
    }
