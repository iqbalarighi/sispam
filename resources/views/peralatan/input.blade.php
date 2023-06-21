@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Tambah Data Inventaris') }}
                    <a href="{{route('peralatan')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

                </div>

                <div class="card-body overflow " >
                    @if (session('status'))
                        <div id="timeout" class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <style>
                            .table tr td {
                            word-wrap: break-word;
                            vertical-align: middle;
                            white-space: nowrap;
                            padding:1px !important;    
                            }
                        </style>
                    <div class="table-responsive mt-2" style="overflow-x: auto;">
            <form action="{{route('simpan_peralatan')}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
                    <table class="table mx-auto table-striped" style="width: 70%; ">
                    <tr>
                        <td>Alat</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="alat" id="alat" value="" required></td> 
                    </tr>
                    <tr>
                        <td>No. Inventaris</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="noinv" id="noinv" value="" required></td> 
                    </tr>
                    <tr>
                        <td>Satuan</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="satuan" id="satuan" value="" required></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>:</td>
                        <td><input type="text" onkeypress="return angka(event)" class="form-control pb-0 pt-0" name="jumlah" id="jumlah" value="" required></td>
                    </tr>
                    <tr>
                        <td>Gedung</td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0 text-capitalize" id="gedung" name="gedung" required>
                                <option value="" disabled selected>Pilih Gedung</option>
                                @foreach($site as $item)
                                <option value="{{$item->id}}">{{$item->nama_gd}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Ruang</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="ruang" id="ruang" value="" required></td>
                    </tr>
                    <tr>
                        <td>Milik</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="milik" id="milik" value="" required></td>
                    </tr>
                    <tr>
                        <td>Kondisi</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="kondisi" id="kondisi" value="" required></td>
                    </tr>
                    <tr>
                        <td>Riwayat Pemeliharaan</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="riwayat" id="riwayat" value="" required></td>
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