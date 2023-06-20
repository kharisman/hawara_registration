<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webinar;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;

class WebinarController extends Controller
{
    public function index(){
      $data = Webinar::orderBy('created_at','desc')->get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function home(){
      $data = Webinar::get();
      return view('webinar',['data' => $data]);
    }

    public function random(){
      $data = Webinar::inRandomOrder()->limit('1')->get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function add(){
      return view('add_webinar');
    }

    public function selectview($id){
      $data = Webinar::where('uid','=',$id)->first();
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
          'branch_uid' => 'required',
          'webinar_name' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3',
          'facility' => 'required|string|min:3',
          'price' => 'required|integer',
          'date' => 'required',
          'discount' => 'required|integer'
      ]);

      if ($validator->fails()) {

        return redirect('/home/webinars/add')
          ->withErrors($validator)
          ->withInput();

      }else{

      $file = $request->image;
      $f = $file->getClientOriginalName();
      $ef = md5(microtime($f));

      if($validator->fails()){
          $return['status'] = 'error';
          $return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $webinar = new Webinar;
      $webinar->uid = Uuid::uuid4()->getHex();
      $webinar->branch_uid = $request->branch_uid;
      $webinar->webinar_name = $request->webinar_name;
      $webinar->description = $request->description;
      $webinar->facility = $request->facility;
      $webinar->price = $request->price;
      $webinar->discount = $request->discount;
      $webinar->date = $request->date;
      $webinar->image = url('images/'.$ef.".".$file->getClientOriginalExtension());
      $webinar->save();

      $file->move('images/',$ef.".".$file->getClientOriginalExtension());

      return redirect('/home/webinars')->with('status', 'Data Berhasil Ditambahkan');
      }

    }

    public function create(Request $request){
      $validator = Validator::make($request->all(), [
          'branch_uid' => 'required',
          'webinar_name' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3',
          'facility' => 'required|string|min:3',
          'price' => 'required|integer',
          'date' => 'required',
          'discount' => 'required|integer'
      ]);

      $file = $request->image;
      $f = $file->getClientOriginalName();
      $ef = md5(microtime($f));

      if($validator->fails()){
          $return['status'] = 'error';
          $return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $webinar = new Webinar;
      $webinar->uid = Uuid::uuid4()->getHex();
      $webinar->branch_uid = $request->branch_uid;
      $webinar->webinar_name = $request->webinar_name;
      $webinar->description = $request->description;
      $webinar->facility = $request->facility;
      $webinar->price = $request->price;
      $webinar->discount = $request->discount;
      $webinar->date = $request->date;
      $webinar->image = url('images/'.$ef.".".$file->getClientOriginalExtension());
      $webinar->save();

      $file->move('images/',$ef.".".$file->getClientOriginalExtension());

      $return['status'] = 'success';
      return response()->json($return,200);
    }

    public function select($id){
      $webinar = Webinar::with('branch')->where('uid','=',$id)->first();
      $count = $webinar->count();
      if($count<1){
        $return['status'] = "error";
        return response()->json($return, 422);
      }else{
        $return['status'] = "success";
        $return['data'] = $webinar;
        return response()->json($return, 200);
      }
    }

    public function edit($id){
      $webinar = Webinar::where('uid','=',$id)->first();
      return view('edit_webinar',['data' => $webinar]);

    }

    public function update(Request $request){
      $validator = Validator::make($request->all(), [
          'uid' => 'required',
          'branch_uid' => 'required',
          'webinar_name' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3',
          'facility' => 'required|string|min:3',
          'price' => 'required|integer',
          'date' => 'required',
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

      $webinar = Webinar::where('uid',$request->uid)
                      ->update(['branch_uid' => $request->branch_uid, 'webinar_name' => $request->webinar_name, 'description' => $request->description, 'facility' => $request->facility, 'price' => $request->price, 'discount' => $request->discount, 'date' => $request->date, 'image' => url('images/'.$ef.".".$file->getClientOriginalExtension())]);

      $file->move('images/',$ef.".".$file->getClientOriginalExtension());

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function update_be(Request $request){
      $validator = Validator::make($request->all(), [
          'uid' => 'required',
          'branch_uid' => 'required',
          'webinar_name' => 'required|string|min:3',
          'description' => 'required|min:3',
          'facility' => 'required|string|min:3',
          'price' => 'required|integer',
          'discount' => 'required|integer',
          'date' => 'required|date'
      ]);

      if ($validator->fails()) {

        return redirect('/home/webinars/edit/'.$request->uid)
          ->withErrors($validator)
          ->withInput();

      }else{

        $file = $request->image;
        if(empty($file)){
          $webinar = Webinar::where('uid',$request->uid)
                      ->update(['branch_uid' => $request->branch_uid, 'webinar_name' => $request->webinar_name, 'description' => $request->description, 'price' => $request->price, 'discount' => $request->discount, 'facility' => $request->facility, 'date' => $request->date]);
          return redirect('/home/webinars')->with('status', 'Data Berhasil Diperbaharui');

        }else{

          $f = $file->getClientOriginalName();
          $ef = md5(microtime($f));
          $webinar = Webinar::where('uid',$request->uid)
                      ->update(['branch_uid' => $request->branch_uid, 'webinar_name' => $request->webinar_name, 'description' => $request->description, 'price' => $request->price, 'discount' => $request->discount, 'facility' => $request->facility, 'date' => $request->date, 'image' => url('images/'.$ef.".".$file->getClientOriginalExtension()) ]);
          return redirect('/home/webinars')->with('status', 'Data Berhasil Diperbaharui');
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

      $webinar = Webinar::where('uid',$request->uid)->first();
      $webinar->delete();

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function destroy($uid){
      $webinar = Webinar::where('uid',$uid)->first();
      $webinar->delete();

      if($webinar->delete()!=1){
        return redirect('/home/webinars')->with('status', 'Data Gagal Dihapus');
      }else{
        return redirect('/home/webinars')->with('status', 'Data Berhasil Dihapus');
      }
    }
}
