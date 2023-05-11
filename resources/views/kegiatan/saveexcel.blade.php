                    <table>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">No. Laporan</th>
                        <th style="text-align: center;">Danru</th>
                        <th style="text-align: center;">Shift</th>
                        <th style="text-align: center;">Hari/Tanggal</th>
                        <th style="text-align: center;">Jam</th>
                        <th style="text-align: center;">Lokasi</th>
                    </tr>

                    @foreach($giats as $key => $giat)
                    <tr>
                        <td>{{$giats->firstitem() + $key}}</td>
                        <td>{{$giat->no_lap}}</td>
                        <td>{{$giat->danru}}</td>
                        <td>
                    @if ( Carbon\Carbon::parse($giat->created_at)->isoFormat('HHmmss') >= 200000)
                        Shift Malam 19.00 - 07.00 WIB
                    @elseif (Carbon\Carbon::parse($giat->created_at)->isoFormat('HHmmss') <= 80000)
                        Shift Malam 19.00 - 07.00 WIB
                    @else
                        Shift Pagi 07.00 - 19.00 WIB
                    @endif
                        </td>
                        <td>{{Carbon\Carbon::parse($giat->tanggal)->isoFormat('dddd, D MMMM Y')}}</td>
                        <td>{{Carbon\Carbon::parse($giat->created_at)->isoFormat('HH:mm')}} WIB</td>
                        <td>{{$giat->site->nama_gd}}</td>
                    </tr>
                    @endforeach
                    </table>
