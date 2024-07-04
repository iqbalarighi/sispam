<div wire:poll.15s>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <table class="table-striped table-hover" width="100%">
        <tr>
            <th>Nomor<br/>Laporan</th>
            <th>Jenis<br/>Kegawatdaruratan</th>
            <th>Tanggal<br/>Kejadian</th>
            <th>Terakhir<br/>Diperbarui</th>
            <th>Status</th>
        </tr>
    @if(count($gawat) == 0 && count($gawat2) == 0)
        <tr>
            <td align="center" colspan="5">Tidak ada laporan</td>
        </tr>
    @endif
    @foreach($gawat as $item)
        <tr onclick="window.location='{{url('bencana-detil/'.$item->id)}}'" style="cursor: pointer;">
            <td>{{$item->no_bencana}}</td>
            <td>{{$item->jenis_bencana}}</td>
            <td>{{Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y')}}</td>
            <td>{{Carbon\Carbon::parse($item->update_at)->isoFormat('D MMMM Y')}}</td>
            <td>
                <span class="text-danger rounded fw-bold px-1">{{$item->status}}</span>
            </td>
        </tr>
    @endforeach
    @foreach($gawat2 as $item)
        <tr onclick="window.location='{{url('bencana-detil/'.$item->id)}}'" style="cursor: pointer;">
            <td>{{$item->no_bencana}}</td>
            <td>{{$item->jenis_bencana}}</td>
            <td>{{Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y')}}</td>
            <td>{{Carbon\Carbon::parse($item->update_at)->isoFormat('D MMMM Y')}}</td>
            <td>
                <span class="text-success rounded fw-bold px-1">{{$item->status}}</span>
            </td>
        </tr>
    @endforeach
</table>
</div>
