<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Voucher;
use App\Models\Product;
use App\Models\ProductBranch;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{

    public function home(){
      $data = Voucher::with('product_branch')->get();
      return view('voucher',['data' => $data]);
    }

    public function add(){
      $data = ProductBranch::where('product_branches.branch_uid','=',Auth::user()->branch_uid)->get();
      return view('add_voucher',['data' => $data]);
    }

    public function input(Request $request){
      $validator = Validator::make($request->all(), [
          'product_branch_id' => 'required',
          'voucher_code' => 'required|string|max:255|min:3|unique:vouchers',
          'nominal' => 'required|integer',
          'useDate' => 'required',
          'expDate' => 'required',
          'quota' => 'required|integer'
      ]);

      if ($validator->fails()) {

        return redirect('/home/vouchers/add')
          ->withErrors($validator)
          ->withInput();

      }else{

      $voucher = new Voucher();
      $voucher->uid = Uuid::uuid4()->getHex();
      $voucher->product_branch_id = $request->product_branch_id;
      $voucher->voucher_code = $request->voucher_code;
      $voucher->nominal = $request->nominal;
      $voucher->useDate = $request->useDate;
      $voucher->expireDate = $request->expDate;
      $voucher->quota = $request->quota;
      $voucher->save();

      return redirect('/home/vouchers')->with('status', 'Data Berhasil Ditambahkan');
      }

    }

    public function edit($id){
			$data = Voucher::where('uid','=',$id)->get();
			$product = ProductBranch::with('product')->where('uid','=',$data[0]->product_branch_id)->get();
    	return view('edit_voucher',['data' => $data, 'product' => $product]);
    }

    public function update_be(Request $request){
      $validator = Validator::make($request->all(), [
      		'uid' => 'required',
          'product_branch_id' => 'required',
          'nominal' => 'required|integer',
          'useDate' => 'required',
          'expDate' => 'required',
          'quota' => 'required|integer'
      ]);

      if ($validator->fails()) {

        return redirect('/home/vouchers/edit/'.$request->uid)
          ->withErrors($validator)
          ->withInput();

      }else{

      $blog = Voucher::where('uid',$request->uid)
              ->update(['nominal' => $request->nominal, 'useDate' => $request->useDate, 'expireDate' => $request->expDate, 'quota' => $request->quota]);

	    return redirect('/home/vouchers')->with('status', 'Data Berhasil Diperbaharui');
      }

    }

    public function destroy($uid){
      $blog = Voucher::where('uid',$uid)->first();
      $blog->delete();

      if($blog->delete()!=1){
        return redirect('/home/vouchers')->with('status', 'Data Gagal Dihapus');
      }else{
        return redirect('/home/vouchers')->with('status', 'Data Berhasil Dihapus');
      }
    }

    public function search($id,$voucher){
	  	$data = Voucher::where('product_branch_id','=',$id)->where('voucher_code','=',$voucher)->get();
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

    public function useVoucher(Request $request){
    	$voucher = Voucher::where('product_branch_id',$request->product_branch_id)->where('voucher_code','=',$request->voucher_code)->get();
    	if($voucher[0]->quota > 0){
	    	$data = Voucher::where('product_branch_id',$request->product_branch_id)->where('voucher_code','=',$request->voucher_code)->decrement('quota', 1);
    	}
  		$return['status'] = "success";
		return response()->json($return, 200);
    }

    public function checkVoucher($uid){
      $data = Voucher::where('uid','=',$uid)->get();
      $return['status'] = "success";
      $return['data'] = $data;
    return response()->json($return, 200);
    }
}
