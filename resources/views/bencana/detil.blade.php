@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Laporan Kegawatdaruratan') }}
                    {{-- <a href="{{url('/giat-detil')}}/{{$edit->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a> --}}
    @if($detil->user_pelapor == Auth::user()->name || Auth::user()->role == "admin")
                        <a href="{{url('edit-bencana')}}/{{$detil->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Edit Laporan</span></a>
                        <a href="{{route('bencana')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
    @else 
                        <a href="{{ url()->previous() }}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
    @endif

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
                            text-align:justify !important;
                        }
                        .xx {
                            font-size: 10pt;
                            text-align: center;
                        }
                        table tr td {
                        /*  padding:0rem !important;*/
                            vertical-align: middle;
                            white-space:normal;
/*                            border: 1px solid black;*/
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
                        <script>
                    Swal.fire({
                      title: "Berhasil",
                      text:  "{{ $message }}",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 1000
                    });
            </script>
        @elseif ($message = Session::get('warning'))
        <script>
                    Swal.fire({
                      title: "Berhasil",
                      text:  "{{ $message }}",
                      icon: "warning",
                      showConfirmButton: false,
                      timer: 1000
                    });
            </script>
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
                        <div class="pb-3">
                    <b><center> 
                Laporan Kegawatdaruratan {{ 'Man-made Hazard : ' == Str::substr($detil->jenis_bencana, 0,18) ? Str::substr($detil->jenis_bencana, 18,1000) : $detil->jenis_bencana }}
                    </center></b>
                            <b><center>
                    @if (count(explode('|',$detil->lokasi)) >= 2)
                        @foreach (explode('|', $detil->lokasi) as $lok)
                            @php $data = \App\Models\SiteModel::where('id', $lok)->first() @endphp
                            {{$data->nama_gd}}<br>
                        @endforeach       

                    @else 

                        @foreach (explode('|', $detil->lokasi) as $lok)
                            @php $data = \App\Models\SiteModel::where('id', $lok)->first() @endphp
                            {{$data->nama_gd}}
                        @endforeach       

                    @endif
                            </center></b>
                            <b><center>{{Carbon\Carbon::parse($detil->updated_at)->isoFormat('dddd, D MMMM Y')}}</center></b>
                        </div>
                    <table class="" width="80%" style="">
                    <tr>
                        <td width="25%"><b>Nomor Laporan</b></td>
                        <td width="1%">:</td>
                        <td>
                            &nbsp;{{$detil->no_bencana}}
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Tanggal Kejadian</b></td>
                        <td>:</td>
                        <td>
                            &nbsp;{{Carbon\Carbon::parse($detil->tanggal)->isoFormat('dddd, D MMMM Y')}}
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Lokasi Terdampak</b></td>
                        <td>:</td>
                        <td>
                            
                            @if (count(explode('|',$detil->lokasi)) >= 2)
                        @foreach (explode('|', $detil->lokasi) as $lok)
                            @php $data = \App\Models\SiteModel::where('id', $lok)->first() @endphp
                             &nbsp;{{$data->nama_gd}}<br>
                        @endforeach       

                    @else 

                        @foreach (explode('|', $detil->lokasi) as $lok)
                            @php $data = \App\Models\SiteModel::where('id', $lok)->first() @endphp
                            {{$data->nama_gd}}
                        @endforeach       

                    @endif
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Jenis Kejadian</b></td>
                        <td>:</td>
                        <td>
                            &nbsp;{{ 'Man-made Hazard : ' == Str::substr($detil->jenis_bencana, 0,18) ? Str::substr($detil->jenis_bencana, 18,1000) : $detil->jenis_bencana }}
                        </td> 
                    </tr>
                    <tr><td>&nbsp;</td></tr>
{{--                     <tr>
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
                    </tr> --}}
                    <tr>
                        <td colspan="3"><b>Uraian Kejadian</b><br/><pre class="mb-0">{{$detil->kejadian_bencana}}</pre>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td colspan="3"><b>Kronologi Kejadian</b><br/><pre class="mb-0">{{$detil->kronologi_bencana}}</pre>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td colspan="3">
                            <b>Upaya Penanganan yang Dilakukan</b><br/><pre  class="mb-0">{{$detil->penanganan}}</pre>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td colspan="3" class="m-0"><b>Dokumentasi : </b><br/> 
                         <div align="center">
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

                    @if($detil->danru == Auth::user()->name || Auth::user()->role == "admin")

                    <select id="otorisasi" required>
                        <option value="" selected>::Pilih Otorisasi::</option>
                        @foreach ($otor as $key => $oto)
                        <option value="{{$oto->id}}">{{$oto->nama}}</option>
                        @endforeach
                    </select>

                <a id="link" target="_blank"><button id="unduh" class="btn btn-primary btn-sm float-center ml-2" disabled>Download PDF</button></a>

                    @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
 
    $("#otorisasi").change(function() {
        console.log($("#otorisasi option:selected").val());
        if ($("#otorisasi option:selected").val() == '') {
            $("#unduh").prop("disabled", true);
            $('#link').removeAttr("href");
        } else {
            $('#link').attr("href", "/savePDF/{{$detil->id}}/"+this.value);
            $("#unduh").prop("disabled", false); 
        }

});
</script>

@endsection