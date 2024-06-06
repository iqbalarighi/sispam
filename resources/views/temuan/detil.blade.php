@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Detail Laporan Temuan Patroli') }}
    @if($detil->pelapor == Auth::user()->name || Auth::user()->role == "admin")
                        <a href="{{url('temuan-edit')}}/{{$detil->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Edit Laporan</span></a>
                        <a href="{{route('temuan')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
    @else 
                        <a href="{{ url()->previous() }}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
    @endif
                </div>
                <style>
                .fixed {
                  position: absolute;
                  top: 0;
                  right: 0;
                }
            </style>
<center>
        @if ($message = Session::get('berhasil'))
            <div id="timeout" align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between mx-1 fixed" style="width: 50%; margin: 0 auto;" role="alert">
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
        <div id="timeout" align="center" class="alert alert-warning alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between mx-1 fixed" style="width: 50%; margin: 0 auto;" role="alert">
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
    </center>
                <div class="card-body overflow " style="overflow-x: auto;">
                    <style>
                        pre {
                            font-family : system-ui;
                            font-size: 12pt;
                            word-break: break-word;
                            white-space: pre-wrap;       /* Since CSS 2.1 */
                            white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
                            white-space: -pre-wrap;      /* Opera 4-6 */
                            white-space: -o-pre-wrap;    /* Opera 7 */
                            word-wrap: break-word;       /* Internet Explorer 5.5+ */
                        }
                        .xx {
                            font-size: 10pt;
                            text-align: center;
                        }
                        table, tr, td {
                        /*  padding:0rem !important;*/
                            vertical-align: middle;
                            word-wrap: break-word;
                        }
                        .table ,th {
                            padding:0rem;
                            white-space:nowrap;
                            background-color: seashell;
                        }
                        label {
                            margin: 0em;
                        }

                    </style>

                    <div class="table-responsive">
                        <div class="pb-3">
                            <b><center>Laporan Temuan Patroli</center></b>
                            <b><center>Unit {{$detil->site->nama_gd}}</center></b>
                            <b><center>{{Carbon\Carbon::parse($detil->created_at)->isoFormat('dddd, D MMMM Y')}} {{Carbon\Carbon::parse($detil->created_at)->isoFormat('HH:mm')}} WIB</center></b>
                        </div>
                    <center>
                    <table class="" width="85%">
                    <tr>
                        <td><b>No. Laporan</b></td><td> : </td><td>&nbsp;{{$detil->no_lap}}</td>
                    </tr>
                    <tr>
                        <td><b>Lokasi Kejadian</b></td><td> : </td><td>&nbsp;{{$detil->site->nama_gd}}</td>
                    </tr>
                    <tr>
                        <td><b>Waktu Kejadian</b></td><td> : </td><td>&nbsp;{{Carbon\Carbon::parse($detil->tanggal)->isoFormat('dddd, D MMMM Y')}}</td>
                    </tr>
                    <tr>
                        <td><b>Jam kejadian</b></td><td> : </td><td>&nbsp;{{$detil->jam}} WIB</td>
                    </tr>
                    <tr>
                        <td class="p-2"></td> 
                    </tr>
                    <tr>
                        <td colspan="3"><b>Jenis Bahaya : </b> <br/><pre class="mb-0">&nbsp;{{$detil->jenis_bahaya}}</pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Potensi Bahaya : </b> <br/><pre class="mb-0">&nbsp;{{$detil->potensi_bahaya}}</pre></td>
                    </tr>
                    <tr>
                        <td class="p-2"></td> 
                    </tr>
                    <tr>
                        <td colspan="3"><b>Pengendalian : </b><br/><pre class="mb-0">&nbsp;{{$detil->pengendalian}}</pre></td>
                    </tr>
                    <tr>
                        <td class="p-2"></td> 
                    </tr>
                    <tr>
                        <td align="center" colspan="3"><b>Dokumentasi :</b> <br/> 
                         <div>
                    @if ($detil->foto != null)
                    @foreach(explode('|',$detil->foto) as $item)
                    <img align="center" src="{{asset('storage/temuan')}}/{{$detil->no_lap}}/{{$item}}" style="width:280px; margin-bottom: 5pt">&nbsp;
                    @endforeach
                        </div>
                        @else 
                        <b>Harap Upload Foto Dokumentasi</b>
                        @endif
                    </td>
                    </tr>
                    </table>
                </center>
                    </div>
                </div>
                @if($detil->user_pelapor == Auth::user()->name || Auth::user()->role == "admin" || Auth::user()->name == $detil->pelapor)
                        <div class="form-group">
                             <div align="center" class="control">
                                  <a href="/temuanPDF/{{$detil->id}}" target="_blank"><span class="btn btn-primary btn-sm ml-2">Download Laporan</span></a>
                             </div>
                        </div>

                @endif
            </div>
        </div>
    </div>
</div>

@endsection
