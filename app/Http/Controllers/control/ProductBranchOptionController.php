<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductBranchOption;
use App\Models\ProductBranch;
use App\Models\Product;
use App\Models\Branch;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;

class ProductBranchOptionController extends Controller
{
    public function index(){
      $data = ProductBranchOption::with('product_branch')->get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function product_branch($id){
      $data = ProductBranchOption::with('product_branch')->where('product_branch_uid','=',$id)->get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function home(){
        $user = User::select('branch_uid')->where('id',auth()->id())->first();
        $pb = ProductBranch::select('uid','product_uid')->where('branch_uid',$user->branch_uid)->get();
        foreach ($pb as $key => $value) {
            $product[$key] = Product::select('product_name')->where('uid','=',$value->product_uid)->first();

            $productbranchoptions[$key] = ProductBranchOption::select('option_name')->where('product_branch_uid','=',$value->uid)->first();
            //echo $product[$key];
            $data = [
                'product' => $product,
                'pbo' => $productbranchoptions,
            ];
        }
        //dd($productbranchoptions);
      return view('branch_product_option',['data' => $data]);
    }

    public function add(){
      $product = ProductBranch::with('product')->get();
      return view('add_option_product',['product' => $product]);
    }

    public function input(Request $request){
      $validator = Validator::make($request->all(), [
          'branch_product_uid' => 'required',
          'option_name' => 'required',
          'option_price' => 'required'
      ]);

      if ($validator->fails()) {

        return redirect('/home/option_products/add')
          ->withErrors($validator)
          ->withInput();

      }else{

      $option_product = new ProductBranchOption();
      $option_product->uid = Uuid::uuid4()->getHex();
      $option_product->product_branch_uid = $request->branch_product_uid;
      $option_product->option_name = $request->option_name;
      $option_product->option_price = $request->option_price;
      $option_product->save();

      return redirect('/home/option_products')->with('status', 'Data Berhasil Ditambahkan');
      }

    }

    public function edit($id){
      $data = ProductBranchOption::with('product_branch')->where('uid','=',$id)->first();
      $pb = ProductBranch::where('uid','=',$data->product_branch_uid)->first();
      $product = Product::where('uid','=',$pb->product_uid)->first();
      return view('edit_option_product',['data' => $data,'product' => $product, 'pb' => $pb]);
    }

    public function update_be(Request $request){
      $validator = Validator::make($request->all(), [
          'branch_product_uid' => 'required',
          'option_name' => 'required',
          'option_price' => 'required'
      ]);

      if ($validator->fails()) {

        return redirect('/home/option_products/edit/'.$request->uid)
          ->withErrors($validator)
          ->withInput();

      }else{

      $branch = ProductBranchOption::where('uid',$request->uid)
                      ->update(['product_branch_uid' => $request->branch_product_uid, 'option_name' => $request->option_name, 'option_price' => $request->option_price]);

      return redirect('/home/option_products')->with('status', 'Data Berhasil Diperbaharui');
      }

    }


    public function select($id){
      $product = ProductBranchOption::where('uid','=',$id)->first();
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

    public function selectcheck($id){
      $product = ProductBranch::where('uid','=',$id)->first();
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
}
