<div wire:poll.90s>
    <table class="table-striped table-hover" width="100%">
        <tr>
            <th>Dibuat Oleh</th>
            <th>Jenis<br/>Potensi</th>
            <th>Tanggal<br/>Kejadian</th>
            <th>Terakhir<br/>Diperbarui</th>
            <th>Status</th>
        </tr>
    @if(count($jadi) == 0 && count($jadi2) == 0)
        <tr>
            <td align="center" colspan="5">Tidak ada laporan</td>
        </tr>
    @endif
    @foreach($jadi as $items)
        <tr onclick="window.location='{{url('kejadian-detil/'.$items->no_lap)}}'" style="cursor: pointer;">
            <td>{{$items->user_pelapor}}</td>
            <td>{{"Lain-lain :" == Str::substr($items->jenis_potensi, 0,11) ? Str::substr($items->jenis_potensi, 12,100) : $items->jenis_potensi}}</td>
            <td>{{Carbon\Carbon::parse($items->waktu_kejadian)->isoFormat('D MMMM Y')}}</td>
            <td>{{Carbon\Carbon::parse($items->updated_at)->isoFormat('D MMMM Y')}}</td>
            <td>
                <span class="text-danger rounded fw-bold px-1">{{$items->status}}</span>
            </td>
        </tr>
    @endforeach
    @foreach($jadi2 as $itemx)
        <tr onclick="window.location='{{url('kejadian-detil/'.$itemx->no_lap)}}'" style="cursor: pointer;">
            <td>{{$itemx->user_pelapor}}</td>
            <td>{{"Lain-lain :" == Str::substr($itemx->jenis_potensi, 0,11) ? Str::substr($itemx->jenis_potensi, 12,100) : $itemx->jenis_potensi}}</td>
            <td>{{Carbon\Carbon::parse($itemx->waktu_kejadian)->isoFormat('D MMMM Y')}}</td>
            <td>{{Carbon\Carbon::parse($itemx->updated_at)->isoFormat('D MMMM Y')}}</td>
            <td>
                <span class="text-success rounded fw-bold px-1">{{$itemx->status}}</span>
            </td>
        </tr>
    @endforeach
    </table>
</div>
