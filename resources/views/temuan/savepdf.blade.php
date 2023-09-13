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
                            <b><center>Laporan Temuan Patroli</center></b>
                            <b><center>Unit {{$detil->site->nama_gd}}</center></b>
                            <b><center>{{Carbon\Carbon::parse($detil->created_at)->isoFormat('dddd, D MMMM Y')}} {{Carbon\Carbon::parse($detil->created_at)->isoFormat('HH:mm')}} WIB</center></b>
                    </h4>
                </div>
{{--                 <table class="table table-responsive" width="100%" style="">
                
                    <tr>
                        <td><b>No. laporan: </b>{{$detil->no_lap}} </td> 
                    </tr>
                </table> --}}
                <br>
                    <span class="table table-responsive " width="100%">
                    <b>No. Laporan: </b>{{$detil->no_lap}} <br/>
                    <b>Lokasi Kejadian: </b>{{$detil->site->nama_gd}} <br/>
                    <b>Waktu Kejadian: </b>{{Carbon\Carbon::parse($detil->tanggal)->isoFormat('dddd, D MMMM Y')}} <br>
                    <b>Jam Kejadian: </b>{{$detil->jam}} WIB<br>

                    <pre class="mb-0 potong" style=""><b>Jenis Bahaya :<br></b>{{$detil->jenis_bahaya}}</pre>
                    
                    <pre class="mb-0 potong" style=""><b>Potensi Bahaya :<br></b>{{$detil->potensi_bahaya}}</pre>
                    
                    <pre class="mb-0 potong" style=""><b>Pengendalian :<br></b>{{$detil->pengendalian}}</pre>
                    
                    </span>
                    
                <div style="page-break-after: inherit;" >
                    <b>Dokumentasi : </b>
                     <br><br><br><br><br>
                     <div align="center">
                            @if ($detil->foto != null)
                    @foreach(explode('|',$detil->foto) as $item)

                    <img  src="{{ public_path('storage/temuan')}}/{{$detil->no_lap}}/{{$item}}" style="height:250px;  margin-bottom: 5pt">  &nbsp;
                    @endforeach
                        @else 
                        Harap Upload Foto Dokumentasi
                        @endif
                    </div>
                </div>

</body>
    </html>