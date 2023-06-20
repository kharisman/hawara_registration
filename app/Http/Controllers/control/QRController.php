<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\QRCode;
use App\Models\QRCustomer;
use App\Models\QRGift;
use App\Models\QRMerchant;

class QRController extends Controller
{
    public function Voucherindex(){
        $qr = QRCode::with('merchant')->orderBy('id','DESC')->get();
        return view('view_voucher')->with(['qr'=>$qr]);
    }

    public function Customerindex(){
        $qr = QRCustomer::with('code')->with('gift')->orderBy('id','DESC')->get();
        return view('view_customer')->with(['qr'=>$qr]);
    }

    public function indexMerchant(){
        $qr = QRMerchant::orderBy('id','DESC')->get();
        return view('view_merchant')->with(['qr'=>$qr]);
    }

    public function addMerchant(){
        return view('add_merchant');
    }

    public function inputMerchant(Request $request){
        $validator = Validator::make($request->all(), [
          'name' => 'required'
      ]);

      if ($validator->fails()) {

        return redirect('/home/Merchant/add')
          ->withErrors($validator)
          ->withInput();

      }else{

      $file = $request->logo;
      $f = $file->getClientOriginalName();
      $ef = md5(microtime($f));

      $merchant = new QRMerchant();
      $merchant->name = $request->name;
      $merchant->logo = url('images/'.$ef.".".$file->getClientOriginalExtension());
      $merchant->save();

      $file->move('images/',$ef.".".$file->getClientOriginalExtension());

      return redirect('/home/Merchant')->with('status', 'Data Berhasil Ditambahkan');
      }
    }

    public function editMerchant($id){
      $merchant = QRMerchant::where('id','=',$id)->first();
      return view('edit_merchant',['data' => $merchant]);
    }

    public function updateMerchant(Request $request){
      $validator = Validator::make($request->all(), [
          'name' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect('/home/Merchant/edit/'.$request->id)
          ->withErrors($validator)
          ->withInput();
      }else{

      $file = $request->logo;
        if(empty($file)){
          $merchant = QRMerchant::where('id',$request->id)
                          ->update(['name' => $request->name]);

          return redirect('/home/Merchant')->with('status', 'Data Berhasil Diperbaharui');
        }else{
          $f = $file->getClientOriginalName();
          $ef = md5(microtime($f));

          $merchant = QRMerchant::where('id',$request->id)
                          ->update(['name' => $request->name, 'logo' => url('images/'.$ef.".".$file->getClientOriginalExtension())]);

          $file->move('images/',$ef.".".$file->getClientOriginalExtension());

          return redirect('/home/Merchant')->with('status', 'Data Berhasil Diperbaharui');
        }
      }
    }

    public function destroyMerchant($id){
      $merchant = QRMerchant::where('id',$id)->first();
      $merchant->delete();

      if($merchant->delete()!=1){
        return redirect('/home/Merchant')->with('status', 'Data Gagal Dihapus');
      }else{
        return redirect('/home/Merchant')->with('status', 'Data Berhasil Dihapus');
      }
    }

    public function indexGift(){
        $qr = QRGift::with('merchant')->orderBy('id','DESC')->get();
        return view('view_gift')->with(['qr'=>$qr]);
    }

    public function addGift(){
        $merchant = QRMerchant::get();
        return view('add_gift')->with(['merchant'=>$merchant]);
    }

    public function inputGift(Request $request){
        $validator = Validator::make($request->all(), [
          'qrmerchant_id' => 'required',
          'name' => 'required',
          'description' => 'required',
          'stock' => 'required|min:0',
          'expired' => 'required'
      ]);

      if ($validator->fails()) {

        return redirect('/home/Gift/add')
          ->withErrors($validator)
          ->withInput();

      }else{

      $file = $request->image;
      $f = $file->getClientOriginalName();
      $ef = md5(microtime($f));

      $gift = new QRGift();
      $gift->qrmerchant_id = $request->qrmerchant_id;
      $gift->name = $request->name;
      $gift->description = $request->description;
      $gift->stock = $request->stock;
      $gift->expired = $request->expired;
      $gift->used = $request->used;
      $gift->status = 1;
      $gift->image = url('images/'.$ef.".".$file->getClientOriginalExtension());
      $gift->save();

      $file->move('images/',$ef.".".$file->getClientOriginalExtension());

      return redirect('/home/Gift')->with('status', 'Data Berhasil Ditambahkan');
      }
    }

    public function editGift($id){
      $gift = QRGift::where('id','=',$id)->first();
      $merchant = QRMerchant::get();
      return view('edit_gift',['data' => $gift, 'merchant' => $merchant]);
    }

    public function updateGift(Request $request){
      $validator = Validator::make($request->all(), [
          'qrmerchant_id' => 'required',
          'name' => 'required',
          'description' => 'required',
          'stock' => 'required|min:0',
          'expired' => 'required',
          'status' => 'required'
      ]);

      if ($validator->fails()) {
        return redirect('/home/Gift/edit/'.$request->id)
          ->withErrors($validator)
          ->withInput();
      }else{

      $file = $request->logo;
        if(empty($file)){
          $gift = QRGift::where('id',$request->id)
                          ->update([
                            'qrmerchant_id' => $request->qrmerchant_id,
                            'name' => $request->name,
                            'description' => $request->description,
                            'stock' => $request->stock,
                            'expired' => $request->expired,
                            'used' => $request->used,
                            'status' => $request->status
                          ]);

          return redirect('/home/Gift')->with('status', 'Data Berhasil Diperbaharui');
        }else{
          $f = $file->getClientOriginalName();
          $ef = md5(microtime($f));

          $gift = QRGift::where('id',$request->id)
                          ->update([
                            'qrmerchant_id' => $request->qrmerchant_id,
                            'name' => $request->name,
                            'description' => $request->description,
                            'stock' => $request->stock,
                            'expired' => $request->expired,
                            'used' => $request->used,
                            'status' => $request->status,
                            'logo' => url('images/'.$ef.".".$file->getClientOriginalExtension())]);

          $file->move('images/',$ef.".".$file->getClientOriginalExtension());

          return redirect('/home/Gift')->with('status', 'Data Berhasil Diperbaharui');
        }
      }
    }

    public function destroyGift($id){
      $gift = QRGift::where('id',$id)->first();
      $gift->delete();

      if($gift->delete()!=1){
        return redirect('/home/Gift')->with('status', 'Data Gagal Dihapus');
      }else{
        return redirect('/home/Gift')->with('status', 'Data Berhasil Dihapus');
      }
    }
}
