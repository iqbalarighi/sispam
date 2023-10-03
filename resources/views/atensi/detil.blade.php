@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Detail Laporan') }}
    @if($show->creator == Auth::user()->name || Auth::user()->level == "superadmin")
                        <a href="{{url('edit_atensi')}}/{{$show->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Edit Laporan</span></a>
                        <a href="{{route('atensi')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
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
                            font-family : 'Times new Roman';
                            font-size: 11pt;
                            word-break: break-word;
                            white-space: pre-wrap;       /* Since CSS 2.1 */
                            white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
                            white-space: -pre-wrap;      /* Opera 4-6 */
                            white-space: -o-pre-wrap;    /* Opera 7 */
                            word-wrap: break-word;       /* Internet Explorer 5.5+ */
                            text-align:justify !important;
                            }

                    </style>

                    <div class="row justify-content-md-center">
                    
                    <div class="col-md-auto p-auto">
                    <table class=" table-responsive" width="100%">
                    <tr>
                        <td>
                        <b><center>Laporan Atensi Pimpinan</center></b>
                        {{-- <b><center>Otoritas Jasa Keuangan (OJK)</center></b> --}}

{{--                         <b><center>{{Carbon\Carbon::parse($show->tanggal)->isoFormat('dddd, D MMMM Y')}}</center></b>
                        <b><center>Pukul {{Carbon\Carbon::parse($show->created_at)->isoFormat('HH:mm:ss')}} WIB</center></b> --}}
                    </td>
                    </tr>
                  
                    <tr>
                        <td colspan="3"><b>Yth : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0">{{$show->yth}}</pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Rencana Kegiatan : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0">{{$show->rencana}}</pre></td>
                    </tr>
                    <tr>
                        <td><b>Uraian Rencana Kegiatan : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0" style="text-align:justify; text-justify:inter-word;"><font style="text-align:justify;">1. {{$show->uraian}}</font>
2. Kegiatan unjuk rasa tersebut berpotensi mengganggu operasional OJK.
3. Dalam rangka pengamanan kegiatan, kami akan melakukan langkah-langkah sebagai berikut:
   a. Meningkatkan pengamanan perimeter gedung;
   b. Memperketat akses masuk-keluar area gedung;
   c. Melakukan koordinasi dengan pihak kepolisian;
   d. Melakukan koordinasi dengan satuan kerja terkait untuk persiapan audiensi kepada peserta aksi (apabila diperlukan);
   e. Melakukan pengamanan unjuk rasa sesuai SOP;
   f. Melakukan pemantauan jalannya aksi</pre></td>
                    </tr>
                    <tr>
                        <td><b>Penutup : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0">Demikian laporan yang dapat kami sampaikan. Atas perhatian Bapak, kami ucapkan terima kasih.
</pre></td>
                    </tr>
                    </table>
                    <p></p>
                </div>
                <div align="center">
                @if($show->creator == Auth::user()->name || Auth::user()->level == "superadmin")

                    <select id="otorisasi"  required>
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
</div>
<script>
 
    $("#otorisasi").change(function() {
        console.log($("#otorisasi option:selected").val());
        if ($("#otorisasi option:selected").val() == '') {
            $("#unduh").prop("disabled", true);
            $('#link').removeAttr("href");
        } else {
            $('#link').attr("href", "/atensiPDF/{{$show->id}}/"+this.value);
            $("#unduh").prop("disabled", false); 
        }

});
</script>
@endsection