@extends('layouts.side')

@section('content')
                    <style>
                        .xx {
                            font-size: 10pt;
                            text-align: center;
                        }
                        .table tr td {
                            padding:0.1rem;
                            vertical-align: middle;
                            max-width:100%;
                            white-space:nowrap;
                        }
                        .table th {
                            padding:0.1rem;
                            white-space: normal;
                            vertical-align: middle;
                            /*background-color: seashell;*/
                        }
                        label {
                            margin: 0em;
                        }
                    </style>

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
        @if(Auth::user()->role === 'admin')
                <div class="card-header text-uppercase font-weight-bold">{{ __('Laporan Kegawatdaruratan') }}
                    <a href="{{route('tambah-bencana')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
                </div>
        @endif
                <div class="card-body overflow " style="overflow-x: auto;">
{{-- Content disini --}}

                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        {{-- @if ($start == null)

                        @else
                        @if ($bencana->count() == 0)

                        @else
                        <a href="kejadian/export/{{$start}}/{{$end}}/{{$bencana->count()}}"><span class="btn btn-primary btn-sm float-left">Export Excel</span></a>

                        @endif
                        @endif --}}
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

            <table class="table table-striped table-hover table-sm text-center mt-3">
                <tr>
                    <th>No.</th>
                    <th>Nomor Laporan</th>
                    <th>Tanggal Kejadian</th>
                    <th>Jenis Kejadian</th>
                    <th>Lokasi Terdampak</th>
                    <th>Dibuat</th>
                    <th>Terakhir Diperbarui</th>
                    @if (Auth::user()->role === 'admin')
                        <th>Nama Pelapor</th>
                        <th>Status</th>
                        <th>Option</th>
                    @endif
                    
                </tr>
                @if($bencana->count() == null)
                <tr>
                    <td align="center" colspan="10">Laporan Tidak Ditemukan</td>
                </tr>
                @else
                @foreach ($bencana as $key => $item)
                <tr style="cursor:pointer;">
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">{{$bencana->firstItem() + $key}}</td>
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">{{$item->no_bencana}}</td>
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">{{Carbon\Carbon::parse($item->tanggal)->isoFormat('DD/MM/Y')}}</td>
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">
                        @if ('Man-made Hazard : ' == Str::substr($item->jenis_bencana, 0,18))
                        {{Str::substr($item->jenis_bencana, 18,1000)}}
                        @else
                        {{$item->jenis_bencana}}
                        @endif
                    </td>
                    {{-- <td onclick="window.location='/bencana-detil/{{$item->id}}'">{{$item->site->nama_gd}}</td> --}}
                    @if (count(explode('|',$item->lokasi)) >= 2)
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">
                        @foreach (explode('|', $item->lokasi) as $lok)
                            @php $data = \App\Models\SiteModel::where('id', $lok)->first() @endphp
                            {{$data->nama_gd}}<br>
                        @endforeach       
                    </td>
                    @else 
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">
                        @foreach (explode('|', $item->lokasi) as $lok)
                            @php $data = \App\Models\SiteModel::where('id', $lok)->first() @endphp
                            {{$data->nama_gd}}
                        @endforeach       
                    </td>
                    @endif
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">{{Carbon\Carbon::parse($item->created_at)->isoFormat('DD/MM/Y')}}</td>
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">{{Carbon\Carbon::parse($item->updated_at)->isoFormat('DD/MM/Y')}}</td>
                    @if (Auth::user()->role === 'admin')
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">{{$item->nama_pelapor}}</td>
                    <td style="white-space: normal; text-align: left;">
                        <form action="bencana/status/{{$item->id}}" method="get"> @csrf 
                           <center> <button class="btn btn-sm {{ $item->status == 'Open' ? 'btn-danger' : 'btn-success' }}">{{$item->status}}</button></center>
                        </form>
                    </td>
                    <td style="vertical-align: middle;">
                        <div class="d-flex align-content-center" >
                        <a href="{{url('edit-bencana')}}/{{$item->id}}" hidden>
                            <button id="{{$bencana->firstitem() + $key}}" type="submit" title="Edit Data ">
                            </button>
                        </a>
                        <label style="cursor: pointer;" for="{{$bencana->firstitem() + $key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn-sm align-self-center"></label>
                        <pre> </pre>
                        <form action="{{url('hapus-bencana')}}/{{$item->id}}" method="post" class="align-self-center m-auto">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        <button id="del{{$bencana->firstitem() + $key}}" onclick="return confirm('Yakin nih no Laporan {{$item->no_bencana}} mau di hapus ?')" type="submit" title="Hapus Data" hidden>
                        </button>
                        <label style="cursor: pointer;" for="del{{$bencana->firstitem() + $key}}" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn-sm align-self-center"></label>
                        </form>
                    </div>
                    </td>
                    @endif
                </tr>
                @endforeach
                @endif
            </table>

                </div>
                {{$bencana->onEachSide(1)->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>
@endsection
