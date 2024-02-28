<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>{{ config('app.name', 'SISPAM') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.x/dist/alpine.min.js" defer></script>
        {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}

<script src={{asset("/storage/bootstrap3-typeahead.js")}}></script>

{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- select2 --}}

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

            <!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    @livewireScripts
    @stack('js')
    @stack('styles')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <title>{{ config('app.name', 'SISPAM') }}</title>
        <style type="text/css">
@page { margin: 15px; }
body { 
    margin-left: 20px; 
    margin-right: 20px; 
    margin-top: 25px; 
    margin-bottom: 5px; 
    font-size: 11pt;
}
    table, th, tr, td {
        padding-left: 10px;
        padding-right: 10px;
    }
    .td {
        white-space: nowrap;
    }
pre {
        font-family : system-ui;
    }
.narrow {
          padding: 0px;
          width: 200px;
          margin: 0 auto;
          font-size: 12pt;
          font-family : system-ui;
        }

.box {
@if($detail->risiko == "Sangat Rendah")
  background-color: limegreen;
@elseif($detail->risiko == "Rendah")
 background-color: yellow;
@elseif($detail->risiko == "Sedang")
 background-color: darkorange;
@elseif($detail->risiko == "Tinggi")
 background-color: red;
@elseif($detail->risiko == "Sangat Tinggi")
 background-color: darkred;
@endif
  width: 100px;
  padding: 20px;
  margin: 5px;
  position: absolute;
  top: 25px;
  border: 2px black solid;
}

.box1 {
@if($detail->risiko == "Sangat Rendah")
  margin-right: -118px;
@elseif($detail->risiko == "Rendah")
 margin-right: -100px;
@elseif($detail->risiko == "Sedang")
 margin-right: -98px;
@elseif($detail->risiko == "Tinggi")
 margin-right: -97px;
@elseif($detail->risiko == "Sangat Tinggi")
 margin-right: -118px;
@endif
      
      position: absolute;
      top: 73px;
      text-align: center;
      vertical-align: middle;
}
    </style>
    </head>
<body>
    <div class="mb-5">
        <img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 20px; margin-left: 20px; width: 150px; position: fixed;">
            <center class="text-uppercase fw-bold mt-3"> {{ __('SURAT IZIN KERJA RISIKO ') }} </center>
            <div class="box float-end"></div>
            <div class="box1 float-end">{{$detail->risiko}}</div>

    </div>

                    {{-- Nomor : {{$detail->no_dok}}/IK/{{$detail->izin_informasi->perusahaan_pemohon}}/{{$romawi}}/{{Carbon\Carbon::parse($detail->created_at)->isoFormat('YYYY')}} --}}
                        <div class="col p-0 mb-2">
                            <table class="ms-2">
                                {{-- <tr>
                                    <td>Level Resiko</td>
                                    <td>:</td>
                                    <td>{{$detail->risiko}}</td>
                                </tr>      --}}                           
                                <tr>
                                    <td>Tanggal Terbit </td>
                                    <td>:</td>
                                    <td>{{Carbon\Carbon::parse($detail->izin_validasi->updated_at)->isoFormat('dddd, D MMMM Y')}}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Dokumen</td>
                                    <td>:</td>
                                    <td>{{$detail->izin_id}}</td>
                                </tr>
                            </table>

                        </div>
                    <div class="col" style="overflow: auto;">

                        <div class="row p-0 mb-3">
                            <div class="col px-0 align-middle text-uppercase" style="background-color: lightgrey; width: 95%;">
                                <b> A. Klasifikasi Pekerjaan </b>
                            </div>
                            <table class="ms-2">
                                <tr>
                                    <td>
                                        @foreach(explode(',',$detail->klasifikasi) as $value)
                                        <li>{{$value}}</li>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>

                        </div>
<style type="text/css">
    .xsxs, th, tr, td {
        padding-left: 2px;
        padding-right: 2px;
        padding-top: 0px;
        padding-bottom: 0px;
    }
</style>
                        <div class="row p-0 mb-3" style="page-break-before: auto;">
                                <div class="col px-0 mb-1 text-uppercase" style="background-color: lightgrey; width: 95%;">
                                    <b>B. Informasi Pekerjaan</b>
                                </div>
                            <div class="col-sm-auto" style="width:auto; display:inline-block; vertical-align: top;">
                                
                                <table class="xsxs" width="auto">
                                    <tr>
                                        <td>Pekerjaan</td>
                                        <td>:</td>
                                        <td>{{$detail->izin_informasi->pekerjaan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi</td>
                                        <td>:</td>
                                        <td>{{$detail->izin_informasi->lokasi}}</td>
                                    </tr>
                                    <tr>
                                        <td>Area</td>
                                        <td>:</td>
                                        <td>{{$detail->izin_informasi->area}}</td>
                                    </tr>
                                    <tr>
                                        <td>Plant</td>
                                        <td>:</td>
                                        <td>{{$detail->izin_informasi->plant!=null ? $detail->izin_informasi->plant : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Nama Manager</td>
                                        <td>:</td>
                                        <td>{{$detail->izin_informasi->manager}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Nama Pemohon</td>
                                        <td>:</td>
                                        <td>{{$detail->izin_informasi->pemohon}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Telepon Pemohon</td>
                                        <td>:</td>
                                        <td>{{$detail->izin_informasi->tel_pemohon}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pengawas</td>
                                        <td>:</td>
                                        <td>{{$detail->izin_informasi->pengawas}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Telepon Pengawas</td>
                                        <td>:</td>
                                        <td>{{$detail->izin_informasi->tel_pengawas}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Petugas K3</td>
                                        <td>:</td>
                                        <td>{{$detail->izin_informasi->k3!=null ? $detail->izin_informasi->k3 : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Telepon Petugas K3</td>
                                        <td>:</td>
                                        <td>{{$detail->izin_informasi->tel_k3!=null ? $detail->izin_informasi->tel_k3 : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Perusahaan Pemohon</td>
                                        <td>:</td>
                                        <td>{{$detail->izin_informasi->perusahaan_pemohon}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-auto" style="width: auto; margin-left: 100px; display:inline-block; vertical-align: top;">
                                <table class=" xsxs" width="auto">
                                    <tr>
                                        <td>Daftar Pekerja</td>
                                        <td>:</td>
                                        <td align="center">{{$detail->izin_informasi->pekerja !=null ? $detail->izin_informasi->pekerja : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Enginer</td>
                                        <td>:</td>
                                        <td align="center">{{$detail->izin_informasi->enginer !=null ? $detail->izin_informasi->enginer : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Surveyor</td>
                                        <td>:</td>
                                        <td align="center">{{$detail->izin_informasi->surveyor !=null ? $detail->izin_informasi->surveyor : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Operator_alat</td>
                                        <td>:</td>
                                        <td align="center">{{$detail->izin_informasi->operator_alat !=null ? $detail->izin_informasi->operator_alat : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Rigger</td>
                                        <td>:</td>
                                        <td align="center">{{$detail->izin_informasi->rigger !=null ? $detail->izin_informasi->rigger : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Teknisi Elektrik</td>
                                        <td>:</td>
                                        <td align="center">{{$detail->izin_informasi->teknisi_elektrik !=null ? $detail->izin_informasi->teknisi_elektrik : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Mekanik</td>
                                        <td>:</td>
                                        <td align="center">{{$detail->izin_informasi->mekanik !=null ? $detail->izin_informasi->mekanik : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Welder</td>
                                        <td>:</td>
                                        <td align="center">{{$detail->izin_informasi->welder !=null ? $detail->izin_informasi->welder : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Fitter</td>
                                        <td>:</td>
                                        <td align="center">{{$detail->izin_informasi->fitter !=null ? $detail->izin_informasi->fitter : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tukang Bangunan</td>
                                        <td>:</td>
                                        <td align="center">{{$detail->izin_informasi->tukang_bangunan !=null ? $detail->izin_informasi->tukang_bangunan : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tukang Kayu</td>
                                        <td>:</td>
                                        <td align="center">{{$detail->izin_informasi->tukang_kayu !=null ? $detail->izin_informasi->tukang_kayu : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Lainnya</td>
                                        <td>:</td>
                                        <td align="center">{{$detail->izin_informasi->lainnya !=null ? $detail->izin_informasi->lainnya : '-'}}</td>
                                    </tr>
                                </table>
                            </div>

                        </div>
<style>
    .kecil {
        font-size: 9pt;
    }
</style>
                        <div class="row p-0 mb-3" style="page-break-before: auto; page-break-inside:avoid;">
                            <div class="col px-0 mb-1 text-uppercase" style="background-color: lightgrey; width: 95%;">
                                <b>C. Perlengkapan Pekerjaan </b>
                            </div>
                            <div class="row px-0"> 
                                <div class="col-sm-auto" style="width:19%; display:inline-block; vertical-align: top; text-align: center;">
                                    <table class="table-bordered table-sm mt-1 kecil" width="100%">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;  width: 145px; font-size: 11pt !important; padding: 0;">Alat</th>
                                            <th style="font-size: 11pt !important; padding-left: 2px; padding-right: 2px; padding-top: 0px; padding-bottom: 0px;">Jml</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{dd($alat)}} --}}
                                        @if (!empty(array_filter($alt)))
                                        @foreach ($alat[0] as $key => $alt)
                                        <tr>
                                            <td style="padding-left: 2px; padding-right: 2px; padding-top: 0px; padding-bottom: 0px;">{{$alt}}</td>
                                            <td style="padding-left: 2px; padding-right: 2px; padding-top: 0px; padding-bottom: 0px;" align="center">
                                             @if (strlen($alat[1][$key]) == 3)
                                                    {{Str::substr($alat[1][$key], 0,1)}}
                                                @elseif (strlen($alat[1][$key]) == 4)
                                                    {{Str::substr($alat[1][$key], 0,2)}}
                                                @elseif (strlen($alat[1][$key]) == 5)
                                                    {{Str::substr($alat[1][$key], 0,3)}}
                                                @else
                                                    {{$alat[1][$key]}}
                                                @endif
                                        </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="2">Tidak ada data</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-auto" style="width:19%; display:inline-block; vertical-align: top; text-align: center;">
                                    <table class="table-bordered table-sm mt-1 kecil" width="100%">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;  width: 145px; font-size: 11pt !important; padding: 0;">Mesin</th>
                                            <th style="font-size: 11pt !important; padding-left: 2px; padding-right: 2px; padding-top: 0px; padding-bottom: 0px;">Jml</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty(array_filter($msn)))
                                        @foreach ($mesin[0] as $key => $msn)
                                        <tr>
                                            <td style="padding-left: 2px; padding-right: 2px; padding-top: 0px; padding-bottom: 0px;">{{$msn}}</td>
                                            <td style="padding-left: 2px; padding-right: 2px; padding-top: 0px; padding-bottom: 0px;" align="center">
                                            @if (strlen($mesin[1][$key]) == 3)
                                                    {{Str::substr($mesin[1][$key], 0,1)}}
                                                @elseif (strlen($mesin[1][$key]) == 4)
                                                    {{Str::substr($mesin[1][$key], 0,2)}}
                                                @elseif (strlen($mesin[1][$key]) == 5)
                                                    {{Str::substr($mesin[1][$key], 0,3)}}
                                                @else
                                                    {{$mesin[1][$key]}}
                                                @endif
                                        </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="2">Tidak ada data</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-auto" style="width:19%; display:inline-block; vertical-align: top; text-align: center;">
                                    <table class="table-bordered table-sm mt-1 kecil" width="100%">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center; width: 145px; font-size: 11pt !important; padding: 0;">Material</th>
                                            <th style="font-size: 11pt !important; padding-left: 2px; padding-right: 2px; padding-top: 0px; padding-bottom: 0px;">Jml</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty(array_filter($materi)))
                                        @foreach ($material[0] as $key => $materi)
                                        <tr>
                                            <td style="padding-left: 2px; padding-right: 2px; padding-top: 0px; padding-bottom: 0px;" >{{$materi}}</td>
                                            <td style="padding-left: 2px; padding-right: 2px; padding-top: 0px; padding-bottom: 0px;" align="center">
                                            @if (strlen($material[1][$key]) == 3)
                                                    {{Str::substr($material[1][$key], 0,1)}}
                                                @elseif (strlen($material[1][$key]) == 4)
                                                    {{Str::substr($material[1][$key], 0,2)}}
                                                @elseif (strlen($material[1][$key]) == 5)
                                                    {{Str::substr($material[1][$key], 0,3)}}
                                                @else
                                                    {{$material[1][$key]}}
                                                @endif
                                        </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="2">Tidak ada data</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-auto" style="width:19%; display:inline-block; vertical-align: top; text-align: center;">
                                    <table class="table-bordered table-sm mt-1 kecil" width="100%">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;" style="white-space: nowrap;  width: 145px; font-size: 11pt !important; padding: 0;">Alat Berat</th>
                                            <th style="font-size: 11pt !important; padding-left: 2px; padding-right: 2px; padding-top: 0px; padding-bottom: 0px;">Jml</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @if (!empty(array_filter($brt)))
                                        @foreach ($alat_berat[0] as $key => $alber)
                                        <tr>
                                            <td style="padding-left: 2px; padding-right: 2px; padding-top: 0px; padding-bottom: 0px;">{{$alber}}</td>
                                            <td style="padding-left: 2px; padding-right: 2px; padding-top: 0px; padding-bottom: 0px;" align="center">
                                            @if (strlen($alat_berat[1][$key]) == 3)
                                                    {{Str::substr($alat_berat[1][$key], 0,1)}}
                                                @elseif (strlen($alat_berat[1][$key]) == 4)
                                                    {{Str::substr($alat_berat[1][$key], 0,2)}}
                                                @elseif (strlen($alat_berat[1][$key]) == 5)
                                                    {{Str::substr($alat_berat[1][$key], 0,3)}}
                                                @else
                                                    {{$alat_berat[1][$key]}}
                                                @endif
                                        </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="2">Tidak ada data</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3 px-0" style="page-break-before: auto; page-break-inside:avoid;">
                            <div class="col px-0">
                                <div class="col px-0 mb-1 text-uppercase" style="background-color: lightgrey; width: 95%;">
                                    <b class="px-0">D. Keselamatan Kerja</b>
                                </div>
                                <div class="pl-3">Tindakan : {{$detail->biaya}} </div>
                                <table class="table-bordered table-sm">
                                    <tr>
                                        <th>Aktivitas</th>
                                        <th>Potensi Bahaya</th>
                                        <th>Langkah Aman Pekerjaan</th>
                                    </tr>
                                    @foreach($selamat as $selamat)
                                    <tr>
                                        <td>{{$selamat->aktivitas}}</td>
                                        <td>{{$selamat->potensi_bahaya}}</td>
                                        <td>{{$selamat->langkah_aman}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="row p-0 mb-3" style="page-break-before: auto; page-break-inside:avoid;" >
                            <div class="col px-0 mb-1 text-uppercase" style="background-color: lightgrey; width: 95%;">
                                <b class="px-0 py-2">E. Peralatan Keselamatan</b> 
                            </div>
                            <div class="col px-0"> 
                                
                                <div class="col-sm-auto px-0" style="width: 250px; display:inline-block; vertical-align: top; text-align: center;">
                                <table class="table-bordered table-sm" width="100%">
                                    <tr>
                                        <th>Alat Pelindung Diri</th>
                                    </tr>
                                    @foreach(explode(',',$detail->izin_peralatan->pelindung_diri) as $pdiri)
                                    <tr>
                                        <td>{{$pdiri}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-sm-auto px-0" style="width: 250px; display:inline-block; vertical-align: top; text-align: center; margin-left:-25px;">
                                <table class="table-bordered table-sm" width="100%">
                                    <tr>
                                        <th>Perlengkapan Keselamatan</th>
                                    </tr>
                                    @foreach(explode(',',$detail->izin_peralatan->perlengkapan) as $lengkap)
                                    <tr>
                                        <td>{{$lengkap}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            </div>
                        </div>

                    @if (($detail->izin_validasi->mulai_granted  || $detail->izin_validasi->mulai_denied) != null)
                    <div class="row p-0 mb-3" style="page-break-before: auto; page-break-inside:avoid;">
                        <div class="col px-0 mb-1 text-uppercase" style="background-color: lightgrey; width: 95%;">
                            <b class="px-0">F. Izin Validasi</b> 
                        </div>
                        <div class="col-sm-auto px-0">
                                <table class="table-sm table-bordered" width="95%">
                                    <tr style="text-align: center; vertical-align: middle;" >
                                    @if($detail->izin_validasi->mulai_granted != null)
                                        <th style=" padding: 0px;" colspan="4">Izin Diberikan</th>
                                    @endif
                                    @if($detail->izin_validasi->mulai_denied != null)
                                        <th style=" padding: 0px;" colspan="4">Izin Ditolak</th>
                                    @endif
                                    </tr>

                                    <tr>
                                        @if($detail->izin_validasi->mulai_granted != null)
                                        <td style="width: 25%;">Mulai</td>
                                        <td style="text-align: left; width: 25%" class="text-capitalize">
                                            {{Carbon\Carbon::parse($detail->izin_validasi->mulai_granted)->isoFormat('DD MMMM YYYY')}} <br>
                                            Pukul {{Carbon\Carbon::parse($detail->izin_validasi->mulai_granted)->isoFormat(' HH:mm')}} WIB
                                        </td>
                                        <td style="width: 25%;"><b>Nama Pemeriksa</b><br/> Tanggal Pemeriksaan</td>
                                        <td style="vertical-align: middle; text-align: left; width: 25%">
                                            {{$detail->izin_validasi->nm_pmrks_granted}} <br>
                                            {{$detail->izin_validasi->tgl_pmrks_granted != null ? \Carbon\Carbon::parse($detail->izin_validasi->tgl_pmrks_granted)->isoFormat("DD MMMM YYYY") : ""}}
                                        </td>
                                        @endif

                                    @if($detail->izin_validasi->mulai_denied != null)
                                        <td style="width: 25%;">Mulai</td>
                                        <td style="text-align: left; width: 25%">
                                            -
                                        </td>
                                        <td style="width: 25%;"><b>Nama Pemeriksa</b><br/> Tanggal Pemeriksaan</td>
                                        <td style="vertical-align: middle; text-align: left; width: 25%">
                                            {{$detail->izin_validasi->nm_pmrks_denied}} <br>
                                            {{$detail->izin_validasi->tgl_pmrks_denied != null ? \Carbon\Carbon::parse($detail->izin_validasi->tgl_pmrks_denied)->isoFormat("DD MMMM YYYY") : ""}}
                                        </td>
                                    @endif
                                    </tr>

                                    <tr>
                                        @if($detail->izin_validasi->mulai_granted != null)
                                        <td style="width: 25%;">Sampai</td>
                                        <td style="text-align: left; width: 25%">
                                            {{Carbon\Carbon::parse($detail->izin_validasi->sampai_granted)->isoFormat('DD MMMM YYYY')}} <br>
                                            Pukul {{Carbon\Carbon::parse($detail->izin_validasi->sampai_granted)->isoFormat(' HH:mm')}} WIB
                                        </td>
                                        <td style="width: 25%;"><b>Nama Pengawas </b><br/>Tanggal Pengawasan</td>
                                        <td style="vertical-align: middle; text-align: left; width: 25%">
                                            {{$detail->izin_validasi->nm_pngws_granted}} <br>
                                            {{$detail->izin_validasi->tgl_pngws_granted != null ? \Carbon\Carbon::parse($detail->izin_validasi->tgl_pngws_granted)->isoFormat("DD MMMM YYYY") : ""}}
                                        </td>
                                        @endif
                                    @if($detail->izin_validasi->mulai_denied != null)
                                        <td style="width: 25%;">Sampai</td>
                                        <td style="text-align: left; width: 25%">
                                            -
                                        </td>
                                        <td style="width: 25%;"><b>Nama Pengawas</b><br/>Tanggal Pengawasan</td>
                                        <td  style="vertical-align: middle; text-align: left; width: 25%">
                                            -
                                        </td>
                                    @endif
                                    </tr>



                                    <tr>
                                        @if($detail->izin_validasi->mulai_granted != null)
                                        <td style="width: 25%%;"><b>Nama Pemohon</b><br/> Tanggal Permohonan</td>
                                        <td style="vertical-align: middle; text-align: left; width: 25%">
                                            {{$detail->izin_validasi->nm_pmhn_granted}} <br>
                                            {{$detail->izin_validasi->tgl_pmhn_granted != null ? \Carbon\Carbon::parse($detail->izin_validasi->tgl_pmhn_granted)->isoFormat("DD MMMM YYYY") : ""}}
                                        </td>
                                        @endif
                                    @if($detail->izin_validasi->mulai_denied != null)
                                        <td style="width: 25%%;"><b>Nama Pemohon</b><br/> Tanggal Permohonan</td>
                                        <td style="vertical-align: middle; text-align: left; width: 25%">
                                            {{$detail->izin_validasi->nm_pmhn_denied}} <br>
                                            {{$detail->izin_validasi->tgl_pmhn_denied != null ? \Carbon\Carbon::parse($detail->izin_validasi->tgl_pmhn_denied)->isoFormat("DD MMMM YYYY") : ""}}
                                        </td>
                                    @endif
                                    <td colspan="2" rowspan="" ="2" style="word-break: break-word; width: 250px; vertical-align: top !important;">Keterangan : <br>{{$detail->izin_validasi->ket}}</td>
                                    </tr>


                                </table>
                            </div>
                    </div>


                    @endif
                    </div>
                    <div class="px-0" style="page-break-before: auto; page-break-inside:avoid;">
                    <table width="98%" border="0" style="vertical-align: middle; text-align: center;">
                        <tr>
                            <td width="30%"><pre class="narrow">
Mengetahui,
{{$otor->jabatan}}

<img src="data:image/png;base64, {!! $qrcode !!}" >
<b>{{$otor->nama}}</b>
<font style="font-size: 10pt;">NIP. {{$otor->nip}} </font></pre>
                        </td>
<td width="33%" style="vertical-align: top;">Jakarta, {{Carbon\Carbon::parse($detail->izin_validasi->created_at)->isoFormat('D MMMM Y')}}</td>
                        <td width="33%" style="vertical-align: top;"><pre class="narrow">
Divalidasi Oleh,


<img src="data:image/png;base64, {!! $qrcode2 !!}" >
<b>{{Auth::user()->name}}</b>
<font style="font-size: 10pt;"><i>{{Auth::user()->unit_kerja}}</i></font></pre>
                        </td>
                        </tr>
                    </table>
</div>
</body>
    </html>