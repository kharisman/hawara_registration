@extends('layouts.layout')
@section('content')
 <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Edit Tim Mobile Legend</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Mobile Legend</a></li>
              <li class="breadcrumb-item active"> Edit Tim Mobile Legend</li>
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
                <h3 class="card-title">Form Edit Tim Mobile Legend</h3>

                <div class="card-tools">
                  <a href="{{url('')}}/pengaturan/tim-ml" class="btn btn-tool" ><i class="fas fa-arrow-left"></i> &nbsp; Kembali
                  </a>
                </div>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="post">
                    @csrf
                    <input type="hidden" value="{{$data->id}}" name="id">
                    <div class="card-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Tim</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama TIm ketik di sini" value="{{old('nama',$data->nama)}}" required >
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="asal" class="col-sm-2 col-form-label">Asal Tim</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="asal" name="asal" placeholder="Asal TIm ketik di sini" value="{{old('asal',$data->asal)}}" required >
                            @error('asal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gambar" class="col-sm-2 col-form-label">gambar</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="gambar" name="gambar" placeholder="gambar ketik di sini" value="{{old('gambar',$data->gambar)}}"  required>
                            @error('gambar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="urutan" class="col-sm-2 col-form-label">urutan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="urutan" name="urutan" placeholder="urutan ketik di sini" value="{{old('urutan', $data->urutan)}}"  required>
                            @error('urutan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">status</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="status" name="status"  required>
                                <option {{ old('status', $data->status) == "aktif" ? "selected" : "" }} value="aktif">aktif</option>
                                <option {{ old('status', $data->status) == "tidak" ? "selected" : "" }} value="tidak">tidak</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="deksripsi" class="col-sm-2 col-form-label">Deskripsi </label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi ketik di sini"  >{{old('deksripsi',$data->deskripsi)}}</textarea>
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