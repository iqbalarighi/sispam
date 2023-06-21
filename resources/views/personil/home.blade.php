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

                <div class="card-body overflow " style="overflow-x: auto;">
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
                    <tr >
                        <td >{{$personil->firstitem() + $key}}</td>
                        <td>{{$s->nip}}</td> 
                        <td align="left"><a href="{{route('personil')}}/{{$s->id}}" style="text-decoration:none;" >{{$s->nama}}</a></td>
                        <td>{{$s->jabatan}}</td>
                        <td>{{$s->gender}}</td>
                        <td>{{$s->pendidikan}}</td>
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
                </div>
            </div>
        </div>
    </div>
</div>
@elseif (Auth::user()->role === 'user')
    <meta content="0; url={{ route('kegiatan') }}" http-equiv="refresh">
@endif
@endsection
