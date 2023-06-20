<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PromoController extends Controller
{
    public function index(){
    $data = Promo::where('status','=','Aktif')->get();
    $return['status'] = "success";
    $return['data'] = $data;
    return response()->json($return, 200);
    }

    public function random(){
      $data = Promo::where('status','=','Aktif')->inRandomOrder()->limit('1')->get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function select($id){
      $promo = Promo::where('uid','=',$id)->first();
      $count = $promo->count();
      if($count<1){
        $return['status'] = "error";
        return response()->json($return, 422);
      }else{
        $return['status'] = "success";
        $return['data'] = $promo;
        return response()->json($return, 200);
      }
    }

    public function home(){
      $data = Promo::get();
      return view('promo',['data' => $data]);
    }

    public function add(){
      return view('add_promo');
    }

    public function input(Request $request){
      $validator = Validator::make($request->all(), [
          'meta_description' => 'required|string|max:255|min:3',
          'promo_title' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3'
      ]);

      if ($validator->fails()) {

        return redirect('/home/promos/add')
          ->withErrors($validator)
          ->withInput();

      }else{

      $file = $request->thumbnail;
      $f = $file->getClientOriginalName();
      $ef = md5(microtime($f));

      $promo = new Promo();
      $promo->uid = Uuid::uuid4()->getHex();
      $promo->promo_title = $request->promo_title;
      $promo->meta_description = $request->meta_description;
      $promo->slug = SlugService::createSlug($promo, 'slug', $request->promo_title);
      $promo->description = $request->description;
      $promo->views = 0;
      $promo->thumbnail = url('images/'.$ef.".".$file->getClientOriginalExtension());
      $promo->status = 'Non Aktif';
      $promo->save();

      $file->move('images/',$ef.".".$file->getClientOriginalExtension());

      return redirect('/home/promos')->with('status', 'Data Berhasil Ditambahkan');
      }

    }

    public function slug($id, $slug){
      $data = Promo::where('uid','=',$id)->where('slug','=',$slug)->where('status','=','Aktif')->get();
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
      $promo = Promo::where('uid','=',$uid)
                      ->update(['status' => 'Aktif']);

      return redirect('/home/promos')->with('status', 'Data Berhasil Diaktifkan');
    }

    public function nonactive($uid){
      $promo = Promo::where('uid','=',$uid)
                      ->update(['status' => 'Non Aktif']);

      return redirect('/home/promos')->with('status', 'Data Berhasil Di Non Aktifkan');
    }

    public function preview($slug){
      $data = Promo::where('slug','=',$slug)->where('status','=','Aktif')->get();
      $count = $data->count();
      if($count>0){
        return view('promo_preview', ['data' => $data, 'count' => $count]);
      }else{
        return view('blog_preview', ['count' => $count]);
      }
    }

    public function edit($id){
      $promo = Promo::where('uid','=',$id)->first();
      return view('edit_promo',['data' => $promo]);
    }

    public function update_be(Request $request){
      $validator = Validator::make($request->all(), [
          'uid' => 'required',
          'meta_description' => 'required|string|max:255|min:3',
          'promo_title' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3'
      ]);

      if ($validator->fails()) {
        return redirect('/home/promos/edit/'.$request->uid)
          ->withErrors($validator)
          ->withInput();
      }else{

      $file = $request->thumbnail;
        if(empty($file)){
          $blog = Promo::where('uid',$request->uid)
                          ->update(['promo_title' => $request->promo_title, 'meta_description' => $request->meta_description, 'description' => $request->description, 'slug' => SlugService::createSlug(Promo::class, 'slug', $request->promo_title)]);

          return redirect('/home/promos')->with('status', 'Data Berhasil Diperbaharui');
        }else{
          $f = $file->getClientOriginalName();
          $ef = md5(microtime($f));

          $blog = Promo::where('uid',$request->uid)
                          ->update(['promo_title' => $request->promo_title, 'meta_description' => $request->meta_description,  'description' => $request->description, 'slug' => SlugService::createSlug(Promo::class, 'slug', $request->promo_title), 'thumbnail' => $request->url('images/'.$ef.".".$file->getClientOriginalExtension())]);

          $file->move('images/',$ef.".".$file->getClientOriginalExtension());

          return redirect('/home/promos')->with('status', 'Data Berhasil Diperbaharui');
        }
      }
    }

    public function destroy($uid){
      $blog = Promo::where('uid',$uid)->first();
      $blog->delete();

      if($blog->delete()!=1){
        return redirect('/home/promos')->with('status', 'Data Gagal Dihapus');
      }else{
        return redirect('/home/promos')->with('status', 'Data Berhasil Dihapus');
      }
    }
}
