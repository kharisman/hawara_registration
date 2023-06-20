<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Library\NicepayLib;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Payment;
use App\Models\Registration;
use App\Models\Flash;
use Carbon\Carbon;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class CheckPaymentFlashController extends Controller
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

    public function __invoke(Request $request)
    {
        $date = Carbon::now();

        $txid = $request->tXid;
        $referenceNo = $request->referenceNo;
        $amt = $request->amt;
        //$pushedToken  = $request->merchantToken;
        $data = json_encode($request->all());

        $myFile = $request->referenceNo.".txt";
        $fh = fopen("catatan/".$myFile, 'a');
        fwrite($fh, $data);
        fclose($fh);

        $payment = Payment::where('txId','=',$txid)->where('status','!=','paid')->firstOrFail();

        //return $payment;
        $registration = Flash::where('phone1','=',$payment->registration_uid)->first();

        dd($registration);
        /*$nicepay = new NicepayLib();

        if(!empty($txid) && !empty($txid)){
            $nicepay->set('tXid', $txid);
            $nicepay->set('referenceNo', $referenceNo);
            $nicepay->set('amt', $amt);
            $merchantToken = hash('sha256',(json_decode($json->transTm).NICEPAY_IMID.$referenceNo.$amt.NICEPAY_MERCHANT_KEY));
            $nicepay->set('merchantToken', $merchantToken);
            $nicepay->set('iMid', NICEPAY_IMID);

            //echo $merchantToken;
            
            $paymentStatus = $nicepay->checkPaymentStatus($txid, $referenceNo, $amt);

			print_r($paymentStatus);

            //echo $paymentStatus;
            
            //if($pushedToken == $merchantToken){
              /*if(isset($paymentStatus->status) && $paymentStatus->status == '0'){
                $return['success'] = 'success';
                $return['data'] = 'Paid';
                return response()->json($return,200);*/

              /*if (isset($paymentStatus->status) && $paymentStatus->status == '0') {
                $up = Payment::where('uid','=',$uid)->update(['status' => 'paid','datePay' => $date]);
                if($up){
                    $message = "Hi *".$registration->name."*,\nTerimakasih telah melakukan pembayaran sebesar Rp ".number_format($json->amount,0,',','.')." untuk produk Flash Sale PalComTech, anda akan segera dihubungi oleh pihak admin kami";
                    $message2 = "*Transaksi Masuk*\n\nKode Transaksi: ".$payment->noPay."\nNama: ".$registration->name."\nEmail: ".$registration->email."\nNo HP: ".$registration->phone1."\nProgram: ".$registration->prodi."\nTotal: Rp ".number_format($json->amount,0,',','.');
                    $message3 = '
                    <h3>Transaksi Masuk</h3>
                    Kode Transaksi: '.$payment->noPay.'<br>
                    Nama: '.$registration->name.'<br>
                    Email: '.$registration->email.'<br>
                    No HP: '.$registration->phone1.'<br>
                    Program Studi: '.$registration->prodi.'<br>
                    Total: Rp '.number_format($json->amount,0,',','.');

                    //echo 'ok';
                    
                    $this->sendMail('Dika','dika21.pct@gmail.com',$message3);
                    $this->sendMail('Elis','elis14.pct@gmail.com',$message3);
					//$this->sendMail('Ray','idmusic93@gmail.com',$message3);
                    
                    $this->send_wa('6281271788080',$message2);
                    //$this->send_wa('628117100120',$message2);
                    $this->send_wa($registration->phone1,$message);
                    //$this->send_wa($registration->phone,$message2);
                    //echo "success";
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

        /*} else {
            echo 'aaaaaaa';
        }*/
    }
}
