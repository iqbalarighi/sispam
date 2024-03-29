@extends('layouts.side')

@section('content')
{{-- @if (Auth::user()->role === 'user')
    <meta content="0; url={{ route('kegiatan') }}" http-equiv="refresh">
@endif --}}
<style>
                        .xx {
                            font-size: 11pt;
                            text-align: center;
                        }
                        .table tr td {
                            padding:0.1rem;
                            vertical-align: middle;
                            max-width:100%;
                            white-space: nowrap;
                            font-size: 11pt;
                        }
                        .table th {
                            padding:0.1rem;
                            white-space:nowrap;
                        }
                        label {
                            margin: 0em;
                        }
                    </style>

<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Lot Parkir') }}
                    @if (Auth::user()->role === 'admin')
                    <a href="{{route('tambah-lot')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
                    @endif
                </div>

                
    <!-- Error Handle -->
        @if ($errors->any())
            <div id="timeout" class="alert alert-danger flex flex-col md:justify-between" style="width: 80%; margin: 0 auto;">
                <div class="col-md-auto">
                        <div style="float: right;">
                            <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close" align="right"></button>
                        </div>                
                    </div>
                            @foreach ($errors->all() as $error)
                <div class="row">
                    <div class="col">
                        <div class="card-text" align="center">
                            {{ $error }} 
                        </div>
                    </div>
                </div>
                    @endforeach
            </div>
        @endif

    <!-- Notifikasi -->
        @if ($message = Session::get('status'))
<script>
                    Swal.fire({
                      title: "Berhasil",
                      text:  "{{ $message }}",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 1000
                    });
            </script>
        @endif
                <form action="" method="GET" class="m-1">
                    <input type="cari" name="cari" placeholder="Cari" autocomplete="off"> <button class="submit bi bi-search"></button>
                </form>
                <div class="ml-2 mr-2">
                {{$parkir->onEachSide(1)->links('pagination::bootstrap-5')}}
                </div>
            <div class="card-body overflow pt-0 pb-0" style="overflow-x: auto;">
                    <table class="table table-bordered table-striped table-hover text-center ">
                    <tr class="font-weight-normal xx ">
                        <th class="align-middle" style="max-width:50px; min-width:30px;">No</th>
                        <th class="align-middle">Kode</th>
                        <th class="align-middle">Lantai</th>
                        <th class="align-middle">NIP</th>
                        <th class="align-middle">Nama</th>
                        <th class="align-middle">Jabatan</th>
                        <th class="align-middle">Akses</th>
                        <th class="align-middle">Aktif</th>
                        <th class="align-middle">Keterangan</th>
                        @if (Auth::user()->role === 'admin')
                       <th class="align-middle" style="width:72px; ">Option</th>
                       @endif

                    </tr>
                    <style>
                        a {color:black;}
                       a:hover { color:rgb(0, 138, 0);}
                       label:hover { color:rgb(0, 138, 0);}
                    </style>
                    @foreach($parkir as $key => $park) 
                    <tr>
                        <td>{{$parkir->firstitem() + $key}}</td>
                        <td>{{$park->kode}}</td> 
                        <td style="white-space: normal;">{{$park->lantai}}</td>
                        <td>{{$park->nip}}</td>
                        <td class="text-left" style="white-space: normal;">{{$park->nama}}</td>
                        <td class="text-left" style="white-space: normal;">{{$park->jabatan}}</td>
                        <td>
                            @if ($park->akses == 0)
                            <span class="bi bi-check-square" style="color: green; font-size: 14pt;"></span>
                            @else
                            <span class="bi bi-x-square" style="color: red; font-size: 14pt;"></span>
                            @endif
                        </td>
                        <td>
                            @if ($park->aktif == 0)
                            <span class="bi bi-check-square" style="color: green; font-size: 14pt;"></span>
                            @else
                            <span class="bi bi-x-square" style="color: red; font-size: 14pt;"></span>
                            @endif
                        </td>
                        <td class="text-left">{{$park->keterangan}}</td>
                        @if (Auth::user()->role === 'admin')
                        <td> 
                            <div class="d-flex align-content-center">
                            <a href="/edit-lot/{{$park->id}}" hidden>
                                <button id="dit{{$parkir->firstitem() + $key}}" type="submit" title="Edit Data ">
                                </button>
                            </a>
                            <label for="dit{{$parkir->firstitem() + $key}}" class="bi bi-pencil-fill bg-warning btn-sm align-self-center">

                            </label>
                                &nbsp;
                            <form action="hapus-lot/{{$park->id}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button id="del{{$parkir->firstitem() + $key}}" onclick="return confirm('Yakin nih {{$park->nama_gd}} mau di hapus ?')" type="submit" title="Hapus Data " hidden>
                                    </button>
                                    <label for="del{{$parkir->firstitem() + $key}}" class="bi bi-trash-fill bg-danger btn-sm align-self-center">

                                    </label>
                            </form>
                            </div>
                            </td>
                            @endif
                    </tr>
                    @endforeach
                    
                    </table>
                </div>
                <div class="ml-2 mr-2">
                {{$parkir->onEachSide(1)->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
