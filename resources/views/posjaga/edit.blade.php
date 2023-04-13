@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Edit Laporan') }}
                    <a href="{{route('posjaga')}}"><span class="btn btn-primary float-right btn-sm">Kembali</span></a>

                </div>

                <div class="card-body overflow " style="overflow-x: auto;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
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
                    <tr>
                        <td>Foto</td>
                        <td>:</td>
                        <td>
<div class="col"> 
        <table align="center" class="mt-1 table table-sm" style="max-width: 20%;">
        <tr>
            <td align="center">
         <div class="container mt-3">
        <div class="card" align="center">
            <div class="card-body p-0"> 
                
             @if ($pos->foto == null)
                   <div style="margin: auto;">
                    <div class="preview3">
                        <img id="file-ip-1-preview3" class="relative object-cover" hidden>
                    </div>
                    <input type="file" class="form-control pb-0 pt-0" name="foto" accept=".jpg, .jpeg, .png" id="foto" onchange="alert('Klik Tombol Update Untuk Menyimpan Perubahan'); showPreview3(event); myFunction3(); " hidden>  
                    <div id="myDIV3">
                      
                <label align="center" for="foto" style="cursor: pointer; font-size: 70px; margin: auto;" title="Klik untuk Upload Kartu Tanda Anggota" class="bi bi-image">
                </label>
                    </div>
                </div> 
              @else
                      <div class="preview3" >
             <img id="file-ip-1-preview3" hidden>
                </div>
                <div id="myDIV3">
                      <img src="{!! asset('/storage/posjaga/'); !!}/{{$pos->id_jaga}}/{{$pos->foto}}" title="Klik gambar untuk ganti Kartu KTA" width="150px" />
                  </div>
                <div class="col">
             <input type="file" class="form-control pb-0 pt-0" name="foto" accept=".jpg, .jpeg, .png" id="foto" alt="klik untuk ganti foto" onchange="alert('Klik Tombol Update Untuk Menyimpan Perubahan'); showPreview3(event); myFunction3(); " hidden />
              </div>
              @endif
            </div>
            </div>
        </div>
                </td>
            </tr>
            <tr align="center">
            <td>
            @if ($pos->foto == null)    
                <label align="center" for="foto" style="cursor: pointer; font-size: 25px;" title="Klik untuk Upload Foto" class="bi bi-upload">
                </label>
            @else
                 <label title="Klik untuk Ganti Foto" align="center" for="foto" style="cursor: pointer; font-size: 25px;" class="bi bi-repeat">
                 </label>
                &nbsp;
               <a href="/hapus-foto/{{$pos->id}}" title="Klik untuk hapus Foto" onclick="return confirm('Yakin Fotonya mau di hapus ?')" style="color:black;">
                <i class="bi bi-file-earmark-x-fill" style="font-size: 25px;"></i>
            </a>
            @endif
             </td>
        </tr>
    </table>
    </div>
                        </td>
                    </tr>
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