<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gimmick;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class GimmickController extends Controller
{
    public function index(){
      $data = Gimmick::where('status','=','Aktif')->get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function home(){
      $data = Gimmick::get();
      return view('gimmick',['data' => $data]);
    }

    public function add(){
      return view('add_gimmick');
    }

    public function input(Request $request){
      $validator = Validator::make($request->all(), [
          'meta_description' => 'required|string|max:255|min:3',
          'gimmick_title' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3'
      ]);

      if ($validator->fails()) {

        return redirect('/home/banners/add')
          ->withErrors($validator)
          ->withInput();

      }else{

      $file = $request->thumbnail;
      $f = $file->getClientOriginalName();
      $ef = md5(microtime($f));

      $gimmick = new Gimmick();
      $gimmick->uid = Uuid::uuid4()->getHex();
      $gimmick->gimmick_title = $request->gimmick_title;
      $gimmick->meta_description = $request->meta_description;
      $gimmick->slug = SlugService::createSlug($gimmick, 'slug', $request->gimmick_title);
      $gimmick->description = $request->description;
      $gimmick->views = 0;
      $gimmick->thumbnail = url('images/'.$ef.".".$file->getClientOriginalExtension());
      $gimmick->status = 'Non Aktif';
      $gimmick->save();

      $file->move('images/',$ef.".".$file->getClientOriginalExtension());

      return redirect('/home/banners')->with('status', 'Data Berhasil Ditambahkan');
      }

    }

    public function slug($id, $slug){
      $data = Gimmick::where('slug','=',$slug)->where('uid','=',$id)->where('status','=','Aktif')->get();
      $count = $data->count();
      if($count>0){
        $return['success'] = "success";
        $return['data'] = $data;
        return response()->json($return, 200);
      }else{
        $return['success'] = "error";
        return response()->json($return, 422);
      }
    }

    public function active($uid){
      $gimmick = Gimmick::where('uid','=',$uid)
                      ->update(['status' => 'Aktif']);

      return redirect('/home/banners')->with('status', 'Data Berhasil Diaktifkan');
    }

    public function nonactive($uid){
      $gimmick = Gimmick::where('uid','=',$uid)
                      ->update(['status' => 'Non Aktif']);

      return redirect('/home/banners')->with('status', 'Data Berhasil Di Non Aktifkan');
    }

    public function preview($slug){
      $data = Gimmick::where('slug','=',$slug)->where('status','=','Aktif')->get();
      $count = $data->count();
      if($count>0){
        return view('gimmick_preview', ['data' => $data, 'count' => $count]);
      }else{
        return view('gimmick_preview', ['count' => $count]);
      }
    }

    public function edit($id){
      $gimmick = Gimmick::where('uid','=',$id)->first();
      return view('edit_gimmick',['data' => $gimmick]);
    }

    public function update_be(Request $request){
      $validator = Validator::make($request->all(), [
          'uid' => 'required',
          'meta_description' => 'required|string|max:255|min:3',
          'gimmick_title' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3'
      ]);

      if ($validator->fails()) {
        return redirect('/home/banners/edit/'.$request->uid)
          ->withErrors($validator)
          ->withInput();
      }else{

      $file = $request->thumbnail;
        if(empty($file)){
          $blog = Gimmick::where('uid',$request->uid)
                          ->update(['gimmick_title' => $request->gimmick_title, 'meta_description' => $request->meta_description, 'description' => $request->description, 'slug' => SlugService::createSlug(Gimmick::class, 'slug', $request->gimmick_title)]);

          return redirect('/home/banners')->with('status', 'Data Berhasil Diperbaharui');
        }else{
          $f = $file->getClientOriginalName();
          $ef = md5(microtime($f));

          $blog = Gimmick::where('uid',$request->uid)
                          ->update(['gimmick_title' => $request->gimmick_title, 'meta_description' => $request->meta_description,  'description' => $request->description, 'slug' => SlugService::createSlug(Gimmick::class, 'slug', $request->gimmick_title), 'thumbnail' => $request->url('images/'.$ef.".".$file->getClientOriginalExtension())]);

          $file->move('images/',$ef.".".$file->getClientOriginalExtension());

          return redirect('/home/banners')->with('status', 'Data Berhasil Diperbaharui');
        }
      }
    }

    public function destroy($uid){
      $blog = Gimmick::where('uid',$uid)->first();
      $blog->delete();

      if($blog->delete()!=1){
        return redirect('/home/banners')->with('status', 'Data Gagal Dihapus');
      }else{
        return redirect('/home/banners')->with('status', 'Data Berhasil Dihapus');
      }
    }
}
