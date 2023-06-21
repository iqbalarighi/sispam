<table>
<tr >
    <th style="text-align: center; max-width:50px; min-width:30px; vertical-align: middle;">No</th>
    <th style="text-align: center; vertical-align: middle;">No Laporan</th>
    <th style="text-align: center; vertical-align: middle;">User Pelapor</th>
    <th style="text-align: center; vertical-align: middle;">Jenis Kejadian</th>
    <th style="text-align: center; vertical-align: middle;">Lokasi Kejadian</th>
    <th style="text-align: center; vertical-align: middle;">Waktu Kejadian</th>
    <th style="text-align: center; vertical-align: middle;">Jam Kejadian</th>
    <th style="text-align: center; vertical-align: middle;">Jenis Potensi</th>
    <th style="text-align: center; vertical-align: middle;">Penyebab</th>
    <th style="text-align: center; vertical-align: middle;">Saksi Mata</th>
    <th style="text-align: center; vertical-align: middle;">Korban</th>
    <th style="text-align: center; vertical-align: middle;">Kerugian</th>
    <th style="text-align: center; vertical-align: middle;">Penyebab Dasar</th>
    <th style="text-align: center; vertical-align: middle;">Penyebab Langsung<br>(Tindakan Tidak Aman)</th>
    <th style="text-align: center; vertical-align: middle;">Penyebab Langsung<br>(Kondisi Tidak Aman)</th>
    <th style="text-align: center; vertical-align: middle; width:500px; min-width:200px;">Uraian Singkat</th>

</tr>
@foreach ($data as $key => $jadi)
<tr>
    <td style="text-align: center; vertical-align: middle;">{{$data->firstitem()+$key}}</td>
    <td style="vertical-align: middle;">{{$jadi->no_lap}}</td>
    <td style="vertical-align: middle;">{{$jadi->user_pelapor}}</td>
    <td style="vertical-align: middle;"> @if ('Lain-lain :' == Str::substr($jadi->jenis_kejadian, 0,11))
    {{Str::substr($jadi->jenis_kejadian, 11,1000)}}
        @else
    {{$jadi->jenis_kejadian}}
        @endif
    </td>
    <td style="vertical-align: middle;">{{$jadi->site->nama_gd}}</td>
    <td style="vertical-align: middle;">{{Carbon\Carbon::parse($jadi->waktu_kejadian)->isoFormat('dddd, D MMMM Y')}}</td>
    <td style="vertical-align: middle;">{{$jadi->jam_kejadian}} WIB</td>
    <td style="vertical-align: middle;">@if ('Lain-lain :' == Str::substr($jadi->jenis_potensi, 0,11))
    {{Str::substr($jadi->jenis_potensi, 11,1000)}}
        @else
    {{$jadi->jenis_potensi}}
        @endif
    </td>
    <td style="vertical-align: middle;">{{$jadi->penyebab}}</td>
    <td style="vertical-align: middle;">{{$jadi->saksi_mata}}</td>
    <td style="vertical-align: middle;">{{$jadi->korban}}</td>
    <td style="vertical-align: middle;">{{$jadi->kerugian}}</td>
    @php
    $sebab = explode('|', $jadi->sebab_dasar);
    $tindak = explode('|', $jadi->sebab_tindakan);
    $kondisi = explode('|', $jadi->sebab_kondisi);
    @endphp
    <td style="vertical-align: middle;">@foreach ($sebab as  $key => $item) 
                            @if ('Lain-lain :' == Str::substr($item, 0,11))
                            {{$key+1}}.{{Str::substr($item, 11,1000)}}
                            @else
                            {{$key+1}}. {{$item}}
                        @if (!next($sebab)) 
                        
                        @else
                        <br>
                        @endif
                            @endif
                            @endforeach</td>
    <td style="vertical-align: middle;">@foreach ($tindak as  $key => $item) 
                            @if ('Lain-lain :' == Str::substr($item, 0,11))
                            &nbsp;{{$key+1}}.{{Str::substr($item, 11,1000)}}
                            @else
                            &nbsp;{{$key+1}}. {{$item}} 
                        @if (!next($tindak)) 
                        
                        @else
                        <br>
                        @endif
                            @endif
                            @endforeach</td>
    <td style="vertical-align: middle;">@foreach ($kondisi as $key => $item) 
                            @if ('Lain-lain :' == Str::substr($item, 0,11))
                            &nbsp;{{$key+1}}.{{Str::substr($item, 11,1000)}}
                            @else
                            &nbsp;{{$key+1}}. {{$item}}
                        @if (!next($kondisi)) 
                        
                        @else
                        <br>
                        @endif
                            @endif
                        @endforeach</td>
    <td style="vertical-align: middle; width:500px; min-width:200px;">{{$jadi->uraian_singkat}}</td>

@endforeach

</table>