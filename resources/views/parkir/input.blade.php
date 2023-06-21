@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Tambah Lot Parkir') }}
                    <a href="{{route('parkir')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

                </div>

                <div class="card-body overflow " >
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
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" align="right"></button>
        </div>                
                    </div>
                </div>
            </div>
        @endif

            <!-- form input Site -->
                    <div class="table-responsive mt-2" style="overflow-x: auto;">
            <form action="{{route('simpan_lot')}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
                    <table class="table mx-auto" style="width: 70%; ">
                    <tr>
                        <td>Kode</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="kode" id="kode" onkeyup="this.value = this.value.toUpperCase();" required></td> 
                    </tr>
                    <tr>
                        <td>Lantai</td>
                        <td>:</td>
                        <td><input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control pb-0 pt-0" name="lantai" id="lantai" required></td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td><input type="text" onkeypress="return angka(event)" class="form-control pb-0 pt-0" name="nip" id="nip" required></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control pb-0 pt-0" name="nama" id="nama" required></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="jabatan" id="jabatan" required></td>
                    </tr>
                    <tr>
                        <td>Akses</td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0" id="akses" name="akses" required>
                                <option disabled selected>Pilih Akses</option>
                                <option value="0">Aktif</option>
                                <option value="1">Nonaktif</option>
                            </select>
                        </td> 
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0" id="aktif" name="aktif" required>
                                <option disabled selected>Pilih Status</option>
                                <option value="0">Aktif</option>
                                <option value="1">Nonaktif</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td><textarea type="text" class="form-control pb-0 pt-0" name="keterangan" id="keterangan"></textarea>
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