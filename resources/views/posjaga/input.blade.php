@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Tambah Data Pos Jaga') }}
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
            <form action="#" method="post" id="form" enctype="multipart/form-data">
            @csrf
                    <table class="table mx-auto" style="width: 70%; ">
                    <tr>
                        <td>Id Jaga</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="id" id="id" required></td> 
                    </tr>
                    <tr>
                        <td>Pos Jaga</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="pos" id="pos" required></td>
                    </tr>
                    <tr>
                        <td>Gedung</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="gedung" id="gedung" required></td>
                    </tr>
                    <tr>
                        <td>Area Jaga</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="area" id="area" required></td>
                    </tr>
                    <tr>
                        <td>Kategori Ring</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="ring" id="ring" required></td>
                    </tr>
                    <tr>
                        <td>Personil Jaga</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="jaga" id="jaga" required></td>
                    </tr>
                    <tr>
                        <td>Standar Peralatan</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="alat" id="alat" required></td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td>:</td>
                        <td><input type="file" class="form-control pb-0 pt-0" name="foto" id="foto" accept=".png, .jpg, .jpeg" required></td>
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