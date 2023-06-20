<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductBranch;
use App\Models\Branch;
use App\Models\Product;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;

class ProductBranchController extends Controller
{
    public function index(){
      $data = ProductBranch::with('product')->with('branch')->get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function home(){
      $data = ProductBranch::whereHas('product', function ($query) {
    	return $query->where('deleted_at', '=', NULL);
    	})->with('product')->with('branch')->get();
      return view('branch_product',['data' => $data]);
    }

    public function product($id){
      $data = ProductBranch::with('branch')->where('product_uid','=',$id)->get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function add(){
      $product = Product::get();
      $branch = Branch::get();
      return view('add_branch_product',['product' => $product, 'branch' => $branch]);
    }

    public function input(Request $request){
      $validator = Validator::make($request->all(), [
          'product_uid' => 'required',
          'branch_uid' => 'required'
      ]);

      if ($validator->fails()) {
        
        return redirect('/home/branch_products/add')
          ->withErrors($validator)
          ->withInput();
      
      }else{

      $branch_product = new ProductBranch();
      $branch_product->uid = Uuid::uuid4()->getHex();
      $branch_product->product_uid = $request->product_uid;
      $branch_product->branch_uid = $request->branch_uid;
      $branch_product->initial_price = 0;
      $branch_product->registration_price = 0;
      $branch_product->product_price = 0;
      $branch_product->save();

      return redirect('/home/branch_products')->with('status', 'Data Berhasil Ditambahkan');
      }
      
    }

    public function selectview($id){
      $data = ProductBranch::with('product')->with('branch')->where('uid','=',$id)->first();
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

    public function select_pro($id1,$id2){
      $data = ProductBranch::with('product')->with('branch')->where('product_uid','=',$id1)->where('branch_uid','=',$id2)->first();
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

    public function create(Request $request){
      $validator = Validator::make($request->all(), [
          'product_uid' => 'required',
          'branch_uid' => 'required',
          'initial_price' => 'required|integer',
          'registration_price' => 'required|integer'
      ]);

      if($validator->fails()){
          $return['status'] = 'error';
          $return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $file = $request->image;
      $f = $file->getClientOriginalName();
      $ef = md5(microtime($f));

      $product = new ProductBranch;
      $product->uid = Uuid::uuid4()->getHex();
      $product->product_uid = $request->product_uid;
      $product->branch_uid = $request->branch_uid;
      $product->initial_price = $request->initial_price;
      $product->registration_price = $request->registration_price;
      $product->image = url('images/'.$ef.".".$file->getClientOriginalExtension());
      $product->save();

      $file->move('images/',$ef.".".$file->getClientOriginalExtension());
      
      $return['status'] = 'success';
      return response()->json($return,200);
    }

    public function select($id){
      $product = ProductBranch::where('uid','=',$id)->with('product')->with('branch')->first();
      $count = $product->count();
      if($count<1){
        $return['status'] = "error";
        return response()->json($return, 422);
      }else{
        $return['status'] = "success";
        $return['data'] = $product;
        return response()->json($return, 200);
      }
    }

    public function edit($id){
      $branch_product = ProductBranch::where('uid','=',$id)->first();
      $branch = Branch::get();
      $product = Product::get();
      return view('edit_branch_product',['data' => $branch_product, 'branch' => $branch, 'product' => $product]);
    }

    public function update(Request $request){
      $validator = Validator::make($request->all(), [
          'uid' => 'required',
          'product_uid' => 'required',
          'branch_uid' => 'required',
          'initial_price' => 'required|integer',
          'registration_price' => 'required|integer',
          'product_price' => 'required|integer'
      ]);

      $file = $request->image;
      $f = $file->getClientOriginalName();
      $ef = md5(microtime($f));

      if($validator->fails()){
          $return['msg'] = "error";
          $return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $product = ProductBranch::where('uid',$request->uid)
                      ->update(['product_uid' => $request->product_uid, 'branch_uid' => $request->branch_uid, 'initial_price' => $request->initial_price, 'registration_price' => $request->registration_price, 'image' => url('images/'.$ef.".".$file->getClientOriginalExtension())]);
      
      $file->move('images/',$ef.".".$file->getClientOriginalExtension());

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function update_be(Request $request){
      $validator = Validator::make($request->all(), [
          'uid' => 'required',
          'branch_uid' => 'required',
          'product_uid' => 'required',
          'initial_price' => 'required|integer',
          'registration_price' => 'required|integer',
          'product_price' => 'required|integer'
      ]);

      if ($validator->fails()) {

        return redirect('/home/branch_products/edit/'.$request->uid)
          ->withErrors($validator)
          ->withInput();
          
      }else{
        $branch_product = ProductBranch::where('uid',$request->uid)
                    ->update(['branch_uid' => $request->branch_uid, 'product_uid' => $request->product_uid, 'initial_price' => $request->initial_price, 'registration_price' => $request->registration_price, 'product_price' => $request->product_price]);
        return redirect('/home/branch_products')->with('status', 'Data Berhasil Diperbaharui');
      }
    }

    public function delete(Request $request){
      $validator = Validator::make($request->all(), [
          'uid' => 'required',
      ]);

      if($validator->fails()){
          $return['status'] = "error";
          $return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $product = ProductBranch::where('uid',$request->uid)->first();
      $product->delete();

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function destroy($uid){
      $product_branch = ProductBranch::where('uid',$uid)->first();
      $product_branch->delete();

      if($product_branch->delete()!=1){
        return redirect('/home/branch_products')->with('status', 'Data Gagal Dihapus');
      }else{
        return redirect('/home/branch_products')->with('status', 'Data Berhasil Dihapus');
      }
    }  
}
