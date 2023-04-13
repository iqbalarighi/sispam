<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>{{ config('app.name', 'SISPAM') }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

                    <style>
                        .xx {
                            font-size: 10pt;
                            text-align: center;
                        }
                        .table tr td {
                            padding:0.3rem;
                            vertical-align: middle;
                            white-space:nowrap;
                        }
                        .table th {
                            padding:0.5rem;
                            white-space:nowrap;
                            vertical-align: middle;
                        }
                        label {
                            margin: 0em;
                        }

                        pre {
                                white-space: pre-line;     /* Since CSS 2.1 */
                            }
                    </style>
                    <style>
                        a {color:black;}
                       a:hover { color:rgb(0, 138, 0);}
                       label:hover { color:rgb(0, 138, 0);}
                    </style>
    </head>

                <div class="card-body overflow " style="overflow-x: auto;">
                    <div align="center" class="text-center text-uppercase"> <b>
                        Laporan Tukar Jaga <br>
                        {{$detilx->site->nama_gd}} <br>
                        </b>
                        </div>
                        <br> 
<p>
 Hari / Tanggal : {{Carbon\Carbon::parse($detilx->tanggal)->isoFormat('dddd, D MMMM Y')}} <br>
 Shift / Jam : {{$detilx->shift}} <br>
 Danru : {{$detilx->danru}}
 </p>
<div>
    <h5>Tukar Shift</h5>
</div>

                    <table border="1" class="table-bordered table-striped table-hover text-center" width="300px">
                    <tr class="font-weight-normal xx ">
                        {{-- <th style="max-width:50px; min-width:30px;">No</th> --}}
                        <th width="50%">Shift Lama</th>
                        <th>Shift Baru</th>
                       {{-- <th style="width:72px; ">Option</th> --}}
                    </tr>

                    @foreach ($detil as $key => $item)
                    <tr>
                        {{-- <td>{{$key+1}}</td> --}}
                        <td>@foreach (explode('|',$item->shift_lama) as $til)
                            {{$til}} <br>
                            @endforeach
                        </td>
                        <td>@foreach (explode('|',$item->shift_baru) as $tils)
                            {{$tils}} <br>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                    </table>
                    <br>
<div>
    <h5>Barang Inventaris Yang Diserahterimakan</h5>
</div>
                    <table border="1" class="table-bordered table-striped table-hover text-center" width="auto">
                    <tr class="font-weight-normal xx ">
                        {{-- <th style="max-width:50px; min-width:30px;">No</th> --}}
                        <th style="padding-left: 10px; padding-right: 10px;">Nama Barang</th>
                        <th style="padding-left: 10px; padding-right: 10px;">Jumlah</th>
                        <th style="padding-left: 10px; padding-right: 10px;">Keterangan</th>
                       {{-- <th style="width:72px; ">Option</th> --}}
                    </tr>

                    @foreach ($bar as $key => $ite)
                    <tr>
                        {{-- <td>{{$key+1}}</td> --}}
                        <td>
                            {{$ite->nabar}}
                        </td>
                        <td>
                            {{$ite->jumlah}}
                        </td>
                        <td>
                            {{$ite->ket}}
                        </td>
                    </tr>
                    @endforeach
                    </table>
                    <br>
<div>
    <h5>Daftar Kejadian/Kegiatan</h5>
</div>
                    <table border="1" class="table-bordered table-striped table-hover text-center" width="auto">
                    <tr class="font-weight-normal xx ">
                        {{-- <th style="max-width:50px; min-width:30px;">No</th> --}}
                        <th>Jam</th>
                        <th>Uraian Kejadian/Kegiatan</th>
                       {{-- <th style="width:72px; ">Option</th> --}}
                    </tr>

                    @foreach ($urai as $key => $it)
                    <tr>
                        {{-- <td>{{$key+1}}</td> --}}
                        <td>
                            {{$it->jam}}
                        </td>
                        <td>
                            <div style="white-space: pre-line; text-align: left;">{{$it->uraian}}</div>
                        </td>
                    </tr>
                    @endforeach
                    </table>
                </div>
    </html>