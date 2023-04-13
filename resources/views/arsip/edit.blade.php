@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Edit Arsip') }}
                    <a href="{{route('arsip')}}"><span class="btn btn-primary float-right btn-sm">Kembali</span></a>

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

            @if (session('error'))
            <div align="center" class="alert alert-danger alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
            
            <div class="row">
                    <div class="col">
        <div class="card-text" align="center">
                {{ session('error') }}
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
        @if ($message = Session::get('success'))
            <div align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
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
                        <style>
                            .table tr td{
                            word-wrap: break-word;
                            vertical-align: middle;
                            white-space: nowrap;
                            padding:1px !important;    
                            }
                        </style>
                    <div class="table-responsive mt-2 justify-content:center">
            <form action="/arsip-update/{{$edit->id}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                    <table class="table mx-auto" style="width: 70%; ">
                    <tr>
                        <td>Nomor Arsip</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="no_arsip" id="no_arsip" value="{{$edit->no_arsip}}" readonly></td> 
                    </tr>
                    <tr>
                        <td>Nama Arsip</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="nm_arsip" id="nm_arsip" value="{{$edit->nm_arsip}}" required></td> 
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="tahun" id="tahun" value="{{$edit->tahun}}" required></td>
                    </tr>
                    <tr>
                        <td>Uraian</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="uraian" id="uraian" value="{{$edit->uraian}}" required></td>
                    </tr>
                    <tr>
                        <td>Lokasi Fisik</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="lokasi_fisik" id="lokasi_fisik" value="{{$edit->lokasi_fisik}}" required></td>
                    </tr>
                    <tr>
                        <td>File</td>
                        <td>:</td>
                        <td>
                            @if ($edit->file == null)
                            <input type="file" class="form-control pb-0 pt-0" accept=".pdf,.csv,.xls,.xlsx,.doc,.docx,.zip" name="arsip" id="arsip" value="{{$edit->file}}" >
                            @else 
                        <a href="{{ asset('storage/arsip/')}}/{{$edit->tahun.'/'.$edit->file }}" target="_blank" rel="noopener noreferrer">{{$edit->file}}</a>

                                <span id="del" onclick="window.location='/arsip/file/{{$edit->id}}'; return confirm('Anda Yakin {{$edit->nm_arsip}} mau di hapus ?')" type="submit" title="Hapus File" class="bi bi-trash-fill btn-sm align-self-center">
                                    </span>

                         @endif

                        </td>
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