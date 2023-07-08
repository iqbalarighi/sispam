<style type="text/css">
    th {}
    td {vertical-align: middle;}
</style>

<table>
<tr>
    <th colspan="14" style="text-align: center; vertical-align: middle;"></th>
</tr>
<tr>
    <th colspan="14" style="text-align: center; vertical-align: middle;">DATA KEGIATAN UNJUK RASA</th>
</tr>
<tr>   
    @if ($start == $end)
    <th colspan="14" style="text-align: center; vertical-align: middle;">{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}}</th>
    @else
    <th colspan="14" style="text-align: center; vertical-align: middle;">{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}} - {{Carbon\Carbon::parse($end)->isoFormat('D MMMM Y')}}</th>
    @endif
</tr>
<tr>
    <th colspan="14" style="text-align: center; vertical-align: middle;"></th>
</tr>

    <tr class="font-weight-normal">
        <th style="text-align: center; vertical-align: middle; width:30px;">No</th>
        <th style="text-align: center; vertical-align: middle;">Tanggal</th>
        <th style="text-align: center; vertical-align: middle;width:80px;">Waktu</th>
        <th style="text-align: center; vertical-align: middle;">Tempat Kegiatan</th>
        <th style="text-align: center; vertical-align: middle;">Pelaksana</th>
        <th style="text-align: center; vertical-align: middle;">Tuntutan</th>
        <th style="text-align: center; vertical-align: middle;">Bentuk Kegiatan</th>
        <th style="text-align: center; vertical-align: middle; width: 89px;">Kisaran Jumlah Massa</th>
        <th style="text-align: center; vertical-align: middle;" >Status Kegiatan</th>
        <th style="text-align: center; vertical-align: middle; width: 70px;" >Level Risiko</th>
        <th style="text-align: center; vertical-align: middle;" >Sifat Kegiatan</th>
        <th style="text-align: center; vertical-align: middle;" >Keterangan</th>
        <th style="text-align: center; vertical-align: middle;" >Creator</th>
        <th style="text-align: center; vertical-align: middle;" >Editor</th>
    </tr>

    @foreach ($unras as $key => $rasa)
    <tr>
       <td style="text-align: center; vertical-align: middle;">{{$unras->firstitem() + $key}}</td>
       <td style="text-align: center; vertical-align: middle;">{{Carbon\Carbon::parse($rasa->tanggal)->isoFormat('D MMMM Y')}}</td> 
       <td style="text-align: center; vertical-align: middle;">{{$rasa->waktu}} WIB</td> 
       <td style="vertical-align: middle; width: 300px;">{{$rasa->tempat_kegiatan}}</td> 
       <td style="vertical-align: middle; width: 300px;">{{$rasa->pelaksana}}</td> 
       <td style="vertical-align: middle; width: 300px; text-align: justify;">{{$rasa->tuntutan}}</td> 
       <td style="text-align: center; vertical-align: middle;">
        @if ('Lain-lain :' == Str::substr($rasa->bentuk_kegiatan, 0,11))
            {{Str::substr($rasa->bentuk_kegiatan, 12,1000)}}
            @else
            {{$rasa->bentuk_kegiatan}}
            @endif
       </td> 
       <td style="text-align: center; vertical-align: middle;">{{$rasa->jumlah_massa}} Orang</td> 
       <td style="text-align: center; vertical-align: middle;">
        @if ('Lain-lain :' == Str::substr($rasa->status_kegiatan, 0,11))
            {{Str::substr($rasa->status_kegiatan, 12,1000)}}
            @else
            {{$rasa->status_kegiatan}}
            @endif
    </td> 
        @if ($rasa->level_resiko == 'Minimal')
        <td style="text-align: center; vertical-align: middle; background-color: limegreen; color: black;"><b>{{$rasa->level_resiko}}</b></td>
        @elseif ($rasa->level_resiko == 'Rendah')
        <td style="text-align: center; vertical-align: middle; background-color: yellow; color: black;"><b>{{$rasa->level_resiko}}</b></td>
        @elseif ($rasa->level_resiko == 'Sedang')
        <td style="text-align: center; vertical-align: middle; background-color: orange; color: black;"><b>{{$rasa->level_resiko}}</b></td>
        @elseif ($rasa->level_resiko == 'Tinggi')
        <td style="text-align: center; vertical-align: middle; background-color: red; color: black;"><b>{{$rasa->level_resiko}}</b></td>
        @elseif ($rasa->level_resiko == 'Ekstrem')
        <td style="text-align: center; vertical-align: middle; background-color: darkred; color: white;"><b>{{$rasa->level_resiko}}</b></td>
        @else
        <td style="text-align: center; vertical-align: middle;">{{$rasa->level_resiko}}</td>
        @endif
         
       <td style="text-align: center; vertical-align: middle;">{{$rasa->sifat_kegiatan}}</td> 
       <td style="vertical-align: middle;">{{$rasa->keterangan}}</td>
       <td style="vertical-align: middle;">{{$rasa->creator}}</td>
       <td style="vertical-align: middle;">{{$rasa->editor}}</td>
   </tr>
   @endforeach
</table>