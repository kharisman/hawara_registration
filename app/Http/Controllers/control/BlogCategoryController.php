<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BlogCategory;
use Ramsey\Uuid\Uuid;

class BlogCategoryController extends Controller
{

    public function index(){
    	$data = BlogCategory::get();
    	$return['status'] = "success";
    	$return['data'] = $data;
      return response()->json($return, 200);
    }

    public function home(){
      $data = BlogCategory::get();
      return view('blog_category',['data' => $data]);
    }

    public function add(){
      return view('add_blog_category');
    }

    public function viewlesson(){
      $data = BlogCategory::with('product')->get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function selectview($id){
      $data = BlogCategory::with('product')->where('uid','=',$id)->first();
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

    public function input(Request $request){
      $validator = Validator::make($request->all(), [
          'category_name' => 'required|string|max:255|min:3|unique:categories'
      ]);

      if ($validator->fails()) {

        return redirect('/home/blog-categories/add')
          ->withErrors($validator)
          ->withInput();

      }else{

      $category = new BlogCategory();
      $category->uid = Uuid::uuid4()->getHex();
      $category->category_name = $request->category_name;
      $category->save();

      return redirect('/home/blog-categories')->with('status', 'Data Berhasil Ditambahkan');
      }

    }

    public function create(Request $request){
    	$validator = Validator::make($request->all(), [
          'category_name' => 'required|string|max:255|min:3|unique:categories'
      ]);

      if($validator->fails()){
          $return['status'] = 'error';
      		$return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $category = new BlogCategory;
      $category->uid = Uuid::uuid4()->getHex();
      $category->category_name = $request->category_name;
      $category->save();

      $return['status'] = 'success';
      return response()->json($return,200);
    }

    public function select($id){
    	$category = BlogCategory::where('uid','=',$id)->first();
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
      $category = BlogCategory::where('uid','=',$id)->first();
      return view('edit_blog_category',['data' => $category]);

    }

    public function update(Request $request){
      $validator = Validator::make($request->all(), [
          'uid' => 'required',
          'category_name' => 'required|string|max:255|min:3'
      ]);

      if($validator->fails()){
          return view('edit_blog_category',['data' => $validator]);
      }

      $category = BlogCategory::where('uid',$request->uid)
                      ->update(['category_name' => $request->category_name]);

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function update_be(Request $request){
    	$validator = Validator::make($request->all(), [
    			'uid' => 'required',
          'category_name' => 'required|string|max:255|min:3'
      ]);

      if ($validator->fails()) {
        return redirect('/home/blog-categories/edit/'.$request->uid)
          ->withErrors($validator)
          ->withInput();
      }else{
      $category = BlogCategory::where('uid',$request->uid)
                      ->update(['category_name' => $request->category_name]);
      return redirect('/home/blog-categories')->with('status', 'Data Berhasil Diperbaharui');
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

      $category = BlogCategory::where('uid',$request->uid)->first();
      $category->delete();

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function destroy($uid){
        $category = BlogCategory::where('uid',$uid)->first();
        $category->delete();

        if($category->delete()!=1){
          return redirect('/home/blog-categories')->with('status', 'Data Gagal Dihapus');
        }else{
          return redirect('/home/blog-categories')->with('status', 'Data Berhasil Dihapus');
        }
    }
}
