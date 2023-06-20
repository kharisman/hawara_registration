@extends('layouts.layout')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Produk Mitra</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Mitra</a></li>
              <li class="breadcrumb-item active">Produk Mitra</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Edit Produk Mitra</h3>

                <div class="card-tools">
                  <a href="{{url('')}}/pengaturan/mitra/produk-mitra" class="btn btn-tool" ><i class="fas fa-arrow-left"></i> &nbsp; Kembali
                  </a>
                </div>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="post">
                    @csrf
                    <input type="hidden" value="{{$data->id}}" name="id">
                    <div class="card-body">
                    <div class="form-group row">
                        <label for="nama_produk" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk ketik di sini" value="{{old('nama_produk', $data->name)}}" required >
                            @error('nama_produk')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cover" class="col-sm-2 col-form-label">cover</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cover" name="cover" placeholder="cover ketik di sini" value="{{old('cover', $data->cover)}}"  required>
                            @error('cover')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="harga ketik di sini" value="{{old('harga',$data->price)}}" required>
                            @error('harga')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="harga_jual" name="harga_jual"  placeholder="Harga Jual ketik di sini" value="{{old('harga_jual',$data->price_pay)}}" required>
                            @error('harga_jual')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deksripsi_pendek" class="col-sm-2 col-form-label">Deskripsi Pendek</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="deskripsi_pendek" name="deskripsi_pendek" placeholder="Deskripsi Pendek ketik di sini"  required>{{old('deksripsi_pendek',$data->short_desc)}}</textarea>
                            @error('deksripsi_pendek')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deksripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi ketik di sini"  required>{{old('deksripsi',$data->descriptions)}}</textarea>
                            @error('deksripsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-info">Proses</button>
                    <button type="submit" class="btn btn-default float-right">Reset</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
                
              </div>
            </div>            
          </div>
        </div>
      </div>
    </section>
  </div>
<script>
  $(function () {
    
  });
</script>
@endsection