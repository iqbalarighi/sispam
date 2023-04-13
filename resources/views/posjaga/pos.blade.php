@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Pos Jaga') }}
                    <a href="{{route('tambah-pos')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
                </div>

                <div class="card-body overflow " style="overflow-x: auto;">
        @if ($message = Session::get('berhasil'))
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
                    <table class="table table-striped table-hover text-center ">
                    <tr class="font-weight-normal xx ">
                        <th scope="col" class="align-middle" style="max-width:50px; min-width:30px;">#ID</th>
                        <th scope="col" class="align-middle">Id Jaga</th>
                        <th scope="col" class="align-middle">Pos Jaga</th>
                        <th scope="col" class="align-middle">Gedung</th>
                        <th scope="col" class="align-middle">Area Jaga</th>
                        <th scope="col" class="align-middle">Kategori Ring</th>
                        <th scope="col" class="align-middle">Personil Jaga</th>
                        <th scope="col" class="align-middle">Standar Peralatan</th>
                        <th scope="col" class="align-middle">Foto</th>
                       <th class="align-middle" style="width:72px; ">Option</th>

                    </tr>
                    <style>
                         a {color:black;}
                        a:hover { color:rgb(0, 138, 0);}
                        label:hover { color:rgb(0, 138, 0);}
                    </style>
                    @foreach($pos as $key => $p) 
                    <tr >
                        <td >{{$pos->firstitem() + $key}}</td>
                        <td>{{$p->id_jaga}}</td> 
                        <td>{{$p->pos_jaga}}</td>
                        <td>{{$p->site->nama_gd}}</td>
                        <td>{{$p->area_jaga}}</td>
                        <td>{{$p->kategori_ring}}</td>
                        <td>{{$p->personil_jaga}}</td>
                        <td>{{$p->standar_peralatan}}</td>
                        <td>
                            <!-- Button to launch a modal -->
                    <span
                        data-toggle="modal"
                        data-target="#bpjs"
                        style="cursor: zoom-in;">
                        <font color="blue">{{$p->foto}}</font>
                    </span>
                  
                    <!-- Modal -->
                    <div class="modal fade"
                        id="bpjs"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    <a href="{{asset('storage/posjaga')}}/{{$p->id_jaga}}/{{$p->foto}}" download="" >
                                    <img src="{{asset('storage/posjaga')}}/{{$p->id_jaga}}/{{$p->foto}}"
                                        alt="Click on button"
                                        width="350px" /></a>
                                       <br/> Klik Gambar Untuk Download
                                </div>
                 
                                <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-secondary"
                                        data-dismiss="modal">
                                        Close
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                        </td>
                        <td class="d-flex align-items-md-center" >
                        <a href="{{route('edit-pos')}}/{{$p->id}}" hidden>
                            <button id="{{$pos->firstitem() + $key}}" type="submit" title="Edit Data {{$p->name}}">
                            </button>
                        </a>
                        <label for="{{$pos->firstitem() + $key}}" class="bi bi-pencil-fill bg-warning btn-sm align-self-center"></label>
                            &nbsp;
                        <form action="#" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button id="del{{$pos->firstitem() + $key}}" onclick="return confirm('Yakin nih datanya mau di hapus ?')" type="submit" title="Hapus Data {{$p->name}}" hidden>
                                </button>
                                <label for="del{{$pos->firstitem() + $key}}" class="bi bi-trash-fill bg-danger btn-sm align-self-center"></label>
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
@endsection
