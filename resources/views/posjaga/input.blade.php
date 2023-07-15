@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Tambah Pos Jaga') }}
                    <a href="{{route('posjaga')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

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
            <form action="{{route('simpan_pos')}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
                    <table class="table mx-auto" style="width: 70%; ">

                    <tr>
                        <td>Pos Jaga</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="pos" id="pos" placeholder="Nama Pos" required></td>
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
                        <td>Area Jaga</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="area" id="area" placeholder="Area Penjagaan" required></td>
                    </tr>
                    <tr>
                        <td>Kategori Ring</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="ring" id="ring" ></td>
                    </tr>
                    <tr>
                        <td>Kekuatan Personil</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="person" id="person" placeholder="Jumlah Personil di Pos Jaga" required></td>
                    </tr>
                    <tr>
                        <td>Standar Peralatan</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="alat" id="alat" required></td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td>:</td>
                        <td><input type="file" class="form-control pb-0 pt-0" name="foto" id="foto" accept=".png, .jpg, .jpeg" multiple></td>
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