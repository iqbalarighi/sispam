@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
                <!-- Notifikasi -->
        @if ($message = Session::get('sukses'))
            <div id="timeout" align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
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
                
                <div class="card-header text-uppercase font-weight-bold">{{ __('Laporan Atensia') }}
                    @if (Auth::user()->role === 'admin')
                    <a href="{{route('lap_atensi')}}"><span class="btn btn-primary float-right btn-sm">Buat Laporan</span></a>
                    @endif
                </div>             
                

                    <style>
                        .xx {
                            font-size: 10pt;
                            text-align: center;
                        }
                        .table tr td {
                            padding:0.3rem;
                            vertical-align: middle;
                            text-align: center !important;
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

                <div class="card-body overflow pt-1 pb-1" style="overflow-x: auto;">

                   {{--     @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        @if ($start == null)

                        @else
                         <a href="kegiatan/export/{{$start}}/{{$end}}"><span class="btn btn-primary btn-sm">Export Excel</span></a> 
                        @endif
                    <form action="" method="GET" style="text-align: right !important;" class="float-right mb-2 mt-2 mr-2">Pilih Tanggal: 
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="start"> - 
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="end" >
                        <button class="submit bi bi-search"></button>
                    </form>
                    @else
                    <form action="" method="GET" class="float-right mb-2">
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="date">
                        <button class="submit bi bi-search"></button>
                    </form>
                       @endif--}}
                    
                    <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm text-center ">
                    <tr class="font-weight-normal xx ">
                        <th style="max-width:50px; min-width:30px;">No</th>
                        @if (Auth::user()->level === 'superadmin' || Auth::user()->role === 'admin')
                       <th style="width:72px; ">Dibuat Oleh</th>
                       @endif
                        <th>Rencana Kegiatan Oleh</th>
                        <th>Hari/Tanggal</th>
                       <th style="width:72px; ">Option</th>
                    </tr>

                    @if ($data->count() == 0)
                    <tr>
                        <td colspan="8"> Data Tidak Ditemukan</td>
                    </tr>
                    @else

                    @foreach($data as $key => $item)
                    <tr style="cursor: pointer; user-select: none;">
                        <td onclick="window.location='/atensi_detil/{{$item->id}}'" title="klik untuk lihat detail">{{$data->firstitem() + $key}}</td>
                         @if (Auth::user()->level === 'superadmin' || Auth::user()->role === 'admin')
                        <td onclick="window.location='/atensi_detil/{{$item->id}}'" title="klik untuk lihat detail" style="text-align: left;">{{$item->creator}}</td>
                       @endif

                        <td onclick="window.location='/atensi_detil/{{$item->id}}'"  title="klik untuk lihat detail" style="text-align: left;">
                        {{Str::substr($item->rencana, 15,1000)}}
                        </td>
                        <td onclick="window.location='/atensi_detil/{{$item->id}}'" title="klik untuk lihat detail">{{Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y')}}</td>
                        
                        @if (Auth::user()->name == $item->creator || Auth::user()->level === 'superadmin')
                        <td class="d-flex p-0" >
                        <a href="{{url('edit_atensi')}}/{{$item->id}}" hidden>
                            <button id="{{$data->firstitem() + $key}}" type="submit" title="Edit Data">
                            </button>
                        </a>
                        
                        <label for="{{$data->firstitem() + $key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn-sm align-self-center"></label>

                            <pre> </pre>
                        <form action="hapus_atensi/{{ $item->id }}" method="post" class="align-self-center">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button id="del{{$data->firstitem() + $key}}" onclick="return confirm('Yakin nih datanya mau di hapus ?')" type="submit" title="Hapus Data " hidden>
                                </button>
                                <label for="del{{$data->firstitem() + $key}}" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn-sm align-self-center">

                                </label>
                        </form>
                        </td> 
                        @else 
                        <td class="d-flex p-0" >
                        <label style="cursor: not-allowed;" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn-sm align-self-center"></label>
                         <pre> </pre>
                        <label style="cursor: not-allowed;" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn-sm align-self-center"></label>
                        </td> 
                         @endif
                    </tr>
                    @endforeach

                    @endif
                    </table>
                </div>
                {{$data->onEachSide(1)->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection