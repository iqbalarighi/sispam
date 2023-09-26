@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Detail Laporan') }}
    @if($detil->creator == Auth::user()->name || Auth::user()->level == "superadmin")
                        <a href="{{url('edit_smc')}}/{{$detil->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Edit Laporan</span></a>
                        <a href="{{route('laporan_smc')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
    @else
                        <a href="{{ url()->previous() }}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
    @endif

                </div>

                <div class="card-body overflow " style="overflow-x: auto;">
                    @if (session('status'))
                        <div id="timeout" class="alert alert-success" role="alert">
                          <center> {{ session('status') }} </center> 
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
                    <table class=" table-responsive" width="100%">
                    <tr>
                        <td>
                        <b><center>Laporan Kegiatan <i>Security Monitoring Center</i></center></b>
                        <b><center>Otoritas Jasa Keuangan (OJK)</center></b>
                        <b><center>{{$detil->site->nama_gd}}</center></b>
{{--                         <b><center>{{Carbon\Carbon::parse($detil->tanggal)->isoFormat('dddd, D MMMM Y')}}</center></b>
                        <b><center>Pukul {{Carbon\Carbon::parse($detil->created_at)->isoFormat('HH:mm:ss')}} WIB</center></b> --}}
                    </td>
                    </tr>
                    <tr>
                        <td><b>Nomor &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; : </b>{{$detil->no_lap}} </td>
                    </tr>
                    <tr>
                        <td><b>Waktu Tugas &nbsp;: </b>{{$detil->shift}} </td> 
                    </tr>                    
                    <tr>
                        <td><b>Tanggal &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : </b>{{Carbon\Carbon::parse($detil->tanggal)->isoFormat('dddd, D MMMM Y')}} </td> 
                    </tr>
                    <tr>
                        <td colspan="3"><b>Personil Yang Bertugas : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0">{{$detil->petugas}}</pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td><b>Kegiatan : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0" style="text-align:justify;text-justify:inter-word;">{{$detil->giat}}</pre></td>
                    </tr>
                    @if ($detil->keterangan != null)
                    <tr>
                        <td><b>Keterangan : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0">{{$detil->keterangan}}</pre></td>
                    </tr>
                    @endif
                    <tr>
                        <td align="center" colspan="3">
                            @if ($detil->foto != null)
                            
                            <b>Dokumentasi : </b>
                            <p></p>

                    @foreach(explode('|',$detil->foto) as $item)
                    <img  src="{{asset('storage/smc')}}/{{$detil->no_lap}}/{{$item}}" style="width:280px; margin-bottom: 5pt"> &nbsp;
                    @endforeach
                        
                        @endif
                        </td>
                    </tr>
                    
                    </table>
                    
                </div>
                @if($detil->creator == Auth::user()->name || Auth::user()->level == "superadmin")
                <center><a href="/smcPDF/{{$detil->id}}" target="_blank"><span class="btn btn-primary btn-sm ml-2">Download Laporan</span></a></center>
                @endif
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection