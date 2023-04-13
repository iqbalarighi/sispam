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
                <div class="card-header text-uppercase font-weight-bold">{{ __('Tukar Jaga') }}
                    <a href="{{route('tukar-tambah')}}"><span class="btn btn-primary float-right btn-sm">Buat Laporan</span></a>
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

                    <table class="table table-bordered table-striped table-hover text-center ">
                    <tr class="font-weight-normal xx ">
                        <th style="max-width:50px; min-width:30px;">No</th>
                        <th>No. Laporan</th>
                        <th>Hari/Tanggal</th>
                        <th>Jam</th>
                        <th>Lokasi</th>
                        @if (Auth::user()->role === 'admin')
                       <th style="width:72px; ">Option</th>
                       @endif
                    </tr>

                    @foreach ($trjg as $key => $item)
                    <tr style="user-select: none; cursor: pointer;">
                        <td>{{$trjg->firstitem() + $key}}</td>
                        <td  onclick="window.location='trj-detil/{{$item->no_trj}}/{{$item->id}}'" title="klik untuk lihat detail">
                            {{$item->no_trj}}</td>
                        <td onclick="window.location='trj-detil/{{$item->no_trj}}/{{$item->id}}'" title="klik untuk lihat detail">{{Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd, D MMMM Y')}}</td>
                        <td onclick="window.location='trj-detil/{{$item->no_trj}}/{{$item->id}}'" title="klik untuk lihat detail">{{Carbon\Carbon::parse($item->created_at)->isoFormat('HH:mm:ss')}}</td>
                        <td onclick="window.location='trj-detil/{{$item->no_trj}}/{{$item->id}}'" title="klik untuk lihat detail">{{$item->site->nama_gd}}</td>
                         @if (Auth::user()->role === 'admin')
                        <td>
                            <form action="/hapus-jaga/{{ $item->id }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button id="del{{$trjg->firstitem() + $key}}" onclick="return confirm('Yakin nih datanya mau di hapus ?')" type="submit" title="Hapus Data {{$item->no_trj}}" hidden>
                                </button>
                                <label style="cursor: pointer;" for="del{{$trjg->firstitem() + $key}}" class="bi bi-trash-fill bg-danger btn-sm align-self-center" title="Hapus Laporan">

                                </label>
                        </form>
                        </td>
                         @endif
                    </tr>
                    @endforeach
                    </table>
                     {{$trjg->links('pagination::bootstrap-5')}}
                </div>

            </div>
        </div>
    </div>
</div>
{{-- <script type="text/javascript">
    setTimeout(function(){
   window.location.reload(1);
}, 5000);
</script> --}}
@endsection