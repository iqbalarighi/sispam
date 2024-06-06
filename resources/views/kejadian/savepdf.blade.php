 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'SISPAM') }}</title>
                            <style>
                        pre {
                            font-family : system-ui;
                        }
                        .potong {
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

                    <div>
                        <img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 0px; width: 150px; position: fixed;">
                        <div style="padding-bottom: 1rem;">
                            <center><b>Laporan Kejadian/Insiden</b></center>
                            <center><b>{{$detil->site->nama_gd}}</b></center>
                            <center><b>{{Carbon\Carbon::parse($detil->created_at)->isoFormat('dddd, D MMMM Y')}} {{Carbon\Carbon::parse($detil->created_at)->isoFormat('HH:mm:ss')}} WIB</b></center>
                        </div>

                    <table class="table table-responsive">
                    <tr>
                        <td><b>No Laporan Kejadian</b> </td><td>:</td><td> {{$detil->no_lap}}</td>
                    </tr>
                    @if ('Lain-lain :' == Str::substr($detil->jenis_kejadian, 0,11))
                    <tr>
                        <td><b>Jenis Kejadian</b></td><td>:</td><td> {{Str::substr($detil->jenis_kejadian, 12,1000)}}</td>
                    </tr>
                    @else
                    <tr>
                        <td><b>Jenis Kejadian</b></td><td> :  </td><td> {{$detil->jenis_kejadian}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td><b>Lokasi Kejadian</b> </td><td>:</td><td> {{$detil->site->nama_gd}}</td>
                    </tr>
                    <tr>
                        <td><b>Waktu Kejadian</b> </td><td>:</td><td> {{Carbon\Carbon::parse($detil->waktu_kejadian)->isoFormat('dddd, D MMMM Y')}}</td>
                    </tr>
                    <tr>
                        <td><b>Jam kejadian</b> </td><td>:</td><td> {{$detil->jam_kejadian}} WIB</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.5rem;"></td> 
                    </tr>
                    @if ('Lain-lain :' == Str::substr($detil->jenis_potensi, 0,11))
                    <tr>
                        <td><b>Jenis Potensi</b></td><td> :  </td><td>{{Str::substr($detil->jenis_potensi, 12,1000)}}</td>
                    </tr>
                    @else
                    <tr>
                        <td><b>Jenis Potensi</b> </td><td> :  </td><td>{{$detil->jenis_potensi}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td><b>Penyebab</b> </td><td>:</td><td> {{$detil->penyebab}}</td>
                    </tr>
                    <tr>
                        <td><b>Saksi Mata</b> </td><td>:</td><td> {{$detil->saksi_mata}}</td>
                    </tr>
                    <tr>
                        <td><b>Korban</b> </td><td>:</td><td> {{$detil->korban}}</td>
                    </tr>
                    <tr>
                        <td><b>Kerugian</b> </td><td>:</td><td> {{$detil->kerugian}}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.5rem;"></td> 
                    </tr>
                    <tr>
                        <td><b>Penyebab Dasar</b></td><td> :  </td>
                        <td>@foreach (explode('|', $detil->sebab_dasar) as  $key => $item) 
                            @if ('Lain-lain :' == Str::substr($item, 0,11))
                            {{$key+1}}.{{Str::substr($item, 11,1000)}}
                            @else
                            {{$key+1}}. {{$item}}<br>
                            @endif
                            @endforeach
                    </td>
                    </tr>
                    <tr>
                        <td><b>Penyebab Langsung <br/>(Tindakan Tidak Aman)</b></td><td> : </td>
                        <td>@foreach (explode('|', $detil->sebab_tindakan) as  $key => $item) 
                            @if ('Lain-lain :' == Str::substr($item, 0,11))
                            {{$key+1}}.{{Str::substr($item, 11,1000)}}
                            @else
                            {{$key+1}}. {{$item}}<br>
                            @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td><b>Penyebab Langsung <br/>(Kondisi Tidak Aman)</b></td>
                        <td> :  </td>
                        <td>@foreach (explode('|', $detil->sebab_kondisi) as $key => $item) 
                            @if ('Lain-lain :' == Str::substr($item, 0,11))
                            {{$key+1}}.{{Str::substr($item, 11,1000)}}
                            @else
                            {{$key+1}}. {{$item}}<br>
                            @endif
                        @endforeach</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.5rem;"></td> 
                    </tr>
                    <tr>
                        <td><b>Uraian Singkat</b>   </td><td>:</td><td > <pre class="potong">{{$detil->uraian_singkat}}</pre></td>
                    </tr>
                    <tr>
                        <td><b>Perlu Tindakan Perbaikan</b>   </td><td>:</td><td> {{$detil->tindak_perbaikan}}</td>
                    </tr>
                    <tr>
                        <td><b>Rencana Perbaikan</b>   </td><td>:</td><td> {{$detil->rencana_perbaikan}}</td>
                    </tr>
                    <tr>
                        <td><b>Komentar Management <br/>Representative</b>   </td><td>:</td><td> {{$detil->kom_mng_rep}}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.5rem;"></td> 
                    </tr>
                    <tr>
                        <td><b>Nama Pelapor</b>   </td><td>:</td><td> {{$detil->nama_pelapor}}</td>
                    </tr>
                    <tr>
                        <td><b>Unit Kerja Pelapor</b>   </td><td>:</td><td> {{$detil->uker_pelapor}}</td>
                    </tr>
                    </table>
                    <table align="center">
                    <tr>
                        <td align="center" colspan="4"><b>Dokumentasi : </b> <br/>
                             <br/><br/><br/>
                        @if ($detil->dokumentasi != null)
                            @foreach(explode('|',$detil->dokumentasi) as $item)
                                <img  src="{{ public_path('storage/kejadian')}}/{{$detil->no_lap}}/{{$item}}" style="height:250px;  margin-bottom: 5pt; padding-top: 10px;">  &nbsp;
                            @endforeach
                        @else 
                            
                        @endif
                    </td>
                    </tr>
                    </table>
                </div>
                    <table width="100%" border="0" style="vertical-align: middle; text-align: center;">
                        <tr>
                            <td width="30%"><pre class="narrow">
Mengetahui,
{{$otor->jabatan}}



<b>{{$otor->nama}}</b>
NIP. {{$otor->nip}}</pre>
                        </td>
<td width="33%" style="vertical-align: top;">Jakarta, {{Carbon\Carbon::parse($detil->created_at)->isoFormat('D MMMM Y')}}</td>
                        <td width="33%" style="vertical-align: top;"><pre class="narrow">
Disusun Oleh,




<b>{{$detil->nama_pelapor}}</b>
{{$detil->uker_pelapor}}</pre>
                        </td>
                        </tr>
                    </table>
                    
<div style="position: absolute; right: 0; bottom: 0px;" align="center">
    <img src="data:image/png;base64, {!! $qrcode !!}">
    <figcaption><font size="8pt" style="margin-top: 20px">{{$detil->no_lap}}</font></figcaption>
</div>
            </body>
    </html>