<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Ramsey\Uuid\Uuid;

class CategoryController extends Controller
{
    public function index(){
    	$data = Category::get();
    	$return['status'] = "success";
    	$return['data'] = $data;
      return response()->json($return, 200);
    }

    public function home(){
      $data = Category::get();
      return view('category',['data' => $data]);
    }

    public function add(){
      return view('add_category');
    }

    public function input(Request $request){
      $validator = Validator::make($request->all(), [
          'category_name' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3'
      ]);

      if ($validator->fails()) {
        
        return redirect('/home/categories/add')
          ->withErrors($validator)
          ->withInput();
      
      }else{

      $category = new Category();
      $category->uid = Uuid::uuid4()->getHex();
      $category->category_name = $request->category_name;
      $category->description = $request->description;
      $category->save();

      return redirect('/home/categories')->with('status', 'Data Berhasil Ditambahkan');
      }
      
    }

    public function product(){
      $data = Category::with('product')->get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function selectview($id){
      $data = Category::with('product')->where('uid','=',$id)->first();
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
          'category_name' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3',
      ]);

      if($validator->fails()){
          $return['status'] = 'error';
      		$return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $category = new Category;
      $category->uid = Uuid::uuid4()->getHex();
      $category->category_name = $request->category_name;
      $category->description = $request->description;
      $category->save();
      
      $return['status'] = 'success';
      return response()->json($return,200);
    }

    public function select($id){
    	$category = Category::with('product')->where('uid','=',$id)->first();
    	$count = $category->count();
      if($count<1){
      	$return['status'] = "error";
	      return response()->json($return, 422);
      }else{
	      $return['status'] = "success";
	      $return['data'] = $category;
	      return response()->json($return, 200);
      }
    }

    public function edit($id){
      $category = Category::where('uid','=',$id)->first();
      return view('edit_category',['data' => $category]);
    }

    public function update(Request $request){
    	$validator = Validator::make($request->all(), [
    			'uid' => 'required',
          'category_name' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3',
      ]);

      if($validator->fails()){
          $return['msg'] = "error";
      		$return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $category = Category::where('uid',$request->uid)
                      ->update(['category_name' => $request->category_name, 'description' => $request->description]);
      
      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function update_be(Request $request){
      $validator = Validator::make($request->all(), [
          'uid' => 'required',
          'category_name' => 'required|string|max:255|min:3',
          'description' => 'required|min:3'
      ]);

      if ($validator->fails()) {

        return redirect('/home/categories/edit/'.$request->uid)
          ->withErrors($validator)
          ->withInput();
          
      }else{
      $category = Category::where('uid',$request->uid)
                      ->update(['category_name' => $request->category_name, 'description' => $request->description]);
      return redirect('/home/categories')->with('status', 'Data Berhasil Diperbaharui');
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

      $category = Category::where('uid',$request->uid)->first();
      $category->delete();

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function destroy($uid){
        $category = Category::where('uid',$uid)->first();
        $category->delete();

        if($category->delete()!=1){
          return redirect('/home/categories')->with('status', 'Data Gagal Dihapus');
        }else{
          return redirect('/home/categories')->with('status', 'Data Berhasil Dihapus');
        }
    }  
}
