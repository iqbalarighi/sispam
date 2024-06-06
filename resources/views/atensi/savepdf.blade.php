<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'SISPAM') }}</title>
        <style type="text/css">
            pre {
                font-family: "Times New Roman";
            }
            table {
               page-break-inside: auto;
            }
                
            .potong {
                white-space: pre-wrap;      /* Internet Explorer 5.5+ */
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
                <div>
                    <img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 20px; width: 150px; position: relative;">
                    <h4>
                        <b><center>LAPORAN ATENSI PIMPINAN</center></b>
                    </h4>
                </div>
                    <table class="" width="100%">
                    <tr>
                        <td style="vertical-align: top; padding-top: 17px;"><b>Yth :</b></td>
                        <td style="vertical-align: top !important;"><pre class="">{{$detil->yth}}</pre></td>
                    </tr>

                    </table>
                    <pre class="mb-0 potong"><b>A. RENCANA KEGIATAN</b><br> &nbsp;&nbsp;&nbsp;&nbsp;{{$detil->rencana}}</pre>

                    <table class="" width="100%" style="margin-left: -4px;">
                    <tr>
                        <td colspan="3"><b>B. URAIAN RENCANA KEGIATAN</b></td>
                    </tr>
                    <tr>
                        <td width="15px" valign="top"></td>
                        <td width="10px" valign="top">1.</td>
                        <td style="vertical-align: top !important;"> <pre style="margin-top: 0px; margin-bottom: 0px; text-align:justify; " class="potong">{{$detil->uraian}}</pre></td>
                    </tr>
                    <tr>
                        <td width="15px" valign="top"></td>
                        <td colspan="2"><pre class="potong" style="margin-top: -4px;">2. Kegiatan unjuk rasa tersebut berpotensi mengganggu operasional OJK.
3. Dalam rangka pengamanan kegiatan, kami akan melakukan langkah-langkah sebagai berikut:
   a. Meningkatkan pengamanan perimeter gedung;
   b. Memperketat akses masuk-keluar area gedung;
   c. Melakukan koordinasi dengan pihak kepolisian;
   d. Melakukan koordinasi dengan satuan kerja terkait untuk persiapan audiensi kepada peserta aksi 
       (apabila diperlukan);
   e. Melakukan pengamanan unjuk rasa sesuai SOP;
   f. Melakukan pemantauan jalannya aksi</pre></td>
                    </tr>
                    </table>
                    <pre class="mb-0 potong" style="margin-top: 0px"><b>C. PENUTUP </b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian laporan yang dapat kami sampaikan. Atas perhatian Bapak, kami ucapkan terima kasih.</pre>
<p></p>
<table border="0" width="100%" style="vertical-align: middle; text-align: center;">
                        <tr>
                            <td width="30%"><pre class="narrow" style="margin: 0;">
</pre>
                        </td>
<td width="33%" style="vertical-align: top;"></td>
                        <td width="33%" style="vertical-align: top;"><pre class="narrow" style="margin: 0; text-align: left;">
Dibuat di Jakarta, 
Pada tanggal {{Carbon\Carbon::parse($detil->created_at)->isoFormat('D MMMM Y')}}
{{$otor->jabatan}}

Ttd.

<b><u>{{$otor->nama}}</u></b>
NIP. {{$otor->nip}}</pre>
                        </td>
                        </tr>
</table>

<div style="position: absolute; right: 0; bottom: 0px;" align="center">
    <img src="data:image/png;base64, {!! $qrcode !!}">
    <figcaption><font size="8pt" style="margin-top: 20px">Laporan Atensi</font></figcaption>
</div>

</body>
    </html>