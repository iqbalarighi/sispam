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
                    <img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 25px; width: 150px; position: fixed;">
                    <h4>
                        <b><center>Laporan Kegiatan Petugas Pengamanan</center></b>
                        <b><center>{{$detil->site->nama_gd}}</center></b>
                        <b><center>{{Carbon\Carbon::parse($detil->tanggal)->isoFormat('dddd, D MMMM Y')}}</center></b>
                        <b><center>Pukul {{Carbon\Carbon::parse($detil->created_at)->isoFormat('HH:mm:ss')}} WIB</center></b>
                    </h4>
                </div>
{{--                 <table class="table table-responsive" width="100%" style="">
                
                    <tr>
                        <td><b>No. laporan: </b>{{$detil->no_lap}} </td> 
                    </tr>
                </table> --}}
                    <span class="table table-responsive " width="100%">
                    <b>No. laporan: </b>{{$detil->no_lap}}
                    <pre class="mb-0 potong" style=""><b>Personil Yang Bertugas :<br></b>{{$detil->personil}}</pre>
                    
                    <pre class="mb-0 potong" style=""><b>Tim Respon Cepat :<br></b>{{$detil->trc}}</pre>
                    
                    <pre class="mb-0 potong" style=""><b>Update Giat :<br></b>{{$detil->giat}}</pre>
                    
                    <pre class="mb-0 potong" style=""><b>Keterangan :<br></b>{{$detil->keterangan}}</pre>
                    </span>
                    
                <div style="page-break-after: inherit;" >
                    <b>Dokumentasi : </b>
                     <br><br><br><br><br>
                     <div align="center">
                            @if ($detil->foto != null)
                    @foreach(explode('|',$detil->foto) as $item)

                    <img  src="{{ public_path('storage/kegiatan')}}/{{$detil->no_lap}}/{{$item}}" style="height:250px;  margin-bottom: 5pt">  &nbsp;
                    @endforeach
                        @else 
                        Harap Upload Foto Dokumentasi
                        @endif
                    </div>
                </div>

</body>
    </html>