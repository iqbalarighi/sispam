<style type="text/css">
    th {}
    td {vertical-align: middle;}
    table, th, tr, td {
        font-size: 10.5pt;
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

@if ($start == $end && str_contains(strtolower($cariin),'ojk') && $result == true)
<div style="text-align: center; vertical-align: middle; margin-top: 0px; margin-bottom: 20px;">
<img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 10px; width: 150px; position: fixed;">
        <br><font size="16pt"><b>RENCANA GIAT UNJUK RASA OJK</b></font>
    @if ($start == $end)
    <br/>{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}}
    @else
    <br/>{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}} - {{Carbon\Carbon::parse($end)->isoFormat('D MMMM Y')}}
    @endif
</div>
@else
@if ($unras->count() == 0 && $cariin == null)
<div style="text-align: center; vertical-align: middle; margin-top: 0px; margin-bottom: 20px;">
<img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 10px; width: 150px; position: fixed;">
        <br><font size="16pt"><b>RENCANA GIAT UNJUK RASA</b></font>
    @if ($start == $end)
    <br/>{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}}
    @else
    <br/>{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}} - {{Carbon\Carbon::parse($end)->isoFormat('D MMMM Y')}}
    @endif
</div>
   @elseif ($unras->count() == 0 && $cariin != null)
<div style="text-align: center; vertical-align: middle; margin-top: 0px; margin-bottom: 20px;">
<img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 10px; width: 150px; position: fixed;">
        <br><font size="16pt"><b>REKAP GIAT UNJUK RASA OJK</b></font>
    @if ($start == $end)
    <br/>{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}}
    @else
    <br/>{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}} - {{Carbon\Carbon::parse($end)->isoFormat('D MMMM Y')}}
    @endif
</div>
@elseif (Illuminate\Support\Str::contains(Illuminate\Support\Str::lower($cariin), 'ojk'))
<div style="text-align: center; vertical-align: middle; margin-top: 0px; margin-bottom: 20px;">
<img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 10px; width: 150px; position: fixed;">
        <br><font size="16pt"><b>REKAP GIAT UNJUK RASA OJK</b></font>
    @if ($start == $end)
    <br/>{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}}
    @else
    <br/>{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}} - {{Carbon\Carbon::parse($end)->isoFormat('D MMMM Y')}}
    @endif
</div>
@elseif ($start == $end && $result == true)
<div style="text-align: center; vertical-align: middle; margin-top: 0px; margin-bottom: 20px;">
<img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 10px; width: 150px; position: fixed;">
        <br><font size="16pt"><b>RENCANA GIAT UNJUK RASA</b></font>
    @if ($start == $end)
    <br/>{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}}
    @else
    <br/>{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}} - {{Carbon\Carbon::parse($end)->isoFormat('D MMMM Y')}}
    @endif
</div>
   @else
<div style="text-align: center; vertical-align: middle; margin-top: 0px; margin-bottom: 20px;">
<img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 10px; width: 150px; position: fixed;">
        <br><font size="16pt"><b>REKAP GIAT UNJUK RASA</b></font>
    @if ($start == $end)
    <br/>{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}}
    @else
    <br/>{{Carbon\Carbon::parse($start)->isoFormat('D MMMM Y')}} - {{Carbon\Carbon::parse($end)->isoFormat('D MMMM Y')}}
    @endif
</div>
 @endif
@endif
    

<table width="100%">
    <tr class="font-weight-normal" style="background-color: #D3D3D3;">
        <th style="text-align: center; vertical-align: middle; width:30px;">No.</th>
        <th style="text-align: center; vertical-align: middle;">Tanggal</th>
        <th style="text-align: center; vertical-align: middle; width:70px;">Waktu</th>
        <th style="text-align: center; vertical-align: middle; width: 120px;">Tempat Kegiatan</th>
        <th style="text-align: center; vertical-align: middle; width: 120px;">Pelaksana</th>
        <th style="text-align: center; vertical-align: middle; width: 160px;">Tuntutan</th>
        <th style="text-align: center; vertical-align: middle; width: 70px;">Bentuk<br/>Kegiatan</th>
        <th style="text-align: center; vertical-align: middle; width: 70px;">Kisaran Jumlah Massa</th>
        <th style="text-align: center; vertical-align: middle; width: 65px;" >Status<br/>Kegiatan</th>
        <th style="text-align: center; vertical-align: middle; width: 65px;" >Level Risiko</th>
        <th style="text-align: center; vertical-align: middle; width: 65px;" >Sifat<br/>Kegiatan</th>
        <th style="text-align: center; vertical-align: middle;" >Keterangan</th>
    </tr>
    @if ($unras->count() == 0)
    <tr>
        <td colspan="12" style="text-align: center; vertical-align: middle; font-size: 18pt;"> <b>NIHIL</b></td>
    </tr>
    @endif
    @foreach ($unras as $key => $rasa)
        @if ($rasa->status_kegiatan == 'Rencana')
        <tr style="background-color: #b8fffa;" id="{{$rasa->id}}">
        @else
        <tr>
        @endif
       <td style="text-align: center; vertical-align: middle;">{{$unras->firstitem() + $key}}</td>
       <td style="text-align: center; vertical-align: middle;">{{Carbon\Carbon::parse($rasa->tanggal)->isoFormat('D MMMM Y')}}</td> 
       <td style="text-align: center; vertical-align: middle;">{{$rasa->waktu}} WIB</td> 
       <td style="vertical-align: middle; width: 100px; text-align: center;">{{$rasa->tempat_kegiatan}}</td> 
       <td style="vertical-align: middle; width: 100px; text-align: center;">{{$rasa->pelaksana}}</td> 
       <td style="vertical-align: middle; width: 100px; text-align: center;">{{$rasa->tuntutan}}</td> 
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
   </tr>
   @endforeach
</table>