
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'SISPAM') }}</title>
        <style type="text/css">
            pre {
                    font-family : system-ui;
                }
            /*table {*/
            /*    page-break-after: always;*/
            /*}*/
                
            .potong {

                text-align: left;
                white-space: pre-line;
            }            
            /*.potong2 {
                white-space: pre-line;        Internet Explorer 5.5+ 
            }*/

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
            <b>{{Carbon\Carbon::parse($detil->updated_at)->isoFormat('dddd, D MMMM Y')}}</b>
        </center>
    </h4>
            </div>
            <br>

    <div style="page-break-before: auto;">
                    <table class="table table-responsive" width="100%" style="page-break-before: auto;">
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
                            &nbsp;@if (count(explode('|',$detil->lokasi)) >= 2)
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
                    <tr>
                        <td colspan="3"><b>Uraian Kejadian</b><br/><pre class="mb-0 potong">{{$detil->kejadian_bencana}}</pre>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td colspan="3"><b>Kronologi Kejadian</b><br/><pre class="mb-0 potong">{{$detil->kronologi_bencana}}</pre>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td colspan="3">
                            <b>Upaya Penanganan yang Dilakukan</b><br/><pre  class="mb-0 potong">{{$detil->penanganan}}</pre>
                        </td>
                    </tr>
                    </table>
            </div>

<div style="page-break-before: auto;">
<table width="100%" border="0" style="vertical-align: middle; text-align: center; ">
                        <tr>
                            <td width="30%"><pre class="narrow">
Mengetahui,
{{$otor->jabatan}}



<b>{{$otor->nama}}</b>
NIP. {{$otor->nip}}</pre>
                        </td>
<td width="33%" style="vertical-align: top;">Jakarta, {{Carbon\Carbon::parse($detil->updated_at)->isoFormat('D MMMM Y')}}</td>
                        <td width="33%" style="vertical-align: top;"><pre class="narrow">
Disusun Oleh,




<b>{{$detil->nama_pelapor}}</b>
{{$detil->satker}}</pre>
                        </td>
                        </tr>
</table>
</div>
<div style="page-break-before: auto; margin-top: 100px;">
    <center>
    <b>Dokumentasi : </b> <br/>
    <br/><br/><br/>
    @if ($detil->foto != null)
    @foreach(explode('|',$detil->foto) as $item)
    <img  src="{{ public_path('storage/bencana')}}/{{$detil->no_bencana}}/{{$item}}" style="height:250px;  margin-bottom: 5pt">  &nbsp;
    @endforeach
    @else 
    Harap Upload Foto Dokumentasi
    @endif

    </center>
</div>

<div style="position: absolute; right: 0; bottom: 0px;" align="center">
    <img src="data:image/png;base64, {!! $qrcode !!}">
    <figcaption><font size="8pt" style="margin-top: 20px">{{$detil->no_bencana}}</font></figcaption>
</div>

</body> 
    </html>

