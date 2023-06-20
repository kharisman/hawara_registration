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
use Carbon\Carbon;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class CheckPaymentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
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
        $date = Carbon::now();

        $txid = $request->tXid;
        $referenceNo = $request->referenceNo;
        $amt = $request->amt;
        //$pushedToken  = $request->merchantToken;
        $data = json_encode($request->all());

        $refno = substr($request->referenceNo,0,8);

        $myFile = $request->referenceNo.".txt";
        $fh = fopen("catatan/".$myFile, 'a');
        fwrite($fh, $data);
        fclose($fh);

        $payment = Payment::where('txId','=',$txid)->where('status','!=','paid')->firstOrFail();

        $registration = Registration::where('uid','=',$payment->registration_uid)->first();

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

        $nicepay = new NicepayLib();

        if(!empty($txid) && !empty($txid)){
            $nicepay->set('tXid', $txid);
            $nicepay->set('referenceNo', $referenceNo);
            $nicepay->set('amt', $amt);
            $merchantToken = hash('sha256',(json_decode($json->transTm).NICEPAY_IMID.$referenceNo.$amt.NICEPAY_MERCHANT_KEY));
            $nicepay->set('merchantToken', $merchantToken);
            $nicepay->set('iMid', NICEPAY_IMID);

            //echo $merchantToken;

            $paymentStatus = $nicepay->checkPaymentStatus($txid, $referenceNo, $amt);
            

			//print_r($paymentStatus);

            //echo $paymentStatus;

            //if($pushedToken == $merchantToken){
              /*if(isset($paymentStatus->status) && $paymentStatus->status == '0'){
                $return['success'] = 'success';
                $return['data'] = 'Paid';
                return response()->json($return,200);*/

              if (isset($paymentStatus->status) && $paymentStatus->status == '0') {
                $up = Payment::where('uid','=',$uid)->update(['status' => 'paid','datePay' => $date]);
                if($up){
                  if($refno=='PCTFlash'){
                    $message = "Hi *".$registration->name."*,\nTerimakasih telah melakukan pembayaran sebesar Rp ".number_format($json->amount,0,',','.')." untuk pendaftaran online di Institut Teknologi dan Bisnis PalComTech.\n\nAnda akan segera dihubungi oleh pihak admin kami";
                    $message2 = "*Transaksi Masuk*\n\nKode Transaksi: ".$payment->noPay."\nNama: ".$registration->name."\nEmail: ".$registration->email."\nNo HP: ".$registration->phone."\nProgram: Flash Sale Institut Teknologi dan Bisnis PalComTech)\nTotal: Rp ".number_format($json->amount,0,',','.');
                    $message3 = '
                    <h3>Transaksi Masuk</h3>
                    Kode Transaksi: '.$payment->noPay.'<br>
                    Nama: '.$registration->name.'<br>
                    Email: '.$registration->email.'<br>
                    No HP: '.$registration->phone.'<br>
                    Program: Flash Sale Institusi Teknologi dan Bisnis PalComTech.<br>
                    Total: Rp '.number_format($json->amount,0,',','.');

                    //echo 'ok';

                    $this->sendMail('Dika','dika21.pct@gmail.com',$message3);
                    //$this->sendMail('Elis','elis14.pct@gmail.com',$message3);
					          //$this->sendMail('Ray','idmusic93@gmail.com',$message3);

                    $this->send_wa($branch->phone_number,$message2);
                    $this->send_wa('628117100120',$message2);
                    $this->send_wa($registration->phone,$message);
                    //$this->send_wa($registration->phone,$message2);
                    //echo "success";
                  }else{
                    $message = "Hi *".$registration->name."*,\nTerimakasih telah melakukan pembayaran sebesar Rp ".number_format($json->amount,0,',','.')." untuk produk ".$product_name." (".$branch->branch_name."), anda akan segera dihubungi oleh pihak admin kami";
                    $message2 = "*Transaksi Masuk*\n\nKode Transaksi: ".$payment->noPay."\nNama: ".$registration->name."\nEmail: ".$registration->email."\nNo HP: ".$registration->phone."\nProgram: ".$product_name."(".$branch->branch_name.")\nTotal: Rp ".number_format($json->amount,0,',','.');
                    $message3 = '
                    <h3>Transaksi Masuk</h3>
                    Kode Transaksi: '.$payment->noPay.'<br>
                    Nama: '.$registration->name.'<br>
                    Email: '.$registration->email.'<br>
                    No HP: '.$registration->phone.'<br>
                    Program: '.$product_name.'('.$branch->branch_name.')<br>
                    Total: Rp '.number_format($json->amount,0,',','.');

                    //echo 'ok';

                    $this->sendMail('Dika','dika21.pct@gmail.com',$message3);
                    //$this->sendMail('PalComTech','Financeho.pct@gmail.com',$message3);
					          //$this->sendMail('Ray','idmusic93@gmail.com',$message3);

                    //$this->send_wa($branch->phone_number,$message2);
                    $this->send_wa('6281271788080',$message2);
                    $this->send_wa($registration->phone,$message);
                    //$this->send_wa($registration->phone,$message2);
                    //echo "success";
                  }
                    
                }else{
                  echo "error 1";
                }
              }else if (isset($paymentStatus->status) && $paymentStatus->status == '4') {
                $up1 = Payment::where('uid','=',$uid)->update(['status' => 'expired']);
                if($up1){
                  $return['success'] = 'success';
                  $return['data'] = 'Expired';
                  return response()->json($return,200);
                }else{
                  echo "error";
                }

              }else{
                echo "error A";
              }
            //}else{
            //    echo 'error B';
            //}*/

        } else {
            echo 'aaaaaaa';
        }
    }
}
