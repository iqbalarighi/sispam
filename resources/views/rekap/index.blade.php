@extends('layouts.side')

@section('content')
{{-- @if (Auth::user()->role === 'user')
        {{abort(404)}}
@endif --}}
<style>
                        .xx {
                            font-size: 11pt;
                            text-align: center;
                        }
                        .table tr td {
                            padding:0.2rem;
                            vertical-align: middle;
                            max-width:100%;
                            white-space: nowrap;
                            font-size: 11pt;
                        }
                        .table th {
                            padding:0.2rem;
                            white-space: nowrap;
                        }
                        label {
                            margin: 0em;
                        }
                    </style>
                    <style>
                        a {color:black;}
                       a:hover { color:rgb(0, 138, 0);}
                       label:hover { color:rgb(0, 138, 0);}
                    </style>
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Rekap Harian SMC') }}
                    @if (Auth::user()->role === "admin") 
                    <a href="{{route('tambah_rekap')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
                    @endif
                </div>

                
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
        @if ($message = Session::get('status'))
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
    <!-- Notifikasi -->
                <div >
                    <form action="" method="GET" class="float-sm-right p-1">
                        <input type="text" name="cari" align="left" autocomplete="off" placeholder="Cari Rekap Harian">
                    {{--    Pilih Tanggal: 
                         <input type="date" class=""  name="start" > - 
                        <input type="date" class=""  name="end" > --}}
                        <button class="submit bi bi-search"></button>
                    </form>
                </div>
        <div class="card-body overflow " style="overflow-x: auto;">

                    <table class="table table-hover table-striped text-center"  align="center">
                    <tr class="font-weight-normal xx ">
                        <th class="align-middle" style="max-width:50px; min-width:30px;">No</th>
                        <th class="align-middle" style="">Nama File</th>
                        <th class="align-middle">Tahun</th>
                        @if (Auth::user()->role === 'admin')
                       <th class="align-middle" style="width:72px; ">Option</th>
                        @endif
                    </tr>

                     @if ($rekap->count() == null)
                    <tr>
                        <td colspan="4"> Data Tidak Ditemukan</td>
                    </tr>
                    @endif

                    @foreach($rekap as $key => $item) 
                    <tr>
                        <td style="cursor: pointer;" onclick="window.location='/rekap_detil/{{$item->id}}'">{{$rekap->firstitem() + $key}}</td>
                        <td style="white-space: normal; text-align: left; cursor: pointer;" onclick="window.location='/rekap_detil/{{$item->id}}'">{{$item->nama_file}}</td> 
                        <td style="cursor: pointer;" onclick="window.location='/rekap_detil/{{$item->id}}'">{{Carbon\Carbon::parse($item->bulan)->isoFormat('YYYY')}}</td>
                        @if (Auth::user()->role === 'admin')
                        <td style="vertical-align: middle;"> 
                            <div >
                                <form action="hapus_rekap/{{$item->id}}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button id="del{{$rekap->firstitem() + $key}}" onclick="return confirm('Yakin nih {{$item->nama_file}} mau di hapus ?')" type="submit" title="Hapus Data " hidden>
                                        </button>
                                        <label for="del{{$rekap->firstitem() + $key}}" class="bi bi-trash-fill bg-danger btn-sm align-self-center"></label>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    
                    </table>
        </div>
                <br/>
                {{$rekap->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>
@endsection
