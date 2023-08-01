@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Edit Laporan Bencana') }}
                    {{-- <a href="{{url('/giat-detil')}}/{{$edit->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a> --}}
                    <a href="{{route('bencana')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

                </div>

                <div class="card-body overflow pl-0 pr-0" >
                        <style>
                            .table tr td {
                            vertical-align: middle;
                            padding:1px !important;    
                            }
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
                        table tr td {
                        /*  padding:0rem !important;*/
                            vertical-align: middle;
                            white-space:normal;
                        }
                        .table th {
                            padding:0rem;
                            white-space:normal;
                            background-color: seashell;
                        }
                        label {
                            margin: 0em;
                        }
                        </style>
                        
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
        @if ($message = Session::get('success'))
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
        @elseif ($message = Session::get('warning'))
        <div align="center" class="alert alert-warning alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
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
    .textarea {
  width: 300px;
  height: 150px;
}
</style>

{{-- ini style buat gambar --}}
<style>
.containerx {
  position: relative;
  width: 50%;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.containerx:hover .image {
  opacity: 0.3;
}

.containerx:hover .middle {
  opacity: 1;
}

.text {
  color: black;
  font-size: 24px;
  padding: auto;
}
</style>
            <!-- form input Site -->
            <div class="table-responsive mt-2" align="center" style="overflow-x: auto;">

                    <table class="" style="width: 70%;">
                    <tr>
                        <td><b>Nomor Laporan</b></td>
                        <td>:</td>
                        <td>
                            &nbsp;{{$detil->no_bencana}}
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Tanggal</b></td>
                        <td>:</td>
                        <td>
                            &nbsp;{{$detil->tanggal}}
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Lokasi</b></td>
                        <td>:</td>
                        <td>
                            &nbsp;{{$detil->site->nama_gd}}
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Jenis Bencana</b></td>
                        <td>:</td>
                        <td>
                            &nbsp;{{$detil->jenis_bencana}}
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Nama Pelapor</b></td>
                        <td>:</td>
                        <td>
                           &nbsp; {{$detil->nama_pelapor}}
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Satuan Kerja</b></td>
                        <td>:</td>
                        <td>
                           &nbsp;{{$detil->satker}}
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Kejadian Bencana</b></td><td> : &nbsp;</td><td width="500px"><pre class="mb-0">{{$detil->kejadian_bencana}}</pre>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Kronologi Kejadian</b></td><td> : &nbsp;</td><td width="500px"><pre class="mb-0">{{$detil->kronologi_bencana}}</pre>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Upaya Penanganan yang Dilakukan</b></td><td><br/> : &nbsp;</td><td width="500px" ><pre  class="mb-0">{{$detil->penanganan}}</pre>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="m-0">Dokumentasi : <br/> 
                         <div>
                    @if ($detil->foto != null)
                    @foreach(explode('|',$detil->foto) as $item)
                    <img align="center" src="{{asset('storage/bencana')}}/{{$detil->no_bencana}}/{{$item}}" style="width:280px; margin-bottom: 5pt">&nbsp;
                    @endforeach
                        </div>
                        @else 
                        <b>Harap Upload Foto Dokumentasi</b>
                        @endif
                    </td>
                    </tr>
                    </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection