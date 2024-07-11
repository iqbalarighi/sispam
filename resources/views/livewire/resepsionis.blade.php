<div wire:poll.35s>
    <table class="table-striped table-hover" width="100%">
        <tr>
            <th align="center">Total</th>
            <th align="center">Datang</th>
            <th align="center">Pulang</th>
        </tr>
        <tr>
            <td align="center">{{$total}}</td>
            <td align="center">{{$count}}</td>
            <td align="center">{{$count2}}</td>
        </tr>
        <tr>
            <th>Perwakilan Tamu</th>
            <th>Perusahaan/Institusi</th>
            <th>Tujuan</th>
        </tr>
        {{-- {{dd($resepsionis)}} --}}
    @if(count($resepsionis) == 0)
        <tr>
            <td align="center" colspan="5">Belum ada tamu</td>
        </tr>
    @endif
    @foreach($resepsionis as $items)
        <tr style="cursor: pointer;" class="bg-{{$items->jam_pulang == null ? 'warning' : ''}}">
            <td>{{$items->nama_lengkap}}</td>
            <td>{{$items->institusi}}</td>
            <td>{{$items->lantai}}</td>
        </tr>
    @endforeach
    </table>
</div>
