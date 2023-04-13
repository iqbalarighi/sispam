@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Edit Site') }}
                    <a href="{{route('site')}}"><span class="btn btn-primary float-right btn-sm">Kembali</span></a>

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
            <form action="/site-update/{{$site->id}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                    <table class="table mx-auto" style="width: 70%; ">
                    <tr>
                        <td>Kode</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="kode" id="kode" value="{{$site->kode}}" disabled></td> 
                    </tr>
                    <tr>
                        <td>Nama Gedung</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="gedung" id="gedung" value="{{$site->nama_gd}}" required></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="alamat" id="alamat" value="{{$site->alamat_gd}}" ></td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="nopon" id="nopon" value="{{$site->nopon}}" ></td>
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