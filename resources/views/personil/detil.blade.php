@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Detail Personil') }}
                    <a href="{{route('edit-personil')}}/{{$s->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Edit Data</span></a>
                    <a href="{{route('personil')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
                </div>

                <div class="card-body overflow " style="overflow-x: auto;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <style>
                        .xx {
                            font-size: 9pt;
                            text-align: center;
                        }
                        .table tr td {
                            word-wrap: break-word;
                            vertical-align: middle;
                            padding:0.3rem !important;    
                            }
                    </style>

                    <div class="row justify-content-md-center">
                    
                    <div class="col-md-8">
                    <table class="table table-striped table-hover" width="100%">
                    <tr>
                    <td colspan="3" align="center">
                        @if ($s->foto_personil == null)
                        <i class="bi bi-person-circle img-thumbnail" style="font-size: 70px;"></i>

                        @else
                        <img class="img-thumbnail" src="{{asset('storage/personil')}}/{{$s->nip}}/{{$s->foto_personil}}" width="100px"> 

                    @endif
                    </td>
                        
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td>{{$s->nip}}</td> 
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{$s->nama}}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td class="">{{$s->jabatan}}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{$s->gender}}</td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>:</td>
                        <td>{{$s->pendidikan}}</td>
                    </tr>
                    <tr>
                        <td>lokasi Tugas</td>
                        <td>:</td>
                        <td>{{$s->site->nama_gd}}</td>
                    </tr>
                    <tr>
                        <td>Kompetensi Dasar</td>
                        <td>:</td>
                        <td>
                            @if ($s->kd == null)
                            Tidak memiliki KTA
                            @else 
                     <span
                        data-toggle="modal"
                        data-target="#kd"
                        style="cursor: zoom-in;">
                        <font color="blue">{{$s->kd}}</font>
                    </span>
                  
                    <!-- Modal -->
                    <div class="modal fade"
                        id="kd"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    @if ($s->foto_kd == null)
                                    Mohon upload Kartu KTA
                                    @else
                                    <a href="{{asset('storage/personil')}}/{{$s->nip}}/{{$s->foto_kd}}" download="" >
                                    <img src="{{asset('storage/personil')}}/{{$s->nip}}/{{$s->foto_kd}}"
                                        alt="Click on button"
                                        width="350px" /></a>
                                       <br/> Klik Gambar Untuk Download
                                    @endif
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
                            @endif
                    
                        </td>
                    </tr>
                    <tr>
                        <td>No. Handphone</td>
                        <td>:</td>
                        <td>{{$s->no_hp}}</td>
                    </tr>
                    <tr>
                        <td style="max-width:10%">Alamat</td>
                        <td>:</td>
                        <td>{{$s->alamat}}</td>
                    </tr>
                    <tr>
                        <td>Nama Bank</td>
                        <td>:</td>
                        <td>{{$s->bank}}</td>
                    </tr>
                    <tr>
                        <td class="align-middle">No. Rekening</td>
                        <td>:</td>
                        <td>{{$s->norek}}</td>
                        </tr>
                    <tr>
                        <td class="align-middle">BPJS Kesehatan</td>
                        <td>:</td>
                        <td>
                            
                    <!-- Button to launch a modal -->
                    <span
                        data-toggle="modal"
                        data-target="#bpjs"
                        style="cursor: zoom-in;">
                        <font color="blue">{{$s->bpjs_sehat}}</font>
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
                                    @if ($s->foto_bpjss == null)
                                    Mohon upload Kartu BPJS Kesehatan
                                    @else
                                    <a href="{{asset('storage/personil')}}/{{$s->nip}}/{{$s->foto_bpjss}}" download="" >
                                    <img src="{{asset('storage/personil')}}/{{$s->nip}}/{{$s->foto_bpjss}}"
                                        alt="Click on button"
                                        width="350px" /></a>
                                       <br/> Klik Gambar Untuk Download
                                    @endif
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
                    </tr>
                    <tr>
                        <td class="align-middle">BPJS Ketenagakerjaan</td>
                        <td>:</td>
                        <td>
                             
                    <span
                        data-toggle="modal"
                        data-target="#bpjsk"
                        style="cursor: zoom-in;">
                        <font color="blue">{{$s->bpjs_kerja}} </font>
                    </span>
                  
                    <!-- Modal -->
                    <div class="modal fade"
                        id="bpjsk"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    @if ($s->foto_bpjsk == null)
                                    Mohon upload Kartu BPJS Ketenagakerjaan
                                    @else
                                    <a href="{{asset('storage/personil')}}/{{$s->nip}}/{{$s->foto_bpjsk}}" download="" >
                                    <img src="{{asset('storage/personil')}}/{{$s->nip}}/{{$s->foto_bpjsk}}"
                                        alt="Click on button"
                                        width="350px" /></a>
                                       <br/> Klik Gambar Untuk Download
                                    @endif
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
                    </tr>
                    <tr>
                        <td class="align-middle">Lama Bekerja di OJK</td>
                        <td>:</td>
                        <td>{{$s->lama_kerja}} &nbsp; Tahun</td>
                    </tr>
                  <!--  <tr >
                          <td>
                        <a href="/santri/ubah/{{$s->id_santri}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                        <a href="/santri/hapus/{{$s->id_santri}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td> 
                    </tr>-->

                    </table>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection