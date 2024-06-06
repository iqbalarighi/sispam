@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Edit Inventaris') }}
                    <a href="{{route('peralatan')}}"><span class="btn btn-primary float-right btn-sm">Kembali</span></a>

                </div>

                <div class="card-body overflow " style="overflow-x: auto;">
                    @if (session('hore'))
                        <div id="timeout" class="alert alert-success" role="alert">
                            {{ session('hore') }}
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
            <form action="/peralatan-update/{{$alat->id}}" method="post" id="form">
            @csrf
            @method('PUT')
                    <table class="table mx-auto" style="width: 70%; ">
                    <tr>
                        <td>Alat</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="alat" id="alat" value="{{$alat->alat}}" readonly></td> 
                    </tr>
                    <tr>
                        <td>No. Inventaris</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="noinv" id="noinv" value="{{$alat->no_inventaris}}" readonly></td> 
                    </tr>
                    <tr>
                        <td>Satuan</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="satuan" id="satuan" value="{{$alat->satuan}}" required></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>:</td>
                        <td><input type="text" onkeypress="return angka(event)" class="form-control pb-0 pt-0" name="jumlah" id="jumlah" value="{{$alat->jumlah}}" required></td>
                    </tr>
                    <tr>
                        <td>Gedung</td>
                        <td>:</td>
                        <td>
                            <!-- <input type="text" class="form-control pb-0 pt-0" name="gedung" id="gedung" value="{{$alat->site->nama_gd}}" required> -->
                            <select class="form-select pb-0 pt-0" id="gedung" name="gedung" required>
                                <option value="{{$id[0]->id}}">{{$alat->site->nama_gd}}</option>
                                @foreach($site as $item)
                                <option value="{{$item->id}}">{{$item->nama_gd}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Ruang</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="ruang" id="ruang" value="{{$alat->ruang}}" required></td>
                    </tr>
                    <tr>
                        <td>Milik</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="milik" id="milik" value="{{$alat->milik}}" required></td>
                    </tr>
                    <tr>
                        <td>Kondisi</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="kondisi" id="kondisi" value="{{$alat->kondisi}}" required></td>
                    </tr>
                    <tr>
                        <td>Riwayat Pemeliharaan</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="riwayat" id="riwayat" value="{{$alat->riwayat}}" required></td>
                    </tr>
                    </table>
                        <center>
                            <button type="submit" class="btn btn-primary" style = "text-align:center">
                                {{ __('Update') }}
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