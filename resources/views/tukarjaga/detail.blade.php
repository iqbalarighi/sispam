@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
                <!-- Notifikasi -->
        @if ($message = Session::get('sukses'))
            <div align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
                <div class="row">
                    <div class="col">
        <div class="card-text" align="center">
                    {{ $message }}
        </div>
                    </div>
                    <div class="col-md-auto">
        <div style="float: right;">
        <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close" align="right"></button>
        </div>                
                    </div>
                </div>
            </div>
            <p/>
        @endif
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold ">{{ __('Detail Laporan Serah Terima Jaga') }}
                    <a href="{{url('edit-lap')}}/{{$detilx->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Editor</span></a> 
                    <a href="{{route('tukarjaga')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
                </div>

                <div class="card-body overflow " style="overflow-x: auto;">

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
                            padding:0.3rem;
                            white-space:nowrap;
                            vertical-align: middle;
                        }
                        label {
                            margin: 0em;
                        }

                        pre {
                                white-space: pre-wrap;       /* Since CSS 2.1 */
                                white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
                                white-space: -pre-wrap;      /* Opera 4-6 */
                                white-space: -o-pre-wrap;    /* Opera 7 */
                                word-wrap: break-word;       /* Internet Explorer 5.5+ */
                            }
                    </style>
                    <style>
                        a {color:black;}
                       a:hover { color:rgb(0, 138, 0);}
                       label:hover { color:rgb(0, 138, 0);}
                    </style>
                    <div align="center" class="text-center text-uppercase"> <b>
                        Laporan Serah Terima Jaga <br>
                        {{$detilx->site->nama_gd}} <br>
                        </b>
                        </div>
                        <br> 
<p>
 Hari / Tanggal : {{Carbon\Carbon::parse($detilx->tanggal)->isoFormat('dddd, D MMMM Y')}} <br>
 Shift / Jam : {{$detilx->shift}} <br>
 Danru : {{$detilx->danru}}
 </p>  
 <p>
<div>
    <h5>Tukar Shift</h5>
</div>
      
                    <table class="table-bordered table-striped table-hover text-center" width="300px">
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
        </p>
        <p>
<div>
    <h5>Barang Inventaris</h5>
</div>
                    <table class="table-bordered table-striped table-hover text-center" width="auto">
                    <tr class="font-weight-normal xx ">
                        {{-- <th style="max-width:50px; min-width:30px;">No</th> --}}
                        <th class="pl-1 pr-1">Nama Barang</th>
                        <th class="pl-1 pr-1">Jumlah</th>
                        <th class="pl-1 pr-1">Keterangan</th>
                       {{-- <th style="width:72px; ">Option</th> --}}
                    </tr>

                    @foreach ($bar as $key => $ite)
                    <tr>
                        {{-- <td>{{$key+1}}</td> --}}
                        <td class="pl-1 pr-1">
                            {{$ite->nabar}}
                        </td>
                        <td>
                            {{$ite->jumlah}}
                        </td>
                        <td class="pl-1 pr-1">
                            {{$ite->ket}}
                        </td>
                    </tr>
                    @endforeach
                    </table>
        </p>
        <p>
<div>
    <h6>Daftar Kejadian/Kegiatan</h6>
</div>
                    <table class="table-bordered table-striped table-hover text-center" width="auto">
                    <tr class="font-weight-normal xx ">
                        {{-- <th style="max-width:50px; min-width:30px;">No</th> --}}
                        <th >Jam</th>
                        <th>Uraian Kejadian/Kegiatan</th>
                       {{-- <th style="width:72px; ">Option</th> --}}
                    </tr>

                    @foreach ($urai as $key => $it)
                    <tr>
                        {{-- <td>{{$key+1}}</td> --}}
                        <td class="pl-1 pr-3" >
                            {{$it->jam}}
                        </td>
                        <td>
                            <pre style="word-wrap: break-word; text-align: left;" class="pl-1 pr-1">{{$it->uraian}}</pre>
                        </td>
                    </tr>
                    @endforeach
                    </table>
        </p>
                            <form method="GET" action="/viewpdf/{{$detilx->id}}" enctype="multipart/form-data">
                            <div class="form-group">
                             <div align="center" class="control">
                                 <button type="submit" class="btn btn-primary">Download Laporan</button>
                             </div>
                            </div>
                            </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection