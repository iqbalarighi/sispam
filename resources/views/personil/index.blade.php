@extends('layouts.side')

@section('content')
@if ( Auth::user()->role === 'admin')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Personil') }}
                    <a href="{{route('tambah-personil')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
                </div>

                
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
                <form action="" method="GET" class="m-1 pl-3">
                    <input type="cari" name="cari" placeholder="Cari" autocomplete="off"> <button class="submit bi bi-search"></button>
                </form>
                    <div class="card-body overflow " style="overflow-x: auto;">

                    <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm text-center ">
                    <tr class="font-weight-normal xx ">
                        <th scope="col" class="align-middle" style="max-width:50px; min-width:30px;">#ID</th>
                        <th scope="col" class="align-middle">NIP</th>
                        <th scope="col" class="align-middle">Nama</th>
                        <th scope="col" class="align-middle">Jabatan</th>
                        <th scope="col" class="align-middle">Jenis Kelamin</th>
                        <th scope="col" class="align-middle">Pendidikan</th>
                       <th class="align-middle" style="width:72px; ">Option</th>

                    </tr>
                    <style>
                         a {color:black;}
                        a:hover { color:rgb(0, 138, 0);}
                        label:hover { color:rgb(0, 138, 0);}
                    </style>
                    @foreach($personil as $key => $s) 
                    <tr style="cursor: pointer;">
                        <td onclick="window.location='{{route('personil')}}/{{$s->id}}'">{{$personil->firstitem() + $key}}</td>
                        <td onclick="window.location='{{route('personil')}}/{{$s->id}}'">{{$s->nip}}</td> 
                        <td onclick="window.location='{{route('personil')}}/{{$s->id}}'" align="left">{{$s->nama}}</td>
                        <td onclick="window.location='{{route('personil')}}/{{$s->id}}'">{{$s->jabatan}}</td>
                        <td onclick="window.location='{{route('personil')}}/{{$s->id}}'">{{$s->gender}}</td>
                        <td onclick="window.location='{{route('personil')}}/{{$s->id}}'">{{$s->pendidikan}}</td>
                        <td class="d-flex align-items-md-center" >
                        <a href="{{route('edit-personil')}}/{{$s->id}}" hidden>
                            <button id="{{$personil->firstitem() + $key}}" type="submit" title="Edit Data {{$s->name}}">
                            </button>
                        </a>
                        <label for="{{$personil->firstitem() + $key}}" class="bi bi-pencil-fill bg-warning btn-sm align-self-center">

                        </label>
                            &nbsp;
                        <form action="hapus-personil/{{ $s->id }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button id="del{{$personil->firstitem() + $key}}" onclick="return confirm('Yakin nih datanya mau di hapus ?')" type="submit" title="Hapus Data {{$s->name}}" hidden>
                                </button>
                                <label for="del{{$personil->firstitem() + $key}}" class="bi bi-trash-fill bg-danger btn-sm align-self-center">

                                </label>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                    </table>
                    </div>
                    {{$personil->onEachSide(1)->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
</div>
@elseif (Auth::user()->role === 'user')
    {{-- <meta content="0; url={{ route('kegiatan') }}" http-equiv="refresh"> --}}
        {{abort(404)}}
@endif
@endsection
