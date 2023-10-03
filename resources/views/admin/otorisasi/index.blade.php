@extends('layouts.side')

@section('content')
@if ( Auth::user()->level === 'superadmin')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Otorisasi PDF') }}
                    {{-- <a href="#"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a> --}}
                    <span data-toggle="modal" data-target="#otorisasi" class="btn btn-primary float-right btn-sm">Tambah Data</span>
                </div>

                <div class="card-body overflow " style="overflow-x: auto;">
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
        {{-- Password Error --}}
                @error('password')
            <div id="timeout" class="alert alert-danger flex flex-col md:justify-between" style="width: 80%; margin: 0 auto;">
                <div class="col-md-auto">
                        <div style="float: right;">
                            <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close" align="right"></button>
                        </div>                
                    </div>
                    <strong>{{ $message }}</strong>
            </div>
        @enderror

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
                        .modal {
                        --bs-modal-width: 50% !important;
                        --bs-modal-padding: 0.1rem !important;
                    }
                    </style>
                  
                    <!-- Modal -->
                    <div class="modal fade"
                        id="otorisasi"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    <form action="{{url('simpan_otorisasi')}}" method="POST" id="form" enctype="form-data">
                                @csrf
                                        <h4>Tambah Data Otorisasi</h4>
                                <label>
                                    Nama
                                    <input type="text" class="form-control width-50" autocomplete="off" name="nama" required />
                                </label>
                                <label>
                                    Jabatan
                                    <input type="text" class="form-control width-50" autocomplete="off" name="jabatan" required />
                                </label>
                                <label>
                                    NIP 
                                    <input type="text" onkeypress="return angka(event)" class="form-control width-50" autocomplete="off" name="nip" required />
                                </label>
                                <br>
                                <input type="submit" class="btn btn-primary btn-sm mt-2" value="Submit">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-secondary btn-sm"
                                        data-dismiss="modal">
                                        Close
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end of modal --}}

                    <div class="table-responsive mt-2">
                    <table class="table table-striped table-hover table-sm text-center ">
                    <tr class="font-weight-normal xx ">
                        <th scope="col" class="align-middle" style="max-width:20px; min-width:10px;">No</th>
                        <th scope="col" class="align-middle">NIP</th>
                        <th scope="col" class="align-middle">Nama</th>
                        <th scope="col" class="align-middle">Jabatan</th>
                       <th class="align-middle" style="width:72px">Option</th>

                    </tr>
                    @foreach ($otor as $key => $oto)
                    <tr>
                    <td>{{$otor->firstitem()+$key}}</td>
                    <td>{{$oto->nip}}</td>
                    <td>{{$oto->nama}}</td>
                    <td>{{$oto->jabatan}}</td>
                    <td class="d-flex justify-content-between"> 
                        <label style="vertical-align: middle;"  data-toggle="modal" data-target="#otorisasi{{$otor->firstitem()+$key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn-sm align-self-center">

                        </label>
                <!-- Modal -->
                    <div class="modal fade"
                        id="otorisasi{{$otor->firstitem()+$key}}"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    <form action="{{url('update-otorisasi').'/'.$oto->id}}" method="POST" id="form">
                                @csrf
                                @method('PUT')
                                        <h4>Tambah Data Otorisasi</h4>
                                <label>
                                    Nama
                                    <input type="text" class="form-control width-50"  name="nama"  value="{{$oto->nama}}" />
                                </label>
                                <label>
                                    Jabatan
                                    <input type="text" class="form-control width-50" name="jabatan" value="{{$oto->jabatan}}" />
                                </label>
                                <label>
                                    NIP 
                                    <input type="text" onkeypress="return angka(event)" class="form-control width-50"  name="nip" value="{{$oto->nip}}" />
                                </label>
                                <br>
                                <input type="submit" class="btn btn-primary btn-sm mt-2" value="Update">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-secondary btn-sm"
                                        data-dismiss="modal">
                                        Close
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- end of modal --}}
                &nbsp;
                    <form action="otorisasi/hapus/{{$oto->id}}" method="post" class="align-self-center m-auto">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button id="del{{$otor->firstitem() + $key}}" onclick="return confirm('Yakin nih mau di hapus ?')" type="submit" title="Hapus Data" hidden>
                                </button>
                                <label for="del{{$otor->firstitem() + $key}}" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn-sm align-self-center">
                                </label>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                    </table>
                     
                    </div>
                </div>
                {{$otor->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>
@elseif (Auth::user()->role === 'user' || Auth::user()->role === 'admin' )
    {{-- <meta content="0; url={{ route('dashboard') }}" http-equiv="refresh"> --}}
    {{abort(403)}}
@endif


@endsection
