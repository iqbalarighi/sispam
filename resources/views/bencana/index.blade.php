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
                            white-space:nowrap;
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
                <div class="card-header text-uppercase font-weight-bold">{{ __('Laporan Kebencanaan') }}
                    <a href="{{route('tambah-bencana')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
                </div>
                <div class="card-body p-1 overflow" >
{{-- Content disini --}}

            <table class="table table-striped table-hover table-sm text-center mt-3">
                <tr>
                    <th>No.</th>
                    <th>Nomor Laporan</th>
                    <th>Tanggal Kejadian</th>
                    <th>Jenis Bencana</th>
                    <th>Lokasi</th>
                    @if (Auth::user()->role === 'admin')
                        <th>Nama Pelapor</th>
                        <th>Option</th>
                    @endif
                    
                </tr>
                @foreach ($bencana as $key => $item)
                <tr style="cursor:pointer;">
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">{{$bencana->firstItem() + $key}}</td>
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">{{$item->no_bencana}}</td>
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">{{Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y')}}</td>
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">
                        @if ('Man-made Hazard : ' == Str::substr($item->jenis_bencana, 0,18))
                        {{Str::substr($item->jenis_bencana, 18,1000)}}
                        @else
                        {{$item->jenis_bencana}}
                        @endif
                    </td>
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">{{$item->site->nama_gd}}</td>
                    @if (Auth::user()->role === 'admin')
                    <td onclick="window.location='/bencana-detil/{{$item->id}}'">{{$item->nama_pelapor}}</td>
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
            </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
