<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
    	$data = Product::with('category')->get();
    	$return['status'] = "success";
    	$return['data'] = $data;
      return response()->json($return, 200);
    }

    public function random(){
      $data = Product::with('category')->inRandomOrder()->limit('5')->get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function home(){
      $data = Product::get();
      return view('product',['data' => $data]);
    }

    public function add(){
      $data = Category::get();
      return view('add_product',['data' => $data]);
    }

    public function input(Request $request){
      $validator = Validator::make($request->all(), [
          'category_uid' => 'required',
          'product_name' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3',
          'facility' => 'required|string|min:3',
          'landing_price' => 'required|integer',
          'discount' => 'required|integer'
      ]);

      if ($validator->fails()) {
        
        return redirect('/home/products/add')
          ->withErrors($validator)
          ->withInput();
      
      }else{

      $file = $request->image;
      $f = $file->getClientOriginalName();
      $ef = md5(microtime($f));

      $product = new Product();
      $product->uid = Uuid::uuid4()->getHex();
      $product->category_uid = $request->category_uid;
      $product->product_name = $request->product_name;
      $product->description = $request->description;
      $product->facility = $request->facility;
      $product->landing_price = $request->landing_price;
      $product->discount = $request->discount;
      $product->image = url('images/'.$ef.".".$file->getClientOriginalExtension());
      $product->save();

      $file->move('images/',$ef.".".$file->getClientOriginalExtension());

      return redirect('/home/products')->with('status', 'Data Berhasil Ditambahkan');
      }
      
    }


    public function create(Request $request){
    	$validator = Validator::make($request->all(), [
          'product_name' => 'required|string|max:255|min:3|unique:products',
          'category_uid' => 'required',
          'description' => 'required|string|min:3',
          'facility' => 'required|string|min:3',
          'landing_price' => 'required|integer',
          'discount' => 'required|integer'
      ]);

      if($validator->fails()){
          $return['status'] = 'error';
      		$return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $file = $request->image;
      $f = $file->getClientOriginalName();
      $ef = md5(microtime($f));

      $product = new Product;
      $product->uid = Uuid::uuid4()->getHex();
      $product->category_uid = $request->category_uid;
      $product->product_name = $request->product_name;
      $product->description = $request->description;
      $product->facility = $request->facility;
      $product->landing_price = $request->landing_price;
      $product->discount = $request->discount;
      $product->image = url('images/'.$ef.".".$file->getClientOriginalExtension());
      $product->save();

      $file->move('images/',$ef.".".$file->getClientOriginalExtension());
      
      $return['status'] = 'success';
      return response()->json($return,200);
    }

    public function select($id){
    	$product = Product::where('uid','=',$id)->first();
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
      $product = Product::where('uid','=',$id)->first();
      $category = Category::get();
      return view('edit_product',['data' => $product, 'category' => $category]);
    }

    public function update(Request $request){
    	$validator = Validator::make($request->all(), [
    			'uid' => 'required',
          'category_uid' => 'required',
          'product_name' => 'required|string|max:255|min:3|unique:products',
          'description' => 'required|string|min:3',
          'facility' => 'required|string|min:3',
          'landing_price' => 'required|integer',
          'discount' => 'required|integer'
      ]);

      $file = $request->image;
      $f = $file->getClientOriginalName();
      $ef = md5(microtime($f));

      if($validator->fails()){
          $return['msg'] = "error";
      		$return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $product = Product::where('uid',$request->uid)
                      ->update(['category_uid' => $request->category_uid, 'product_name' => $request->product_name, 'description' => $request->description, 'facility' => $request->facility, 'landing_price' => $request->landing_price, 'discount' => $request->discount, 'image' => url('images/'.$ef.".".$file->getClientOriginalExtension())]);
      
      $file->move('images/',$ef.".".$file->getClientOriginalExtension());

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function update_be(Request $request){
      $validator = Validator::make($request->all(), [
          'uid' => 'required',
          'category_uid' => 'required',
          'product_name' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3',
          'facility' => 'required|string|min:3',
          'landing_price' => 'required|integer',
          'discount' => 'required|integer'
      ]);

      if ($validator->fails()) {

        return redirect('/home/products/edit/'.$request->uid)
          ->withErrors($validator)
          ->withInput();
          
      }else{
      $file = $request->image;
        if(empty($file)){
          $product = Product::where('uid',$request->uid)
                      ->update(['category_uid' => $request->category_uid, 'product_name' => $request->product_name, 'description' => $request->description, 'facility' => $request->facility, 'landing_price' => $request->landing_price, 'discount' => $request->discount]);
          return redirect('/home/products')->with('status', 'Data Berhasil Diperbaharui');
        }else{
          $f = $file->getClientOriginalName();
          $ef = md5(microtime($f));

          $product = Product::where('uid',$request->uid)
                      ->update(['category_uid' => $request->category_uid, 'product_name' => $request->product_name, 'description' => $request->description, 'facility' => $request->facility, 'landing_price' => $request->landing_price, 'discount' => $request->discount, 'image' => url('images/'.$ef.".".$file->getClientOriginalExtension())]);

      $file->move('images/',$ef.".".$file->getClientOriginalExtension());

      return redirect('/home/products')->with('status', 'Data Berhasil Diperbaharui');
        }
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

      $product = Product::where('uid',$request->uid)->first();
      $product->delete();

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function destroy($uid){
      $product = Product::where('uid',$uid)->first();
      $product->delete();

      if($product->delete()!=1){
        return redirect('/home/products')->with('status', 'Data Gagal Dihapus');
      }else{
        return redirect('/home/products')->with('status', 'Data Berhasil Dihapus');
      }
    }  
}
