@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Detail Laporan') }}
 

                        <a href="{{url('edit-giat')}}/{{$detil->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Edit Laporan</span>
                        </a><a href="{{route('kegiatan')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>


                </div>

                <div class="card-body overflow " style="overflow-x: auto;">
                    @if (session('status'))
                        <div id="timeout" class="alert alert-success" role="alert">
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

                        pre {
                                white-space: pre-wrap;       /* Since CSS 2.1 */
                                white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
                                white-space: -pre-wrap;      /* Opera 4-6 */
                                white-space: -o-pre-wrap;    /* Opera 7 */
                                word-wrap: break-word;       /* Internet Explorer 5.5+ */
                            }
                    </style>

                    <div class="row justify-content-md-center">
                    
                    <div class="col-md-auto p-auto">
                    <table class="table table-responsive" width="100%">
                    <tr>
                        <td>
                        <b><center>Laporan Kegiatan Petugas Pengamanan</center></b>
                        <b><center>{{$detil->site->nama_gd}}</center></b>
                        <b><center>{{Carbon\Carbon::parse($detil->tanggal)->isoFormat('dddd, D MMMM Y')}}</center></b>
                        <b><center>Pukul {{Carbon\Carbon::parse($detil->created_at)->isoFormat('HH:mm:ss')}} WIB</center></b>
                    </td>
                    </tr>
                    <tr>
                        <td><b>No. laporan: </b>{{$detil->no_lap}} </td> 
                    </tr>
                    <tr>
                        <td colspan="3"><b>Personil Yang Bertugas : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0">{{$detil->personil}}</pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Tim Respon Cepat : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0" >{{$detil->trc}}</pre></td>
                    </tr>
                    <tr>
                        <td><b>Update Giat : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0" style="text-align:justify;text-justify:inter-word;">{{$detil->giat}}</pre></td>
                    </tr>
                    <tr>
                        <td><b>Keterangan : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0">{{$detil->keterangan}}</pre></td>
                    </tr>
                    <tr>
                        <td align="center" colspan="3"><b>Dokumentasi : </b>
                            <p></p>
                            @if ($detil->foto != null)
                    @foreach(explode('|',$detil->foto) as $item)
                    <img  src="{{asset('storage/kegiatan')}}/{{$detil->no_lap}}/{{$item}}" style="width:280px; margin-bottom: 5pt"> &nbsp;
                    @endforeach
                        @else 
                        Harap Upload Foto Dokumentasi
                        @endif
                        </td>
                    </tr>
                    
                    </table>

                                                <form method="GET" action="/downloadPDF/{{$detil->id}}" enctype="multipart/form-data">
                            <div class="form-group">
                             <div align="center" class="control">
                                 <button type="submit" class="btn btn-primary">Download Laporan</button>
                             </div>
                            </div>
                            </form> 
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection