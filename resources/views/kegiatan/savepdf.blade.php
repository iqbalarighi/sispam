<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'SISPAM') }}</title>
        <style type="text/css">
            pre {
                font-family : Calibri;
            }

            .potong {
                white-space: pre-line;       /* Internet Explorer 5.5+ */
            }
        </style>
    </head>
<body>
                    <h4>
                        <b><center>Laporan Kegiatan Petugas Pengamanan</center></b>
                        <b><center>{{$detil->site->nama_gd}}</center></b>
                        <b><center>{{Carbon\Carbon::parse($detil->tanggal)->isoFormat('dddd, D MMMM Y')}}</center></b>
                        <b><center>Pukul {{Carbon\Carbon::parse($detil->created_at)->isoFormat('HH:mm:ss')}} WIB</center></b>
                    </h4>
                
                <table class="table table-responsive" width="100%">
                    <tr>
                        <td><b>No. laporan: </b>{{$detil->no_lap}} </td> 
                    </tr>
                    <tr>
                        <td colspan="3"><b>Personil Yang Bertugas : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0">{{$detil->personil}}</pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Tim Respon Cepat : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0" >{{$detil->trc}}</pre></td>
                    </tr>
                    <tr>
                        <td><b>Update Giat : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0 potong" style="">{{$detil->giat}}</pre></td>
                    </tr>
                    <tr>
                        <td><b>Keterangan : </b></td>
                    </tr>
                    <tr>
                        <td colspan="3"><pre class="mb-0 potong">{{$detil->keterangan}}</pre></td> 
                    </tr>
                    </table>
                    <table align="center">

                    <tr>
                        <td align="center" colspan="3"><b>Dokumentasi : </b> <br/>
                             <br/><br/><br/>
                            @if ($detil->foto != null)
                    @foreach(explode('|',$detil->foto) as $item)

                    <img  src="{{ public_path('storage/kegiatan')}}/{{$detil->no_lap}}/{{$item}}" style="height:250px;  margin-bottom: 5pt">  &nbsp;
                    @endforeach
                        @else 
                        Harap Upload Foto Dokumentasi
                        @endif

                        </td>
                    </tr>
                    </table>
</body>
    </html>