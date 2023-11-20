@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Edit Biodata Personil') }}
                    <a href="{{route('personil')}}/{{$personil->id}}"><span class="btn btn-primary float-right btn-sm">Kembali</span></a>

                </div>

                <div class="card-body overflow " style="overflow-x: auto;">

                        <style>
                            .table tr td{
                            word-wrap: break-word;
                            vertical-align: middle;
                            white-space: nowrap;
                            padding:0.2rem !important;    
                            }
                        </style>
        @if ($errors->any())
            <div id="timeout" class="alert alert-danger flex flex-col md:justify-between" style="width: 80%; margin: 0 auto;">
                <div class="col-md-auto">
                        <div style="float: right;">
                            <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close" align="right"></button>
                        </div>                
                    </div>
                            @foreach ($errors->all() as $error)
                <div class="row">
                    <div class="col">
                        <div class="card-text" align="center">
                            {{ $error }} 
                        </div>
                    </div>
                </div>
                    @endforeach
            </div>
        @endif

    <!-- Notifikasi -->
        @if ($message = Session::get('success'))
            <div id="timeout" align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
                <div class="row">
                    <div class="col">
        <div class="card-text" align="center">
                    {{ $message }}
        </div>
                    </div>
                    <div class="col-md-auto">
        <div style="float: right;">
        <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close" align="right"></button>
        </div>                
                    </div>
                </div>
            </div>
        @endif
    <!-- Notifikasi -->
    
                    <div class="table-responsive mt-2 justify-content:center">
            <form action="/personil-update/{{$personil->id}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row justify-content-md-center">
    
<div class="row">
    <div class="col">
    <table align="center" class="mt-1 table table-sm" style="max-width: 20%;">
        <tr>
            <td align="center">
         <div class="container mt-3">
        <div class="card" align="center">
           <div class="card-header">Foto Profil</div> 
            <div class="card-body p-0"> 
             @if ($personil->foto_personil == null)
                   <div style="margin: auto;">

                    <div class="preview">
                        <img id="file-ip-1-preview" class="relative object-cover" hidden>
                    </div>
                    <div id="myDIV" >
                <input type="file" class="form-control pb-0 pt-0" name="foto" accept=".jpg, .jpeg, .png" id="foto" onchange="alert('Klik Tombol Update Untuk Menyimpan Perubahan'); showPreview(event); myFunction(); " hidden>
                  <label align="center" for="foto" title="Klik Untuk Upload Foto Personil" class="bi bi-person-circle img-thumbnail" style="font-size: 70px;">
                </label>
                    </div>

                </div> 
              @else
                      <div class="preview">
             <img id="file-ip-1-preview" hidden>
                </div>
                <div id="myDIV">
                      <img class="img-thumbnail" src="{!! asset('/storage/personil/'); !!}/{{$personil->nip}}/{{$personil->foto_personil}}" title="Klik gambar untuk ganti foto profil" width="100px" />
                  </div>
                <div class="col">
             <input type="file" class="form-control pb-0 pt-0" name="foto" accept=".jpg, .jpeg, .png" id="foto" alt="klik untuk ganti foto" onchange="alert('Klik Tombol Update Untuk Menyimpan Perubahan'); showPreview(event); myFunction(); " hidden />
              </div>
              @endif
            </div>
            </div>
        </div>
                </td>
            </tr>
            <tr align="center">
            <td>
            @if ($personil->foto_personil == null)    
                <label align="center" for="foto" title="Klik Untuk Upload Foto Personil" class="bi bi-upload" style="cursor: pointer; font-size: 25px;">
            </label>
            @else
                 <label title="Klik untuk ubah Foto Profil" align="center" for="foto" style="cursor: pointer; font-size: 25px;" class="bi bi-repeat"></label>
                &nbsp;
               <a href="/hapus-fopro/{{$personil->id}}" title="Klik untuk hapus Foto Profil" onclick="return confirm('Yakin Foto Profilnya mau di hapus ?')" style="color:black;">
                <i class="bi bi-file-earmark-x-fill" style="font-size: 25px;"></i>
               </a>
            @endif
             </td>
        </tr>
    </table>
</div>

<!-- foto KTA -->
<div class="col"> 
        <table align="center" class="mt-1 table table-sm" style="max-width: 20%;">
        <tr>
            <td align="center">
         <div class="container mt-3">
        <div class="card" align="center">
            <div class="card-header">Kartu Tanda Anggota</div> 
            <div class="card-body p-0"> 
                
             @if ($personil->foto_kd == null)
                   <div style="margin: auto;">
                    <div class="preview3">
                        <img id="file-ip-1-preview3" class="relative object-cover" hidden>
                    </div>
                    <input type="file" class="form-control pb-0 pt-0" name="kta" accept=".jpg, .jpeg, .png" id="kta" onchange="alert('Klik Tombol Update Untuk Menyimpan Perubahan'); showPreview3(event); myFunction3(); " hidden>  
                    <div id="myDIV3">
                      
                <label align="center" for="kta" style="cursor: pointer; font-size: 70px;" title="Klik untuk Upload Kartu Tanda Anggota" class="bi bi-image">
                </label>
                    </div>
                </div> 
              @else
                      <div class="preview3" >
             <img id="file-ip-1-preview3" hidden>
                </div>
                <div id="myDIV3">
                      <img class="img-thumbnail" src="{!! asset('/storage/personil/'); !!}/{{$personil->nip}}/{{$personil->foto_kd}}" title="Klik gambar untuk ganti Kartu KTA" width="150px" />
                  </div>
                <div class="col">
             <input type="file" class="form-control pb-0 pt-0" name="kta" accept=".jpg, .jpeg, .png" id="kta" alt="klik untuk ganti foto" onchange="alert('Klik Tombol Update Untuk Menyimpan Perubahan'); showPreview3(event); myFunction3(); " hidden />
              </div>
              @endif
            </div>
            </div>
        </div>
                </td>
            </tr>
            <tr align="center">
            <td>
            @if ($personil->foto_kd == null)    
                <label align="center" for="kta" style="cursor: pointer; font-size: 25px;" title="Klik untuk Upload Kartu Tanda Anggota" class="bi bi-upload">
                </label>
            @else
                 <label title="Klik untuk ubah Kartu Tanda Anggota" align="center" for="kta" style="cursor: pointer; font-size: 25px;" class="bi bi-repeat">
                 </label>
                &nbsp;
               <a href="/hapus-kta/{{$personil->id}}" title="Klik untuk hapus Kartu Tanda Anggota" onclick="return confirm('Yakin Kartu BPJS Ketenagakerjaan mau di hapus ?')" style="color:black;">
                <i class="bi bi-file-earmark-x-fill" style="font-size: 25px;"></i>
            </a>
            @endif
             </td>
        </tr>
    </table>
    </div>

<!-- foto BPJSS -->
    <div class="col"> 
        <table align="center" class="mt-1 table table-sm" style="max-width: 20%;">
        <tr>
            <td align="center">
         <div class="container mt-3">
        <div class="card" align="center">
            <div class="card-header">BPJS Kesehatan</div> 
            <div class="card-body p-0"> 
                
             @if ($personil->foto_bpjss == null)
                   <div style="margin: auto;">
                    <div class="preview1">
                        <img id="file-ip-1-preview1" class="relative object-cover" hidden>
                    </div>
                    <input type="file" class="form-control pb-0 pt-0" name="bpjss" accept=".jpg, .jpeg, .png" id="bpjss" onchange="alert('Klik Tombol Update Untuk Menyimpan Perubahan'); showPreview1(event); myFunction1(); " hidden>
                    <div id="myDIV1">
            <label align="center" for="bpjss" style="cursor: pointer; font-size: 70px;" title="Klik untuk Upload Kartu BPJS Kesehatan" class="bi bi-image">
                </label>
                    </div>
                </div> 
              @else
                      <div class="preview1">
             <img id="file-ip-1-preview1" hidden>
                </div>
                <div id="myDIV1">
                      <img src="{!! asset('/storage/personil/'); !!}/{{$personil->nip}}/{{$personil->foto_bpjss}}" class="img-thumbnail" title="Klik gambar untuk ganti foto profil" width="150px" />
                  </div>
                <div class="col">
             <input type="file" class="form-control pb-0 pt-0" name="bpjss" accept=".jpg, .jpeg, .png" id="bpjss" alt="klik untuk ganti foto" onchange="alert('Klik Tombol Update Untuk Menyimpan Perubahan'); showPreview1(event); myFunction1(); " hidden />
              </div>
              @endif
            </div>
            </div>
        </div>
                </td>
            </tr>
            <tr align="center">
            <td>
            @if ($personil->foto_bpjss == null)    
                <label align="center" for="bpjss" style="cursor: pointer; font-size: 25px;" title="Klik untuk Upload Kartu BPJS Kesehatan" class="bi bi-upload">
                </label>
            @else
                 <label title="Klik untuk ubah Kartu BPJS Kesehatan" align="center" for="bpjss" style="cursor: pointer; font-size: 25px;" class="bi bi-repeat">
                 </label>
                &nbsp;
               <a href="/hapus-bpjss/{{$personil->id}}" title="Klik untuk hapus Kartu BPJS Kesehatan" onclick="return confirm('Yakin Kartu BPJS Kesehatan mau di hapus ?')" style="color:black;">
                <i class="bi bi-file-earmark-x-fill" style="cursor: pointer; font-size: 25px;"></i>
            </a>
            @endif
             </td>
        </tr>
    </table>
    </div>

        <!-- foto BPJSK -->    
        <div class="col"> 
        <table align="center" class="mt-1 table table-sm" style="max-width: 20%;">
        <tr>
            <td align="center">
         <div class="container mt-3">
        <div class="card" align="center">
            <div class="card-header">BPJS Ketenagakerjaan</div> 
            <div class="card-body p-0"> 
                
             @if ($personil->foto_bpjsk == null)
                   <div style="margin: auto;">
                    <div class="preview2">
                        <img id="file-ip-1-preview2" class="relative object-cover" hidden>
                    </div>
                    <input type="file" class="form-control pb-0 pt-0" name="bpjsk" accept=".jpg, .jpeg, .png" id="bpjsk" onchange="alert('Klik Tombol Update Untuk Menyimpan Perubahan'); showPreview2(event); myFunction2(); " hidden>
                    <div id="myDIV2">
                <label align="center" for="bpjsk" style="cursor: pointer; font-size: 70px;" title="Klik untuk Upload Kartu BPJS Ketenagakerjaan" class="bi bi-image">
                </label>
                </div>
                </div>
              @else
                      <div class="preview2" >
             <img id="file-ip-1-preview2" hidden>
                </div>
                <div id="myDIV2">
                      <img class="img-thumbnail" src="{!! asset('/storage/personil/'); !!}/{{$personil->nip}}/{{$personil->foto_bpjsk}}" title="Klik gambar untuk ganti foto profil" width="150px" />
                  </div>
                <div class="col">
             <input type="file" class="form-control pb-0 pt-0" name="bpjsk" accept=".jpg, .jpeg, .png" id="bpjsk" alt="klik untuk ganti foto" onchange="alert('Klik Tombol Update Untuk Menyimpan Perubahan'); showPreview2(event); myFunction2(); " hidden />
              </div>
              @endif
            </div>
            </div>
        </div>
                </td>
            </tr>
            <tr align="center">
            <td>
            @if ($personil->foto_bpjsk == null)    
                <label align="center" for="bpjsk" style="cursor: pointer; font-size: 25px;" title="Klik untuk Upload Kartu BPJS Ketenagakerjaan" class="bi bi-upload">
            </label>
            @else
                 <label title="Klik untuk ubah Kartu BPJS Ketenagakerjaan" align="center" for="bpjsk" style="cursor: pointer; font-size: 25px;" class="bi bi-repeat">
                 </label>
                &nbsp;
               <a href="/hapus-bpjsk/{{$personil->id}}" title="Klik untuk hapus Kartu BPJS Ketenagakerjaan" onclick="return confirm('Yakin Kartu BPJS Ketenagakerjaan mau di hapus ?')" style="color:black;">
                <i class="bi bi-file-earmark-x-fill" style="cursor: pointer; font-size: 25px;"></i>
            </a>
            @endif
             </td>
        </tr>
    </table>
    </div>

    </div>
                <div class="row-md">
                    <table class="table table-striped" style="width: 100%; ">
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="nip" id="nip" value="{{$personil->nip}}" readonly></td> 
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control pb-0 pt-0" name="nama" id="nama" value="{{$personil->nama}}" required></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="jabatan" id="jabatan" value="{{$personil->jabatan}}" required></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>
                        <select class="form-select pb-0 pt-0" id="gender" name="gender" required>
                                <option value="{{$personil->gender}}">{{$personil->gender}}</option>
                            @if ($personil->gender == 'Laki-laki')
                                <option value="Perempuan">Perempuan</option>
                            @else
                                <option value="Laki-laki" >Laki-laki</option>
                            @endif
                        </select>
                    </td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>:</td>
                        <td><input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control pb-0 pt-0" name="pendidikan" id="pendidikan" value="{{$personil->pendidikan}}" required></td>
                    </tr>
                    <tr>
                        <td>Lokasi Tugas</td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0" id="lokasi_tugas" name="lokasi_tugas" required>
                                <option value="{{$id[0]->id}}">{{$personil->site->nama_gd}}</option>
                                @foreach($site as $item)
                                <option value="{{$item->id}}">{{$item->nama_gd}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Kompetensi Dasar</td>
                        <td>:</td>
                        <td>
                    <select class="form-select pb-0 pt-0" id="kd" name="kd" >
                    <option value="{{$personil->kd}}">{{$personil->kd}}</option>
                    @if ($personil->kd == 'Gada Pratama')
                    <option value="Gada Madya">Gada Madya</option> 
                    <option value="Gada Utama">Gada Utama</option>
                    @elseif ($personil->kd == 'Gada Madya')
                    <option value="Gada Madya">Gada Pratama</option> 
                    <option value="Gada Utama">Gada Utama</option>
                    @elseif ($personil->kd == 'Gada Utama')
                    <option value="Gada Madya">Gada Pratama</option> 
                    <option value="Gada Utama">Gada Madya</option>
                    @else
                    <option value="Gada Madya">Gada Pratama</option> 
                    <option value="Gada Utama">Gada Madya</option>
                    <option value="Gada Utama">Gada Utama</option>
                    @endif
                </select>
                        </td>
                    </tr>
                    <tr>
                        <td>No. Handphone</td>
                        <td>:</td>
                        <td><input type="text" onkeypress="return angka(event)" class="form-control pb-0 pt-0" name="no_hp" id="no_hp" value="{{$personil->no_hp}}" required></td>
                    </tr>
                    <tr>
                        <td style="max-width:10%">Alamat</td>
                        <td>:</td>
                        <td><textarea class="form-control pb-0 pt-0" name="alamat" id="alamat" required>{{$personil->alamat}}</textarea></td>
                    </tr>
                    <tr>
                        <td>Nama Bank</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="bank" id="bank" value="{{$personil->bank}}" required></td>
                    </tr>
                    <tr>
                        <td class="align-middle">No. Rekening</td>
                        <td>:</td>
                        <td><input type="text" onkeypress="return angka(event)" class="form-control pb-0 pt-0" name="norek" id="norek" value="{{$personil->norek}}" required></td>
                        </tr>
                    <tr>
                        <td class="align-middle">BPJS Kesehatan</td>
                        <td>:</td>
                        <td><input type="text" onkeypress="return angka(event)" class="form-control pb-0 pt-0" name="bpjs_sehat" id="bpjs_sehat" value="{{$personil->bpjs_sehat}}" required></td>
                    </tr>
                    <tr>
                        <td class="align-middle">BPJS Ketenagakerjaan</td>
                        <td>:</td>
                        <td><input type="text" onkeypress="return angka(event)" class="form-control pb-0 pt-0" name="bpjs_kerja" id="bpjs_kerja" value="{{$personil->bpjs_kerja}}" required></td>
                    </tr>
                    <tr>
                        <td class="align-middle">Tahun Pertama Bekerja</td>
                        <td>:</td>
                        <td>
                            <input type="text" onkeypress="return angka(event)" class="form-control pb-0 pt-0 m-0" name="lama_kerja" id="lama_kerja" value="{{$personil->lama_kerja}}">
                        </td>
                    </tr>
                    </table>
                </div>
                        </div>
                 <div class="col justify-content-md-center">
                    <div class="row-md">
                 <center>
                    <button type="submit" class="btn btn-primary" style = "text-align:center">
                        {{ __('Update') }}
                    </button>
                    <br/>
                    <br/>
                </center>
                     </div>
                    </div>
                    </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection