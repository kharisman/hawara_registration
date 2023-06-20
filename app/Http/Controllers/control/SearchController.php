<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search($search) {
        $data1 = DB::table('products')->where('product_name','like','%'.$search.'%')->orWhere('description','like','%'.$search.'%')->get();
        $data2 = DB::table('webinars')->where('description','like','%'.$search.'%')->where('deleted_at','is',NULL)->get();
      $data3 = DB::table('blogs')->select('id','uid','blog_title','thumbnail')->where('blog_title','like','%'.$search.'%')->orWhere('description','like','%'.$search.'%')->get();
      
      $return['status'] = "success";
        $return['data1'] = $data1;
        $return['data2'] = $data2;
        $return['data3'] = $data3;
      
      return response()->json($return, 200);
    }
}
