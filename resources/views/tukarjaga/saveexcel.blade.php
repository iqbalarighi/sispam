                    <table >
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">No. Laporan</th>
                        <th style="text-align: center;">Danru</th>
                        <th style="text-align: center;">Hari/Tanggal</th>
                        <th style="text-align: center;">Shift</th>
                        <th style="text-align: center;">Jam</th>
                        <th style="text-align: center;">Lokasi</th>                        
                    </tr>

                    @foreach ($trjg as $key => $item)
                    <tr>
                        <td style="text-align: center;">{{$trjg->firstitem() + $key}}</td>
                        <td>{{$item->no_trj}}</td>
                        <td>{{$item->danru}}</td>
                        <td>{{Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd, D MMMM Y')}}</td>
                        <td>{{$item->shift}}</td>
                        <td>{{Carbon\Carbon::parse($item->created_at)->isoFormat('HH:mm')}} WIB</td>
                        <td>{{$item->site->nama_gd}}</td>
                    </tr>
                    @endforeach
                    </table>