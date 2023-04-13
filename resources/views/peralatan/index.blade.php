@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Inventaris') }}
                    <a href="{{route('tambah-peralatan')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
                </div>

                <div class="card-body overflow " style="overflow-x: auto;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
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
                        }
                        label {
                            margin: 0em;
                        }
                    </style>
                    <table class="table table-bordered table-hover text-center ">
                    <tr class="font-weight-normal xx ">
                        <th class="align-middle" style="max-width:50px; min-width:30px;">No</th>
                        <th class="align-middle">Alat</th>
                        <th class="align-middle">No. Inventaris</th>
                        <th class="align-middle">Satuan</th>
                        <th class="align-middle">Jumlah</th>
                        <th class="align-middle">Gedung</th>
                        <th class="align-middle">Ruang</th>
                        <th class="align-middle">Milik</th>
                        <th class="align-middle">Kondisi</th>
                        <th class="align-middle">Riwayat Pemeliharaan</th>
                       <th class="align-middle" style="width:72px; ">Option</th>

                    </tr>
                    <style>
                        a {color:black;}
                       a:hover { color:rgb(0, 138, 0);}
                       label:hover { color:rgb(0, 138, 0);}
                    </style>
                    @foreach($alat as $key => $alats) 
                    <tr >
                        <td>{{$alat->firstitem() + $key}}</td>
                        <td>{{$alats->alat}}</td> 
                        <td>{{$alats->no_inventaris}}</td> 
                        <td>{{$alats->satuan}}</a></td>
                        <td>{{$alats->jumlah}}</td>
                        <td>{{$alats->site->nama_gd}}</td>
                        <td>{{$alats->ruang}}</td>
                        <td>{{$alats->milik}}</td>
                        <td>{{$alats->kondisi}}</td>
                        <td>{{$alats->riwayat}}</td>
                        <td class="d-flex align-content-center"> 
                            <a href="{{route('edit-peralatan')}}/{{$alats->id}}" hidden>
                                <button id="dit{{$alat->firstitem() + $key}}" type="submit" title="Edit Data {{$alats->alat}}">
                                </button>
                            </a>
                            <label for="dit{{$alat->firstitem() + $key}}" class="bi bi-pencil-fill bg-warning btn-sm align-self-center">

                            </label>
                                &nbsp;
                            <form action="hapus-alat/{{ $alats->id }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button id="del{{$alat->firstitem() + $key}}" onclick="return confirm('Yakin nih datanya mau di hapus ?')" type="submit" title="Hapus Data {{$alats->alat}}" hidden>
                                    </button>
                                    <label for="del{{$alat->firstitem() + $key}}" class="bi bi-trash-fill bg-danger btn-sm align-self-center">

                                    </label>
                            </form>
                            </td>
                    </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
