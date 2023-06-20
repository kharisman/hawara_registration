<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Branch;
use Ramsey\Uuid\Uuid;

class BranchController extends Controller
{

    public function index(){
    	$data = Branch::get();
      $return['status'] = "success";
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function home(){
      $data = Branch::get();
      return view('branch',['data' => $data]);
    }

    public function add(){
      return view('add_branch');
    }

    public function input(Request $request){
      $validator = Validator::make($request->all(), [
          'branch_name' => 'required|string|max:255|min:3',
          'phone_number' => 'required|min:6'
      ]);

      if ($validator->fails()) {
        return redirect('/home/branches/add')
          ->withErrors($validator)
          ->withInput();
      }else{
      $branch = new Branch();
      $branch->uid = Uuid::uuid4()->getHex();
      $branch->branch_name = $request->branch_name;
      $branch->phone_number = $request->phone_number;
      $branch->save();

      return redirect('/home/branches')->with('status', 'Data Berhasil Ditambahkan');
      }
      
    }

    public function create(Request $request){
    	$validator = Validator::make($request->all(), [
          'branch_name' => 'required|string|max:255|min:3|unique:branches',
          'phone_number' => 'required|string|max:255|min:3|unique:branches',
      ]);

      if($validator->fails()){
          $return['status'] = 'error';
      		$return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $branch = new Branch;
      $branch->uid = Uuid::uuid4()->getHex();
      $branch->branch_name = $request->branch_name;
      $branch->phone_number = $request->phone_number;
      $branch->save();
      
      $return['status'] = 'success';
      return response()->json($return,200);
    }

    public function select($id){
      $branch = Branch::where('uid','=',$id)->first();
      $count = $branch->count();

      if($count<1){
        $return['status'] = "error";
        return response()->json($return, 422);
      }else{
        $return['status'] = "success";
        $return['data'] = $branch;
        return response()->json($return, 200);
      }
    }

    public function edit($id){
      $branch = Branch::where('uid','=',$id)->first();
      return view('edit_branch',['data' => $branch]);
      
    }

    public function search($branch_name){
      $branch = Branch::where('branch_name','like',"%{$branch_name}%")->get();
      $count = $branch->count();

      if($count<1){
        $return['status'] = "error";
        return response()->json($return, 422);
      }else{
        $return['status'] = "success";
        $return['data'] = $branch;
        return response()->json($return, 200);
      }
    }

    public function update(Request $request){
    	$validator = Validator::make($request->all(), [
    			'uid' => 'required',
          'branch_name' => 'required|string|max:255|min:3',
          'phone_number' => 'required|string|max:255|min:3',
      ]);

      if($validator->fails()){
          $return['msg'] = "error";
      		$return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $branch = Branch::where('uid',$request->uid)
                      ->update(['branch_name' => $request->branch_name,'phone_number' => $request->phone_number]);

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function update_be(Request $request){
      $validator = Validator::make($request->all(), [
          'uid' => 'required',
          'branch_name' => 'required|string|max:255|min:3',
          'phone_number' => 'required|min:6'
      ]);

      if ($validator->fails()) {
        return redirect('/home/branches/edit/'.$request->uid)
          ->withErrors($validator)
          ->withInput();
      }else{
      $branch = Branch::where('uid',$request->uid)
                      ->update(['branch_name' => $request->branch_name, 'phone_number' => $request->phone_number]);
      return redirect('/home/branches')->with('status', 'Data Berhasil Diperbaharui');
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

      $branch = Branch::where('uid',$request->uid)->first();
      $branch->delete();

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function destroy($uid){
        $branch = Branch::where('uid',$uid)->first();
        $branch->delete();

        if($branch->delete()!=1){
          return redirect('/home/branches')->with('status', 'Data Gagal Dihapus');
        }else{
          return redirect('/home/branches')->with('status', 'Data Berhasil Dihapus');
        }
    }  
}
