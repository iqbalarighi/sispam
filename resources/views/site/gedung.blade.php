@extends('layouts.side')

@section('content')
@if (Auth::user()->role === 'user')
    <meta content="0; url={{ route('kegiatan') }}" http-equiv="refresh">
@endif
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
                <div class="card-header text-uppercase font-weight-bold">{{ __('Site') }}
                    <a href="{{route('tambah-site')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
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
                    <div class="mt-1">
                    {{$site->onEachSide(1)->links('pagination::bootstrap-5')}}
                    </div>
                    <div class="card-body overflow pt-0 pb-0" style="overflow-x: auto;">

                    <table class="table table-bordered table-striped table-hover text-center ">
                    <tr class="font-weight-normal xx ">
                        <th style="max-width:50px; min-width:30px;">No</th>
                        <th>Kode</th>
                        <th>Nama Gedung</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                       <th style="width:72px; ">Option</th>
                    </tr>

                    @foreach($site as $key => $sites) 
                    <tr >
                        <td>{{$site->firstitem() + $key}}</td>
                        <td>{{$sites->kode}}</td> 
                        <td align="left">{{$sites->nama_gd}}</td>
                        <td align="left">{{$sites->alamat_gd}}</td>
                        <td>{{$sites->nopon}}</td>
                        <td class="d-flex align-content-center"> 
                            <a href="{{route('edit-site')}}/{{$sites->id}}" hidden>
                                <button id="dit{{$site->firstitem() + $key}}" type="submit" title="Edit Data ">
                                </button>
                            </a>
                            <label for="dit{{$site->firstitem() + $key}}" class="bi bi-pencil-fill bg-warning btn-sm align-self-center"></label>
                                &nbsp;
                            <form action="hapus-site/{{$sites->id}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button id="del{{$site->firstitem() + $key}}" onclick="return confirm('Yakin nih {{$sites->nama_gd}} mau di hapus ?')" type="submit" title="Hapus Data " hidden>
                                    </button>
                                    <label for="del{{$site->firstitem() + $key}}" class="bi bi-trash-fill bg-danger btn-sm align-self-center"></label>
                            </form>
                            </td>
                    </tr>
                    @endforeach
                    </table>
                </div>
                {{$site->onEachSide(1)->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>
@endsection
