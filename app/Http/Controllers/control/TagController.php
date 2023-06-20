<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use App\Models\Tag;

class TagController extends Controller
{
    
    public function index(){
    	$data = Tag::get();
    	$return['status'] = "success";
    	$return['data'] = $data;
      return response()->json($return, 200);
    }

    public function home(){
      $data = Tag::get();
      return view('tag',['data' => $data]);
    }

    public function add(){
      return view('add_tag');
    }

    public function input(Request $request){
      $validator = Validator::make($request->all(), [
          'tag_name' => 'required|string|max:255|min:3|unique:tags'
      ]);

      if ($validator->fails()) {
        
        return redirect('/home/tags/add')
          ->withErrors($validator)
          ->withInput();
      
      }else{
      
      $tag = new Tag();
      $tag->uid = Uuid::uuid4()->getHex();
      $tag->tag_name = $request->tag_name;
      $tag->save();

      return redirect('/home/tags')->with('status', 'Data Berhasil Ditambahkan');
      }
      
    }

    public function edit($id){
      $tag = Tag::where('uid','=',$id)->first();
      return view('edit_tag',['data' => $tag]);
      
    }

    public function update_be(Request $request){
    	$validator = Validator::make($request->all(), [
    			'uid' => 'required',
          'tag_name' => 'required|string|max:255|min:3'
      ]);

      if ($validator->fails()) {
        return redirect('/home/tags/edit/'.$request->uid)
          ->withErrors($validator)
          ->withInput();
      }else{
      $tag = Tag::where('uid',$request->uid)
                      ->update(['tag_name' => $request->tag_name]);
      return redirect('/home/tags')->with('status', 'Data Berhasil Diperbaharui');
      }
    }

    public function destroy($uid){
        $tag = Tag::where('uid',$uid)->first();
        $tag->delete();

        if($tag->delete()!=1){
          return redirect('/home/tags')->with('status', 'Data Gagal Dihapus');
        }else{
          return redirect('/home/tags')->with('status', 'Data Berhasil Dihapus');
        }
    }  
}
