@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
                <!-- Notifikasi -->
        @if ($message = Session::get('sukses'))
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
            <p/>
        @endif
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Kegiatan') }}
                    <a href="{{route('tambah-giat')}}"><span class="btn btn-primary float-right btn-sm">Buat Laporan</span></a>
                </div>

                <div class="card-body overflow " style="overflow-x: auto;">

                    <style>
                        .xx {
                            font-size: 10pt;
                            text-align: center;
                        }
                        .table tr td {
                            padding:0.3rem;
                            vertical-align: middle;
                            max-width:100%;
                            white-space:nowrap;
                        }
                        .table th {
                            padding:0.3rem;
                            white-space:nowrap;
                            vertical-align: middle;
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



                        @if (Auth::user()->role === 'admin')
                    <form action="" method="GET" class="float-right mb-3">
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="start" >
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="end" >
                        <button class="submit bi bi-search"></button>
                    </form>
                    @else
                    <form action="" method="GET" class="float-right mb-3">
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="date">
                        <button class="submit bi bi-search"></button>
                    </form>
                       @endif
                    
                    <table class="table table-bordered table-striped table-hover text-center ">
                    <tr class="font-weight-normal xx ">
                        <th style="max-width:50px; min-width:30px;">No</th>
                        <th>No. Laporan</th>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                       <th style="width:72px; ">Danru</th>
                       @endif
                        <th>Shift</th>
                        <th>Hari/Tanggal</th>
                        <th>Jam</th>
                        <th>Lokasi</th>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        
                       <th style="width:72px; ">Option</th>
                       @endif
                    </tr>

                    @if ($giats->count() == 0)
                    <tr>
                        <td colspan="6"> Data Tidak Ditemukan</td>
                    </tr>
                    @else

                    @foreach($giats as $key => $giat)
                    <tr style="cursor: pointer; user-select: none;">
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'" title="klik untuk lihat detail">{{$giats->firstitem() + $key}}</td>
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'" title="klik untuk lihat detail">{{$giat->no_lap}}</td>
                         @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'" title="klik untuk lihat detail">{{$giat->danru}}</td>
                       @endif
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'"  title="klik untuk lihat detail">
                    @if ( Carbon\Carbon::parse($giat->created_at)->isoFormat('HHmmss') >= 200000)
                        Shift Malam 19.00 - 07.00 WIB
                    @elseif (Carbon\Carbon::parse($giat->created_at)->isoFormat('HHmmss') <= 80000)
                        Shift Malam 19.00 - 07.00 WIB
                    @else
                        Shift Pagi 07.00 - 19.00 WIB
                    @endif
                        </td>
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'" title="klik untuk lihat detail">{{Carbon\Carbon::parse($giat->tanggal)->isoFormat('dddd, D MMMM Y')}}</td>
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'" title="klik untuk lihat detail">{{Carbon\Carbon::parse($giat->created_at)->isoFormat('HH:mm')}} WIB</td>
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'" title="klik untuk lihat detail">{{$giat->site->nama_gd}}</td>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        
                        <td class="d-flex align-items-md-center" >
                        <a href="{{url('edit-giat')}}/{{$giat->id}}" hidden>
                            <button id="{{$giats->firstitem() + $key}}" type="submit" title="Edit Data {{$giat->no_lap}}">
                            </button>
                        </a>
                        <label for="{{$giats->firstitem() + $key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn-sm align-self-center">

                        </label>
                            &nbsp;
                        <form action="hapus-giat/{{ $giat->id }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button id="del{{$giats->firstitem() + $key}}" onclick="return confirm('Yakin nih datanya mau di hapus ?')" type="submit" title="Hapus Data {{$giat->no_lap}}" hidden>
                                </button>
                                <label for="del{{$giats->firstitem() + $key}}" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn-sm align-self-center">

                                </label>
                        </form>
                        </td>
                         @endif
                    </tr>
                    @endforeach

                    @endif
                    </table>
                </div>
                {{$giats->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>
@endsection