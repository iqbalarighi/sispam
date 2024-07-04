<div wire:poll.5s>
    <style type="text/css">
        th, td { 
            text-align:center;
            vertical-align: middle;
         }
    </style>
    <table class="table-striped table-hover" width="100%">
        <tr>
            <th width="120px">Nomor<br/>Dokumen</th>
            <th>Perusahaan</th>
            <th>Pemohon</th>
            <th>Tanggal<br/>Permohonan</th>
            <th>Status</th>
        </tr>
    @foreach($kerja as $item)
        <tr onclick="window.location='{{url('izin-detail/'.$item->id)}}'" style="cursor: pointer;">
            <td>{{$item->izin_id}}</td>
            <td style="white-space: normal; font-size: 11pt;">{{"Lainnya" == Str::substr($item->izin_informasi->perusahaan_pemohon, 0,7) ? Str::substr($item->izin_informasi->perusahaan_pemohon, 8,100) : $item->izin_informasi->perusahaan_pemohon}}</td>
            <td align="center">{{$item->izin_informasi->pemohon}}</td>
            <td>{{Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y')}}</td>
            <td align="center">
                <span class="text-danger rounded fw-bold px-1">{{$item->status}}</span>
            </td>
        </tr>
    @endforeach
    @foreach($kerja2 as $item)
        <tr onclick="window.location='{{url('izin-detail/'.$item->id)}}'" style="cursor: pointer;">
            <td>{{$item->izin_id}}</td>
            <td style="white-space: normal; font-size: 11pt;">{{"Lainnya" == Str::substr($item->izin_informasi->perusahaan_pemohon, 0,7) ? Str::substr($item->izin_informasi->perusahaan_pemohon, 8,100) : $item->izin_informasi->perusahaan_pemohon}}</td>
            <td align="center">{{$item->izin_informasi->pemohon}}</td>
            <td>{{Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y')}}</td>
            <td align="center">
                <span class="text-success rounded fw-bold px-1" style="white-space: nowrap;">{{$item->status}}</span>
            </td>
        </tr>
    @endforeach
    @foreach($kerja3 as $item)
        <tr onclick="window.location='{{url('izin-detail/'.$item->id)}}'" style="cursor: pointer;">
            <td>{{$item->izin_id}}</td>
            <td style="white-space: normal; font-size: 11pt;">{{"Lainnya" == Str::substr($item->izin_informasi->perusahaan_pemohon, 0,7) ? Str::substr($item->izin_informasi->perusahaan_pemohon, 8,100) : $item->izin_informasi->perusahaan_pemohon}}</td>
            <td align="center">{{$item->izin_informasi->pemohon}}</td>
            <td>{{Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y')}}</td>
            <td align="center">
                <span style="color: #ffc107; font-weight: bold; text-shadow: 1px 1px 3px #000000;" class=" rounded fw-bold px-1">{{$item->status}}</span>
            </td>
        </tr>
    @endforeach
    </table>
</div>
