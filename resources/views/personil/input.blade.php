@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Tambah Data Personil') }}
                    <a href="{{route('personil')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

                </div>

                <div class="card-body overflow " style="overflow-x: auto;">

                        <style>
                            .table tr td {
                            word-wrap: break-word;
                            vertical-align: middle;
                            white-space: nowrap;
                            padding:1px !important;    
                            }
                        </style>
                        <!-- Error Handle -->
        @if ($errors->any())
            <div class="alert alert-danger flex flex-col md:justify-between" style="width: 80%; margin: 0 auto;">
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
                                <div align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
                                    <div class="row">
                                        <div class="col">
                            <div class="card-text" align="center">
                                        {{ $message }} data dengan nama <b>{{Session::get('name')}}</b> berhasil di Input <br/>
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

                    <!-- form input personil -->
                        <form action="{{route('simpan_personil')}}" method="post" id="form" enctype="multipart/form-data">
                @csrf
                    <div class="table-responsive mt-2 ">
                        <div class="row" align="center">

            <div class="col-md-auto">
                <div style="margin: auto;">
                    Upload Foto Profil
                    <div class="preview">
                        <img id="file-ip-1-preview" class="relative object-cover">
                    </div>
                    <div id="myDIV" >
                        <input type="file" class="form-control pb-0 pt-0" name="foto" accept=".jpg, .jpeg, .png" id="foto" onchange="alert('Pastikan Foto yang di Unggah Benar'); showPreview(event); myFunction(); " hidden>
                        <label align="center" for="foto" title="Klik Untuk Upload Foto Personil" class="bi bi-person-circle" style="font-size: 70px;"></label>
                    </div>
                    <kbd>
                        <label align="center" for="foto" title="Klik Untuk Upload Foto Personil" class="bi bi-upload" style="font-size: 20px;"></label>
                    </kbd>
                </div> 
            </div>
                            <div class="col-md-10">
                     
                    <table class="table mx-auto table-striped" style="width: 70%; ">
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="nip" id="nip" value="" required></td> 
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" onkeyup="this.value = this.value.toUpperCase();" name="nama" id="nama" value="" required></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" onkeyup="this.value = this.value.toUpperCase();" name="jabatan" id="jabatan" value="" required></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>
                        <select class="form-select pb-0 pt-0 text-capitalize" id="gender" name="gender" required>
                        	<option value="" disabled selected>Pilih Jenis Kelamin</option> 
                            <option value="Laki-laki">Laki-laki</option> 
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" onkeyup="this.value = this.value.toUpperCase();" name="pendidikan" id="pendidikan"  required></td>
                    </tr>
                    <tr>
                        <td>Lokasi Tugas</td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0 text-capitalize" id="lokasi_tugas" name="lokasi_tugas" required>
                                <option value="" disabled selected>Pilih Lokasi Gedung</option>
                                @foreach($site as $item)
                                <option value="{{$item->id}}">{{$item->nama_gd}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Upload Kartu KTA</td>
                        <td>:</td>
                        <td><input type="file" accept=".jpeg, .jpg, .png" name="kta" id="kta" ></td>
                    </tr>
                    <tr>
                        <td>Kompetensi Dasar</td>
                        <td>:</td>
                        <td>
                        <select class="form-select pb-0 pt-0 text-capitalize" id="kd" name="kd" >
                            <option value="" disabled selected>Pilih Kompetensi Dasar</option> 
                            <option value="Gada Pratama">Gada Pratama</option> 
                            <option value="Gada Madya">Gada Madya</option> 
                            <option value="Gada Utama">Gada Utama</option> 
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td>No. Handphone</td>
                        <td>:</td>
                        <td><input type="text" onkeypress="return angka(event)" class="form-control pb-0 pt-0" name="no_hp" id="no_hp" required></td>
                    </tr>
                    <tr>
                        <td style="max-width:10%">Alamat</td>
                        <td>:</td>
                        <td><textarea class="form-control pb-0 pt-0" name="alamat" id="alamat" required></textarea></td>
                    </tr>
                    <tr>
                        <td>Nama Bank</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" onkeyup="this.value = this.value.toUpperCase();" name="bank" id="bank" required></td>
                    </tr>
                    <tr>
                        <td class="align-middle">No. Rekening</td>
                        <td>:</td>
                        <td><input type="text" onkeypress="return angka(event)" class="form-control pb-0 pt-0" name="norek" id="norek" required></td>
                    </tr>
                    <tr>
                        <td class="align-middle">Nomor BPJS Kesehatan</td>
                        <td>:</td>
                        <td><input type="text" onkeypress="return angka(event)" class="form-control pb-0 pt-0" name="bpjs_sehat" id="bpjs_sehat" required></td>
                    </tr>
                    <tr>
                        <td class="align-middle">Upload Kartu BPJS Kesehatan</td>
                        <td>:</td>
                        <td><input type="file" accept=".jpeg, .jpg, .png" name="bpjss" id="bpjss" ></td>
                    </tr>
                    <tr>
                        <td class="align-middle">BPJS Ketenagakerjaan</td>
                        <td>:</td>
                        <td><input type="text" onkeypress="return angka(event)" class="form-control pb-0 pt-0" name="bpjs_kerja" id="bpjs_kerja" required></td>
                    </tr>
                    <tr>
                        <td class="align-middle">Upload Kartu BPJS Ketenagakerjaan</td>
                        <td>:</td>
                        <td><input type="file" accept=".jpeg, .jpg, .png" name="bpjsk" id="bpjsk" ></td>
                    </tr>
                    <tr>
                        <td class="align-middle">Lama Bekerja di OJK</td>
                        <td>:</td>
                        <td scope="col">
                            <div class="row justify-content-center">
                                <div class="col">
                            <input type="text" class="form-control pb-0 pt-0 m-0" name="lama_kerja" id="lama_kerja" >
                                </div>
                                <div class="col-md-auto m-auto" >
                                    <strong> Tahun </strong>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </table>
                <center>
                    <button type="submit" class="btn btn-primary" style = "text-align:center">
                        {{ __('Simpan') }}
                    </button>
                </center>
                    
                    </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection