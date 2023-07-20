@extends('layouts.side')

@section('content')
{{-- @if (Auth::user()->role === 'user')
    <meta content="0; url={{ route('kegiatan') }}" http-equiv="refresh">
@endif --}}
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Pos Jaga') }}
                    <a href="{{route('tambah-pos')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
                </div>

                
        @if ($message = Session::get('berhasil'))
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
                            white-space:normal;
                        }
                        label {
                            margin: 0em;
                        }
                    </style>

                    <div class="card-body overflow " style="overflow-x: auto;">
                    <div class="table-responsive">
                    <table class="table table-striped table-hover text-center ">
                    <tr class="font-weight-normal xx ">
                        <th scope="col" class="align-middle" style="max-width:50px; min-width:30px;">No.</th>
                        <th scope="col" class="align-middle">Id Jaga</th>
                        <th scope="col" class="align-middle">Gedung</th>
                        <th scope="col" class="align-middle">Pos Jaga</th>
                        <th scope="col" class="align-middle">Area Jaga</th>
                        <th scope="col" class="align-middle">Kategori Ring</th>
                        <th scope="col" class="align-middle">Kekuatan Personil</th>
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
                        <td style="text-align: left; white-space: normal;">{{$p->site->nama_gd}}</td>
                        <td style="text-align: left;">{{$p->pos_jaga}}</td>
                        <td style="text-align: left; ">{{$p->area_jaga}}</td>
                        <td style="text-align: left;">{{$p->kategori_ring}}</td>
                        <td style="text-align: left;">{{$p->personil_jaga}}</td>
                        <td style="text-align: left; white-space: normal;">{{$p->standar_peralatan}}</td>
                        <td> 
                            @if ($p->foto == null)
                            @else
                            <!-- Button to launch a modal -->
                            @foreach (explode('|', $p->foto) as $key => $item)
                    <span
                        data-toggle="modal"
                        data-target="#jaga{{$p->id.$key}}"
                        style="cursor: zoom-in;">
                        <font color="blue">
  
                            
                        <i class="bi bi-images pl-1 pr-1" style="font-size: 14pt;"></i>
                           
                        </font>
                    </span>
                  
                    <!-- Modal -->
                    <div class="modal fade"
                        id="jaga{{$p->id.$key}}"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    <a href="{{asset('storage/posjaga')}}/{{$p->id_jaga}}/{{$item}}" download="" >
                                    <img src="{{asset('storage/posjaga')}}/{{$p->id_jaga}}/{{$item}}"
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
                     @endforeach
                     @endif
                        </td>
                        <td>
                        <div class="d-flex align-items-md-center" >
                        <a href="{{route('edit-pos')}}/{{$p->id}}" hidden>
                            <button id="{{$p->id}}" type="submit" title="Edit Data {{$p->name}}">
                            </button>
                        </a>
                        <label for="{{$p->id}}" class="bi bi-pencil-fill bg-warning btn-sm align-self-center"></label>
                            &nbsp;
                        <form action="{{url('/hapus-pos/'.$p->id)}}" method="get">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button id="del{{$p->id}}" onclick="return confirm('Yakin nih datanya mau di hapus ?')" type="submit" title="Hapus Data {{$p->name}}" hidden>
                                </button>
                                <label for="del{{$p->id}}" class="bi bi-trash-fill bg-danger btn-sm align-self-center"></label>
                        </form>
                    </div>
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

{{-- lanjut edit hapus foto --}} 