@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Laporan Insiden / Kejadian') }}
                    <a href="{{route('jadi-tambah')}}"><span class="btn btn-primary float-right btn-sm">Buat Laporan</span></a>
                </div>
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
                            background-color: seashell;
                        }
                        label {
                            margin: 0em;
                        }
                    </style>

                <div class="card-body overflow " style="overflow-x: auto;">
        
        <center class="mb-2">
            @if ($message = Session::get('berhasil'))
            <div id="timeout" align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between mx-1" style="width: 80%; margin: 0 auto;" role="alert">
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
        </center>
        @elseif ($message = Session::get('warning'))
        <div id="timeout" align="center" class="alert alert-warning alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between mx-1" style="width: 80%; margin: 0 auto;" role="alert">
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
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        @if ($start == null)

                        @else
                        @if ($data->count() == 0)

                        @else
                        <a href="kejadian/export/{{$start}}/{{$end}}/{{$data->count()}}"><span class="btn btn-primary btn-sm float-left">Export Excel</span></a>
                        {{-- <a href="kegiatan/export/{{$start}}/{{$end}}"><span class="btn btn-primary btn-sm float-left"><s>Export Excel</s></span></a> --}}
                        @endif
                        @endif
                    <form action="" method="GET" class="float-right mb-2">Pilih Tanggal: 
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="start" > - 
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="end" >
                        <button class="submit bi bi-search"></button>
                    </form>
                    @else
                    <form action="" method="GET" class="float-right mb-2">
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="date">
                        <button class="submit bi bi-search"></button>
                    </form>
                       @endif

                    <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm text-center ">
                    <tr class="font-weight-normal xx ">
                        <th scope="col" class="align-middle" style="max-width:50px; min-width:30px;">No</th>
                        <th scope="col" class="align-middle">No Laporan</th>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        <th scope="col" class="align-middle">User Pelapor</th>
                        @endif
                        <th scope="col" class="align-middle">Jenis Kejadian</th>
                        <th scope="col" class="align-middle">Lokasi Kejadian</th>
                        <th scope="col" class="align-middle">Jenis Potensi</th>
                        <th scope="col" class="align-middle">Waktu Kejadian</th>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                       <th class="align-middle" style="width:72px; ">Option</th>
                       @endif
                    </tr>

                    @if ($data->count() == 0)
                    <tr>
                        <td colspan="8"> Data Tidak Ditemukan</td>
                    </tr>
                    @endif

                    @foreach ($data as $key => $jadi)
                    <tr title="klik untuk lihat detail" style="cursor:pointer;">
                        <td onclick="window.location='/kejadian-detil/{{$jadi->no_lap}}'">{{$data->firstitem()+$key}}</td>
                        <td onclick="window.location='/kejadian-detil/{{$jadi->no_lap}}'">{{$jadi->no_lap}}</td>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        <td onclick="window.location='/kejadian-detil/{{$jadi->no_lap}}'" style="text-align: left;">{{$jadi->user_pelapor}}</td>
                        @endif
                        <td onclick="window.location='/kejadian-detil/{{$jadi->no_lap}}'" style="text-align: left;">
                            @if ('Lain-lain :' == Str::substr($jadi->jenis_kejadian, 0,11))
                            {{Str::substr($jadi->jenis_kejadian, 11,1000)}}
                            @else
                            {{$jadi->jenis_kejadian}}<br>
                            @endif
                        </td>
                        <td onclick="window.location='/kejadian-detil/{{$jadi->no_lap}}'" style="white-space: normal; text-align: left;">{{$jadi->site->nama_gd}}</td>
                        <td onclick="window.location='/kejadian-detil/{{$jadi->no_lap}}'" style="text-align: left;">
                            @if ('Lain-lain :' == Str::substr($jadi->jenis_potensi, 0,11))
                            {{Str::substr($jadi->jenis_potensi, 11,1000)}}
                            @else
                            {{$jadi->jenis_potensi}}<br>
                            @endif
                        </td>
                        <td onclick="window.location='/kejadian-detil/{{$jadi->no_lap}}'">{{Carbon\Carbon::parse($jadi->waktu_kejadian)->isoFormat('dddd, D MMMM Y')}}</td>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        <td>
                            <div class="d-flex align-content-center">
                        <a href="{{url('kejadian-edit')}}/{{$jadi->id}}" hidden>
                            <button id="{{$data->firstitem() + $key}}" type="submit" title="Edit Data ">
                            </button>
                        </a>
                        <label for="{{$data->firstitem() + $key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn-sm align-self-center">

                        </label>
                        <pre> </pre>
                        <form action="kejadian/hapus/{{$jadi->id}}" method="post" class="align-self-center m-auto">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button id="del{{$data->firstitem() + $key}}" onclick="return confirm('Yakin nih no Laporan {{$jadi->no_lap}} mau di hapus ?')" type="submit" title="Hapus Data" hidden>
                                </button>
                                <label for="del{{$data->firstitem() + $key}}" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn-sm align-self-center">
                                </label>
                        </form>
                    </div>
                        </td>
                         @endif
                    </tr>
                    @endforeach
                    <style>
                         a {color:black;}
                        a:hover { color:rgb(0, 138, 0);}
                        label:hover { color:rgb(0, 138, 0);}
                    </style>
                    </table>
                    </div>
                    {{$data->onEachSide(1)->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

