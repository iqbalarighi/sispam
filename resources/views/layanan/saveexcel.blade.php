                    <table>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">ID Layanan</th>
                        <th style="text-align: center;">Waktu</th>
                        <th style="text-align: center;">Layanan</th>
                        <th style="text-align: center;">Uraian</th>
                        <th style="text-align: center;">Lokasi</th>
                        <th style="text-align: center;">Nama PIC</th>
                        <th style="text-align: center;">Satker</th>
                        <th style="text-align: center;">Status</th>
                    </tr>

                    @foreach($layan as $key => $layanan)
                    <tr>
                        <td>{{$layan->firstitem()+$key}}</td>
                        <td>{{$layanan->layanan_id}}</td>
                        <td>{{Carbon\Carbon::parse($layanan->tanggal)->isoFormat('DD MMMM YYYY')}}
                                Pukul {{Carbon\Carbon::parse($layanan->tanggal)->isoFormat('HH:mm')}}</td>
                        <td style="text-align: left !important;">
                            <ul>
                                @foreach(explode(',',$layanan->layanan) as $item)
                                    @if ('Lain-lain' == Str::substr($item, 0,9))
                                        <li>{{Str::substr($item, 12,1000)}}</li>
                                    @else
                                        <li>{{$item}}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </td>
                        <td style="text-align: justify; text-justify: inter-word;">{{$layanan->detail_kebutuhan}}</td>
                        <td>{{$layanan->lokasi}}</td>
                        <td>{{$layanan->pic}}</td>
                        <td>{{$layanan->satker}}</td>
                        <td style="cursor: pointer;">
                            @if($layanan->status == "Cancelled by user")
                                Cancelled
                            @else
                                {{$layanan->status}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </table>
