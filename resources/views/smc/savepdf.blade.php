<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'SISPAM') }}</title>
        <style type="text/css">
            pre {
                font-family : Calibri;
            }
            table {
               page-break-inside: auto;
            }
                
            .potong {
                white-space: pre-line;       /* Internet Explorer 5.5+ */
            }
        </style>
    </head>
<body>
                <div>
                    <img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 20px; width: 150px; position: fixed;">
                    <h4>
                        <b><center>Laporan Kegiatan <i>Security Monitoring Center</i></center></b>
                        <b><center>Otoritas Jasa Keuangan (OJK)</center></b>
                        <b><center>{{$detil->site->nama_gd}}</center></b>
                    </h4>
                </div>
{{--                 <table class="table table-responsive" width="100%" style="">
                
                    <tr>
                        <td><b>No. laporan: </b>{{$detil->no_lap}} </td> 
                    </tr>
                </table> --}}
                    <span class="table table-responsive " width="100%">
                    <b>Nomor &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : </b>{{$detil->no_lap}}
                    <br/>
                    <b>Waktu Tugas&nbsp;&nbsp;: </b>{{$detil->shift}}
                    <br/>
                    <b>Tanggal &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : </b>{{Carbon\Carbon::parse($detil->tanggal)->isoFormat('D MMMM Y')}} 
                    <pre class="mb-0 potong" style=""><b>Personil Yang Bertugas :<br></b>{{$detil->petugas}}</pre>
                    
                    <pre class="mb-0 potong" style=""><b>Kegiatan :<br></b>{{$detil->giat}}</pre>
                    @if ($detil->keterangan != null)
                    <pre class="mb-0 potong" style=""><b>Keterangan :<br></b>{{$detil->keterangan}}</pre>
                    @endif
                    </span>

                    @if ($detil->foto != null)
                <div style="page-break-after: auto;" >
                    <b>Dokumentasi : </b>
                     <br><br><br><br>
                <center>
                            @if ($detil->foto != null)
                    @foreach(explode('|',$detil->foto) as $item)

                    <img  src="{{ public_path('storage/smc')}}/{{$detil->no_lap}}/{{$item}}" style="height:230px;  margin-bottom: 5pt">  &nbsp;
                    @endforeach
                        @else 
                        Harap Upload Foto Dokumentasi
                        @endif
                </center>
                </div>
                @endif
{{-- <div style="position: absolute; right: 0; bottom: 0px;" align="center">
    <img src="data:image/png;base64, {!! $qrcode !!}">
    <figcaption><font size="8pt" style="margin-top: 20px">{{$detil->no_lap}}</font></figcaption>
</div> --}}
</body>
    </html>