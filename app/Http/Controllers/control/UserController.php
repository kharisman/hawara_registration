<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    public function login(Request $request)
        {
            $credentials = $request->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            $return['status'] = "success";
            $return['data'] = compact('token');
            return response()->json($return, 200);
        }

        public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'roles' => 'required',
                'branch_uid' => 'required'
            ]);

            if($validator->fails()){
                $return['status'] = 'error';
                $return['errors'] = $validator->errors();
                return response()->json($return, 422);
            }

            $user = User::create([
                'uid' => Uuid::uuid4()->getHex(),
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'roles' => $request->get('roles'),
                'branch_uid' => $request->get('branch_uid')
            ]);

            $token = JWTAuth::fromUser($user);

            $return['status'] = "success";
            $return['data'] = compact('token');
            return response()->json($return, 200);
        }

        public function getAuthenticatedUser()
        {
            try {

                if (! $user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
                }

            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                return response()->json(['token_expired'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                return response()->json(['token_invalid'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                return response()->json(['token_absent'], $e->getStatusCode());

            }

            $return['status'] = "success";
            $return['data'] = compact('user');
            return response()->json($return, 200);
        }

    public function index(){
      $data = User::get();
      $return['status'] = "success";
      $return['data'] = $data;
    return response()->json($return, 200);
    }

    public function home(){
      $data = User::with('branches')->get();

      if(Auth::user()->roles=='Super Admin'){
        return view('user',['data' => $data]);
      }else{
        return view('403');
      }
    }

    public function add(){
      $data = Branch::get();
      return view('add_user',['data' => $data]);
    }

    public function input(Request $request){
      $validator = Validator::make($request->all(), [
          'name' => 'required|string|max:255|min:3',
          'email' => 'required|email|unique:users',
          'password' => 'required|string|min:6',
          'roles' => 'required',
          'branch_uid' => 'required'
      ]);

      if ($validator->fails()) {

        return redirect('/home/users/add')
          ->withErrors($validator)
          ->withInput();

      }else{

      $user = User::create([
        'name' => $request->get('name'),
        'uid' => Uuid::uuid4()->getHex(),
        'email' => $request->get('email'),
        'password' => Hash::make($request->get('password')),
        'roles' => $request->get('roles'),
        'branch_uid' => $request->get('branch_uid')
      ]);

      return redirect('/home/users')->with('status', 'Data Berhasil Ditambahkan');
      }

    }

    public function select($id){
      $user = User::where('uid','=',$id)->first();
      $count = $user->count();

      if($count<1){
        $return['status'] = "error";
        return response()->json($return, 422);
      }else{
        $return['status'] = "success";
        $return['data'] = $user;
        return response()->json($return, 200);
      }
    }

    public function edit($id){
      $user = User::where('uid','=',$id)->first();
      $branch = Branch::get();
      return view('edit_user',['data' => $user, 'branch' => $branch]);

    }

    public function edit_pass($id){
      $user = User::where('uid','=',$id)->first();
      return view('edit_passuser',['data' => $user]);
    }

    public function update(Request $request){
      $validator = Validator::make($request->all(), [
          'uid' => 'required',
          'email' => 'required|string|max:255|min:3|unique:users',
          'name' => 'required|string|max:255|min:3',
      ]);

      if($validator->fails()){
          $return['msg'] = "error";
          $return['errors'] = $validator->errors();
          return response()->json($return, 422);
      }

      $user = User::where('uid',$request->uid)
                      ->update(['email' => $request->email, 'name' => $request->name]);

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function update_be(Request $request){
      $validator = Validator::make($request->all(), [
          'name' => 'required|string|max:255|min:3',
          'email' => 'required|email',
          'roles' => 'required',
          'branch_uid' => 'required'
      ]);

      if ($validator->fails()) {

        return redirect('/home/users/edit/'.$request->uid)
          ->withErrors($validator)
          ->withInput();

      }else{

      $user = User::where('uid',$request->uid)->update([
        'name' => $request->name,
        'roles' => $request->roles,
        'branch_uid' => $request->branch_uid
      ]);

      return redirect('/home/users')->with('status', 'Data Berhasil Diperbaharui');
      }

    }

    public function updatepass_be(Request $request){
      $validator = Validator::make($request->all(), [
        'new_pass' => 'required|string|min:6'
      ]);

      if ($validator->fails()) {

      return redirect('/home/users/edit-pass/'.$request->uid)
        ->withErrors($validator)
        ->withInput();

      }else{

      $user = User::where('uid',$request->uid)->update([
        'password' => Hash::make($request->new_pass)
      ]);

      return redirect('/home/users')->with('status', 'Data Berhasil Diperbaharui');
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

      $user = User::where('uid',$request->uid)->first();
      $user->delete();

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function destroy($uid){
        $user = User::where('uid',$uid)->first();
        $user->delete();

        if($user->delete()!=1){
          return redirect('/home/users')->with('status', 'Data Gagal Dihapus');
        }else{
          return redirect('/home/users')->with('status', 'Data Berhasil Dihapus');
        }
    }
}
