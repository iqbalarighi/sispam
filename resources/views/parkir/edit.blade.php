@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Edit Lot Parkir') }}
                    <a href="{{route('parkir')}}"><span class="btn btn-primary float-right btn-sm">Kembali</span></a>

                </div>

                <div class="card-body overflow " style="overflow-x: auto;">

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
                        <style>
                            .table tr td{
                            word-wrap: break-word;
                            vertical-align: middle;
                            white-space: nowrap;
                            padding:1px !important;    
                            }
                        </style>
                    <div class="table-responsive mt-2 justify-content:center">
            <form action="/parkir-update/{{$parkir->id}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                    <table class="table mx-auto" style="width: 70%; ">
                    <tr>
                        <td>Kode</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" value="{{$parkir->kode}}" disabled></td> 
                    </tr>
                    <tr>
                        <td>Lantai</td>
                        <td>:</td>
                        <td><input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control pb-0 pt-0" name="lantai" id="lantai" value="{{$parkir->lantai}}" required></td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" value="{{$parkir->nip}}" disabled></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control pb-0 pt-0" name="nama" id="nama" value="{{$parkir->nama}}" required></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="jabatan" id="jabatan" value="{{$parkir->jabatan}}" required></td>
                    </tr>
                    <tr>
                        <td>Akses</td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0" id="akses" name="akses"  required>
                                <option value="{{$parkir->akses}}" >
                                @if ($parkir->akses == 0)
                                Aktif
                                @else 
                                Nonaktif
                                @endif
                                </option>
                                @if ($parkir->akses == 0)
                                <option value="1">Nonaktif</option>
                                @else 
                                <option value="0">Aktif</option>
                                @endif
                            </select>
                        </td> 
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0" id="aktif" name="aktif" required>
                                <option value="{{$parkir->aktif}}" >
                                @if ($parkir->aktif == 0)
                                Aktif
                                @else 
                                Nonaktif
                                @endif
                                </option>
                                @if ($parkir->aktif == 0)
                                <option value="1">Nonaktif</option>
                                @else 
                                <option value="0">Aktif</option>
                                @endif
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td><textarea type="text" class="form-control pb-0 pt-0" name="keterangan" id="keterangan" >{{$parkir->keterangan}}</textarea>
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