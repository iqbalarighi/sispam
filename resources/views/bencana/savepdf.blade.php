
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'SISPAM') }}</title>
        <style type="text/css">
            pre {
                font-family : Calibri;
            }
            /*table {*/
            /*    page-break-after: always;*/
            /*}*/
                
            .potong {
                white-space: pre-line;       /* Internet Explorer 5.5+ */
                text-align: justify;
            }            
            .potong2 {
                white-space: pre-line;       /* Internet Explorer 5.5+ */
            }

            .narrow {
                      padding: 0px;
                      width: 200px;
                      margin: 0 auto;
                      font-size: 12pt;
                      font-family : system-ui;
                    }
        </style>
    </head>
<body>

<!-- form input Site -->

            <div>
<img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 20px; width: 150px; position: fixed;">
    <h4>
        <center> 
            <b>Laporan Kegawatdaruratan {{ 'Man-made Hazard : ' == Str::substr($detil->jenis_bencana, 0,18) ? Str::substr($detil->jenis_bencana, 18,1000) : $detil->jenis_bencana }}</b><br>
            <b>{{$detil->site->nama_gd}}</b><br>
            <b>{{Carbon\Carbon::parse($detil->updated_at)->isoFormat('dddd, D MMMM Y')}}</b>
        </center>
    </h4>
            </div>
            <br>
                    <table class="table table-responsive" width="100%">
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
                        <td><b>Lokasi</b></td>
                        <td>:</td>
                        <td>
                            &nbsp;{{$detil->site->nama_gd}}
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Jenis Kegawatdaruratan</b></td>
                        <td>:</td>
                        <td>
                            &nbsp;{{ 'Man-made Hazard : ' == Str::substr($detil->jenis_bencana, 0,18) ? Str::substr($detil->jenis_bencana, 18,1000) : $detil->jenis_bencana }}
                        </td> 
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td colspan="3"><b>Uraian Kejadian</b><br/><pre class="mb-0 potong">{{$detil->kejadian_bencana}}</pre>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td colspan="3"><b>Kronologi Kejadian</b><br/><pre class="mb-0 potong2">{{$detil->kronologi_bencana}}</pre>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td colspan="3">
                            <b>Upaya Penanganan yang Dilakukan</b><br/><pre  class="mb-0 potong">{{$detil->penanganan}}</pre>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                        <tr>
                        <td align="center" colspan="3"><b>Dokumentasi : </b> <br/>
                             <br/><br/><br/>
                            @if ($detil->foto != null)
                    @foreach(explode('|',$detil->foto) as $item)

                    <img  src="{{ public_path('storage/bencana')}}/{{$detil->no_bencana}}/{{$item}}" style="height:250px;  margin-bottom: 5pt">  &nbsp;
                    @endforeach
                        @else 
                        Harap Upload Foto Dokumentasi
                        @endif

                        </td>
                    </tr>
                    </table>

<table width="100%" border="0" style="vertical-align: middle; text-align: center;">
                        <tr>
                            <td width="30%"><pre class="narrow">
Mengetahui,
Kepala Bagian Pengamanan



<b>Supriyono</b>
NIP. 00704</pre>
                        </td>
<td width="33%" style="vertical-align: top;">Jakarta, {{Carbon\Carbon::parse($detil->updated_at)->isoFormat('D MMMM Y')}}</td>
                        <td width="33%" style="vertical-align: top;"><pre class="narrow">
Disusun Oleh,




<b>{{$detil->nama_pelapor}}</b>
{{$detil->satker}}</pre>
                        </td>
                        </tr>
</table>

</body>
    </html>

