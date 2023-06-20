<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Banner;

class BannerController extends Controller
{

     public function index(){
      $data = Banner::where('status','=','1')->orderBy('order','asc')->get();
      $return['status'] = "success";
      $dt = [];

      foreach($data as $k=>$v){
        $dt[$k]['id'] = $v->id;
        $dt[$k]['title'] = $v->title;
        $dt[$k]['link'] = $v->link;
        $dt[$k]['banner_desktop'] = $v->banner_desktop;
        $dt[$k]['banner_mobile'] = $v->banner_mobile;
        $dt[$k]['date'] = $v->created_at;
      }
      $return['data'] = $dt;
      return response()->json($return, 200);
    }

    public function home(){
      $banner = Banner::orderBy('created_at','desc')->get();
      return view('banner')->with(['data' => $banner]);
    }

    public function add(){
      return view('add_banner');
    }

    public function input(Request $request){
      $validator = Validator::make($request->all(), [
          'title' => 'required|string|max:255|min:3',
      ]);

      if ($validator->fails()) {

        return redirect('/home/banner/add')
          ->withErrors($validator)
          ->withInput();

      }else{

      $file_d = $request->banner_desktop;
      $file_m = $request->banner_mobile;
      $fd = $file_d->getClientOriginalName();
      $fm = $file_m->getClientOriginalName();
      $ed = md5(microtime($fd));
      $em = md5(microtime($fm));

      $banner = new Banner();
      $banner->title = $request->title;
      $banner->link = $request->link;
      $banner->banner_desktop = url('images/banner-desktop/'.$ed.".".$file_d->getClientOriginalExtension());
      $banner->banner_mobile = url('images/banner-mobile/'.$em.".".$file_m->getClientOriginalExtension());
      $banner->order = $request->order;
      $banner->status = 1;
      $banner->save();

      $file_d->move('images/banner-desktop',$ed.".".$file_d->getClientOriginalExtension());
      $file_m->move('images/banner-mobile',$em.".".$file_m->getClientOriginalExtension());

      return redirect('/home/banner')->with('status', 'Data Berhasil Ditambahkan');
      }

    }

    public function active($id){
      $banner = Banner::where('id','=',$id)
                      ->update(['status' => '1']);

      return redirect('/home/banner')->with('status', 'Data Berhasil Diaktifkan');
    }

    public function nonactive($id){
      $banner = Banner::where('id','=',$id)
                      ->update(['status' => '2']);

      return redirect('/home/banner')->with('status', 'Data Berhasil Di Non Aktifkan');
    }

    public function destroy($id){
      $banner = banner::where('id',$id)->first();
      $banner->delete();

      return redirect('/home/banner')->with('status', 'Data Berhasil Dihapus');

    }
}
