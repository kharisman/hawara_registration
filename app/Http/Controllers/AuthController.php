<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;
class AuthController extends Controller
{
    public function front()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('home');
        }
        return view('public');
    }
    public function showFormLogin()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('home');
        }
        return view('login_v2');
    }

    public function login(Request $request)
    {
        $rules = [
            'email'                 => 'required',
            'password'              => 'required|string'
        ];

        $messages = [
            'email.required'        => 'Email wajib diisi',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];


        Auth::attempt($data);
        if (Auth::check()) { 
            return redirect()->route('home');
        } else { 
            \Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }
    }

    public function register(Request $request)
    {
        $user = new User;
        $user->name = ucwords(strtolower("Admin PalComtech"));
        $user->email = strtolower("admin@pct.com");
        $user->password = Hash::make("kitasabi");
        $user->save();
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login')->with("logout",  1);
    }
}
