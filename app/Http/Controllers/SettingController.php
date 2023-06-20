<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reseller;
use App\Models\ResellerPayment;
use App\Models\ResellerProduct;
use App\Models\TimML;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    //
    public function website(Request $request)
    {
        return view('home');
    }

    public function program_mitra(Request $request)
    {
        return view('home');
    }

    public function produk_mitra(Request $request)
    {
        $product = ResellerProduct::get();
        // return $resellers;
        return view('setting.mitra.produk_mitra_data',compact('product'));
    }

    public function produk_mitra_add(Request $request)
    {
        return view('setting.mitra.produk_mitra_add');
    }

    public function produk_mitra_add_p(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|min:2|unique:reseller_products,name',
            'cover' => 'required|min:3',
            'deskripsi_pendek' => 'required|min:3',
            'deskripsi' => 'required|min:3',
            'harga' => 'required|integer|min:3',
            'harga_jual' => 'required|integer|min:3',
        ]);
        
        $save  = New ResellerProduct() ;
        $save->name = $request->nama_produk;
        $save->cover = $request->cover;
        $save->descriptions = $request->deskripsi;
        $save->short_desc = $request->deskripsi_pendek;
        $save->price = $request->harga;
        $save->price_pay = $request->harga_jual;
        $save->save();

        if (!$save){
            return back()->with('success', 'Data Produk Mitra berhasil diedit. ');
        }
        return back()->with('success', 'Data Produk Mitra berhasil disimpan. ');
    }

    public function produk_mitra_edit(Request $request)
    {
        $data = ResellerProduct::where("id",$request->id)->firstOrFail();
        return view('setting.mitra.produk_mitra_edit',compact('data'));
    }

    public function produk_mitra_edit_p(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|min:2|unique:reseller_products,name,'.$request->id.',id',
            // 'cara_bayar' => 'required|min:2|unique:payment_methods,name,'.$request->id.',id,deleted_at,NULL',
            'cover' => 'required|min:3',
            'deskripsi_pendek' => 'required|min:3',
            'deskripsi' => 'required|min:3',
            'harga' => 'required|integer|min:3',
            'harga_jual' => 'required|integer|min:3',
        ]);
        
        $save  = ResellerProduct::where("id",$request->id)->firstOrFail(); ;
        $save->name = $request->nama_produk;
        $save->cover = $request->cover;
        $save->descriptions = $request->deskripsi;
        $save->short_desc = $request->deskripsi_pendek;
        $save->price = $request->harga;
        $save->price_pay = $request->harga_jual;
        $save->save();
        
        if (!$save){
            return back()->with('error', 'Data Tim ML gagal disimpan. ');
        }
        return back()->with('success', 'Data Tim ML berhasil disimpan. ');
    }

    public function tim_ml(Request $request)
    {
        $datas = TimML::get();
        return view('setting.ml.ml_data',compact('datas'));
    }

    public function tim_ml_add(Request $request)
    {
        return view('setting.ml.ml_data_add');
    }

    public function tim_ml_add_p(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|min:2|unique:voting_data_tim,nama',
            'gambar' => 'required|min:3',
            'asal' => 'required|min:3',
            'gambar' => 'required|min:3',
            'urutan' => 'required',
            'status' => 'required',
        ]);
        
        $save  = New TimML() ;
        $save->nama = $request->nama;
        $save->asal = $request->asal;
        $save->gambar = $request->gambar;
        $save->deskripsi = $request->deskripsi;
        $save->urutan = $request->urutan;
        $save->status = $request->status;
        $save->session = 2;
        $save->save();

        if (!$save){
            return back()->with('success', 'Data Tim ML berhasil diedit. ');
        }
        return back()->with('success', 'Data Tim ML berhasil disimpan. ');
    }

    public function tim_ml_edit(Request $request)
    {
        // return 1212 ;
        $data = TimML::where("id",$request->id)->firstOrFail();
        return view('setting.ml.ml_data_edit',compact('data'));
    }

    public function tim_ml_edit_p(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|min:2|unique:voting_data_tim,nama,'.$request->id.',id',
            'gambar' => 'required|min:3',
            'asal' => 'required|min:3',
            'gambar' => 'required|min:3',
            'urutan' => 'required',
            'status' => 'required',
        ]);
        
        $save  = TimML::where("id",$request->id)->firstOrFail();
        $save->nama = $request->nama;
        $save->asal = $request->asal;
        $save->gambar = $request->gambar;
        $save->deskripsi = $request->deskripsi;
        $save->urutan = $request->urutan;
        $save->status = $request->status;
        $save->save();

        if (!$save){
            return back()->with('error', 'Data Tim ML gagal diedit. ');
        }
        return back()->with('success', 'Data Tim ML  berhasil diedit. ');
    }
}
