                    <style type="text/css">
                        tr > td {
                                    border-bottom: 1px solid #000000;
                                }
                    </style>

                    <table border="1" style="">
                    <tr style="text-align:center;" >
                        <th >No</th>
                        <th>No. Laporan</th>

                       <th >Danru</th>

                        <th>Shift</th>
                        <th>Hari/Tanggal</th>
                        <th>Jam</th>
                        <th>Lokasi</th>

                    </tr>

                    @foreach($giats as $key => $giat)
                    <tr style="cursor: pointer; user-select: none;">
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
                    @endif</td>
                        <td>{{Carbon\Carbon::parse($giat->tanggal)->isoFormat('dddd, D MMMM Y')}}</td>
                        <td>{{Carbon\Carbon::parse($giat->created_at)->isoFormat('HH:mm')}} WIB</td>
                        <td>{{$giat->site->nama_gd}}</td>

                    </tr>
                    @endforeach
                    </table>
