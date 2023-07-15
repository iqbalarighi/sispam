@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Edit Laporan') }}
                    <a href="{{route('posjaga')}}"><span class="btn btn-primary float-right btn-sm">Kembali</span></a>

                </div>

<style>
.containerx {
  position: relative;
  width: 50%;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.containerx:hover .image {
  opacity: 0.3;
}

.containerx:hover .middle {
  opacity: 1;
}
 
.text {
  color: black;
  font-size: 24px;
  padding: auto;
}
</style>
                <div class="card-body overflow " style="overflow-x: auto;">
                    @if (session('status'))
                    <center>
                        <div id="timeout" class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    </center>
                    @endif
                        <style>
                            .table tr td{
                            word-wrap: break-word;
                            vertical-align: middle;
                            white-space: nowrap;
                            padding:1px !important;    
                            }
                        </style>
                    <div class="table-responsive mt-2 justify-content:center">
            <form action="/pos-update/{{$pos->id}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                    <table class="table mx-auto" style="width: 70%; ">
                    <tr>
                        <td>Id Jaga</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="id_jaga" id="id_jaga" value="{{$pos->id_jaga}}" readonly></td> 
                    </tr>
                    <tr>
                        <td>Pos Jaga</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="pos" id="pos" value="{{$pos->pos_jaga}}" required></td>
                    </tr>
                    <tr>
                        <td>Gedung</td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0" id="gedung" name="gedung" required>
                                <option value="{{$id[0]->id}}">{{$pos->site->nama_gd}}</option>
                                @foreach($site as $item)
                                <option value="{{$item->id}}">{{$item->nama_gd}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Area Jaga</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="area" id="area" value="{{$pos->area_jaga}}" required></td>
                    </tr>
                    <tr>
                        <td>Kategori Ring</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="ring" id="ring" value="{{$pos->kategori_ring}}" required></td>
                    </tr>
                    <tr>
                        <td>Personil Jaga</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="jaga" id="jaga" value="{{$pos->personil_jaga}}" required></td>
                    </tr>
                    <tr>
                        <td>Standar Peralatan</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="alat" id="alat" value="{{$pos->standar_peralatan}}" required></td>
                    </tr>

                    @if ($pos->foto == null)
                    <tr>
                        <td><b>Upload Foto</b></td>
                        <td>:</td>
                        <td>
                            <input type="file" name="images[]"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" 
                                    accept=".jpg, .jpeg, .png" 
                                    multiple/>

                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="3"><b>Foto </b>: <br> <p></p>
                        <div class="row">
                            @foreach(explode('|',$pos->foto) as $item)

                                <div class="containerx">
                                
                               <img class="image" src="{{asset('storage/posjaga')}}/{{$pos->id_jaga}}/{{$item}}" style="width: 100%; margin-bottom: 5pt"> &nbsp;
                            <div class="middle">
                            <div class="text"><a href="/pos/hapus-foto/{{$item}}/{{$pos->id}}" title="Hapus Foto" onclick="return confirm('Yakin fotonya mau di hapus ?')"><i class="bi bi-trash3"></i></a></div>
                          </div>
                            </div>

                            @endforeach
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"> Tambah Gambar : <br>
                            <input type="file" name="images[]"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" 
                                    accept=".jpg, .jpeg, .png" 
                                    multiple/>
                        </td> 
                    </tr>
                    @endif
                    </table>
                    <center>
                    <button type="submit" class="btn btn-primary" style = "text-align:center">
                        {{ __('Simpan') }}
                    </button>
                    </center>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection