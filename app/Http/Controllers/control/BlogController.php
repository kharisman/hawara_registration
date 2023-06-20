<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Ramsey\Uuid\Uuid;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BlogController extends Controller
{

    public function index(){
      $data = Blog::with('user')->where('status','=','Aktif')->orderBy('created_at','desc')->get();
      $return['status'] = "success";
      $dt = [];

      foreach($data as $k=>$v){
        $dt[$k]['id'] = $v->id;
        $dt[$k]['uid'] = $v->uid;
        $dt[$k]['title'] = $v->blog_title;
        $dt[$k]['thumbnail'] = $v->thumbnail;
        $dt[$k]['slug'] = $v->slug;
        $dt[$k]['date'] = $v->created_at;
        $dt[$k]['user'] = $v->user->name;
      }
      $return['data'] = $dt;
      return response()->json($return, 200);
    }

    public function home(){
      $data = Blog::get()->sortByDesc('created_at');
      return view('blog',['data' => $data]);
    }

    public function add(){
      $data = BlogCategory::get();
      $tag = Tag::get();
      return view('add_blog',['data' => $data, 'tag' => $tag]);
    }

    public function preview($slug){
      $data = Blog::with('user')->where('slug','=',$slug)->where('status','=','Aktif')->get();
      $cat = BlogCategory::get();
      $tag = Tag::get();
      $bl = Blog::where('status','=','Aktif')->get()->sortByDesc('created_at');
      $blv = Blog::where('status','=','Aktif')->get()->sortByDesc('views');
      $count = $data->count();
      $dt = Blog::with('user')->where('slug','=',$slug)->where('status','=','Aktif')->first();
      if($count>0){
        $uid = $dt->uid;
        $view = $dt->views;
        $blog = Blog::where('uid',$uid)->update(['views' => $view+1]);
        return view('blog_preview', ['count'=> $count, 'dt' => $dt, 'data' => $data, 'cat' => $cat, 'tag' => $tag, 'bl' => $bl, 'blv' => $blv]);
      }else{
        return view('blog_preview', ['count' => $count]);
      }
    }

    public function slug($id, $slug){
      $data = Blog::with('user')->where('uid','=',$id)->where('slug','=',$slug)->where('status','=','Aktif')->get();
      $cat = BlogCategory::get();
      $tag = Tag::get();
      $bl = Blog::where('status','=','Aktif')->orderBy('created_at','desc')->limit(5)->get();
      $blv = Blog::where('status','=','Aktif')->orderBy('views','desc')->limit(5)->get();
      $count = $data->count();
      $dt = Blog::with('user')->where('slug','=',$slug)->where('status','=','Aktif')->first();
      if($count>0){
        $uid = $dt->uid;
        $view = $dt->views;
        $blog = Blog::where('uid',$uid)->update(['views' => $view+1]);
        $return['status'] = "success";
        $return['data'] = $data;
        $return['dt'] = $dt;
        $return['bl'] = $bl;
        $return['blv'] = $blv;
        $return['tag'] = $tag;
        $return['cat'] = $cat;
        return response()->json($return, 200);
      }else{
        $return['status'] = "error";
        return response()->json($return, 422);
      }
    }

    public function view(){
      $data = Blog::with('user')->where('status','=','Aktif')->get()->sortByDesc('created_at');
      $cat = BlogCategory::get();
      $tag = Tag::get();
      $count = $data->count();

      return view('blog_view', ['count'=> $count, 'data' => $data, 'cat' => $cat, 'tag' => $tag]);
    }

    public function search($search){
      $data = Blog::with('user')->where('status','=','Aktif')->where('blog_title','like','%'.$search.'%')->get()->sortByDesc('created_at');
      $count = $data->count();

      $return['status'] = "success";
      $return['count'] = $count;
      $return['keyword'] = $search;
      $return['data'] = $data;
      return response()->json($return, 200);
    }

    public function search_be(Request $request){
      $keyword=  $request->q;
      $data = Blog::with('user')->where('status','=','Aktif')->where('blog_title','like','%'.$keyword.'%')->get()->sortByDesc('created_at');

      $cat = BlogCategory::get();
      $tag = Tag::get();
      $count = $data->count();

      return view('blog_search', ['keyword'=> $keyword, 'count'=> $count, 'data' => $data, 'cat' => $cat, 'tag' => $tag]);
    }

    public function selectview($id){
      $data = Blog::with('product')->where('uid','=',$id)->first();
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
          'category_blog_uid' => 'required',
          'user_uid' => 'required',
          'meta_description' => 'required|string|max:255|min:3',
          'blog_title' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3',
          'tags' => 'required'
      ]);

      if ($validator->fails()) {

        return redirect('/home/blogs/add')
          ->withErrors($validator)
          ->withInput();

      }else{

      $file = $request->thumbnail;
      $f = $file->getClientOriginalName();
      $ef = md5(microtime($f));

      $blog = new Blog();
      $blog->uid = Uuid::uuid4()->getHex();
      $blog->category_blog_uid = $request->category_blog_uid;
      $blog->user_uid = $request->user_uid;
      $blog->blog_title = $request->blog_title;
      $blog->meta_description = $request->meta_description;
      $blog->slug = SlugService::createSlug($blog, 'slug', $request->blog_title);
      $blog->description = $request->description;
      $blog->views = 0;
      $blog->thumbnail = url('images/'.$ef.".".$file->getClientOriginalExtension());
      $blog->tags = json_encode($request->tags);
      $blog->status = 'Non Aktif';
      $blog->save();

      $file->move('images/',$ef.".".$file->getClientOriginalExtension());

      return redirect('/home/blogs')->with('status', 'Data Berhasil Ditambahkan');
      }

    }

    public function select($id){
      $blog = Blog::where('uid','=',$id)->first();
      $count = $blog->count();
      if($count<1){
        $return['status'] = "error";
        return response()->json($return, 422);
      }else{
        $return['status'] = "success";
        $return['data'] = $blog;
        return response()->json($return, 200);
      }
    }

    public function edit($id){
      $blog = Blog::where('uid','=',$id)->first();
      $category = BlogCategory::get();
      $tag = Tag::get();
      return view('edit_blog',['data' => $blog, 'category' => $category, 'tag' => $tag]);
    }

    public function update_be(Request $request){
      $validator = Validator::make($request->all(), [
          'uid' => 'required',
          'category_blog_uid' => 'required',
          'user_uid' => 'required',
          'meta_description' => 'required|string|max:255|min:3',
          'blog_title' => 'required|string|max:255|min:3',
          'description' => 'required|string|min:3',
          'tags' => 'required'
      ]);

      if ($validator->fails()) {
        return redirect('/home/blogs/edit/'.$request->uid)
          ->withErrors($validator)
          ->withInput();
      }else{

      $file = $request->thumbnail;
        if(empty($file)){
          $blog = Blog::where('uid',$request->uid)
                          ->update(['blog_title' => $request->blog_title, 'category_blog_uid' => $request->category_blog_uid, 'user_uid' => $request->user_uid, 'meta_description' => $request->meta_description, 'description' => $request->description, 'slug' => SlugService::createSlug(Blog::class, 'slug', $request->blog_title), 'tags' => json_encode($request->tags)]);

          return redirect('/home/blogs')->with('status', 'Data Berhasil Diperbaharui');
        }else{
          $f = $file->getClientOriginalName();
          $ef = md5(microtime($f));

          $blog = Blog::where('uid',$request->uid)
                          ->update(['blog_title' => $request->blog_title, 'category_blog_uid' => $request->category_blog_uid, 'user_uid' => $request->user_uid, 'meta_description' => $request->meta_description,  'description' => $request->description, 'slug' => SlugService::createSlug(Blog::class, 'slug', $request->blog_title), 'thumbnail' => url('images/'.$ef.".".$file->getClientOriginalExtension()), 'tags' => json_encode($request->tags)]);

          $file->move('images/',$ef.".".$file->getClientOriginalExtension());

          return redirect('/home/blogs')->with('status', 'Data Berhasil Diperbaharui');
        }
      }
    }

    public function categories($name){
      $category = BlogCategory::where('category_name','=',$name)->first();
      $uid = $category->uid;
      $blog = Blog::with('category')->where('category_blog_uid','=',$uid)->where('status','=','Aktif')->get();
      $count = $blog->count();

      return view('blog_cat',['data' => $blog, 'count' => $count]);
    }

    public function tags($name){
      $tag = Tag::where('tag_name','=',$name)->first();
      $uid = $tag->uid;
      $bl = Blog::with('tags')->where(function ($query) use ($uid){
        $query->orWhere('tags', 'like', '%'.$uid.'%');
      });
      $blog = $bl->get();
      $count = $blog->count();

      return view('blog_tag',['data' => $blog, 'count' => $count]);
    }

    public function active($uid){
      $blog = Blog::where('uid','=',$uid)
                      ->update(['status' => 'Aktif']);

      return redirect('/home/blogs')->with('status', 'Data Berhasil Diaktifkan');
    }

    public function nonactive($uid){
      $blog = Blog::where('uid','=',$uid)
                      ->update(['status' => 'Non Aktif']);

      return redirect('/home/blogs')->with('status', 'Data Berhasil Di Non Aktifkan');
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

      $blog = Blog::where('uid',$request->uid)->first();
      $blog->delete();

      $return['status'] = "success";
      return response()->json($return,200);
    }

    public function destroy($uid){
      $blog = Blog::where('uid',$uid)->first();
      $blog->delete();

      if($blog->delete()!=1){
        return redirect('/home/blogs')->with('status', 'Data Gagal Dihapus');
      }else{
        return redirect('/home/blogs')->with('status', 'Data Berhasil Dihapus');
      }
    }
}
