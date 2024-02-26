@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header fw-bold text-uppercase">{{ __('SURAT IZIN PEKERJAAN RISIKO '.$detail->risiko) }}
                    <a href="{{ route('izin_kerja') }}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
                    @if(Auth::user()->unit_kerja == "Health, Safety, & Environment" || Auth::user()->unit_kerja == "Security Monitoring Center" || Auth::user()->role == "admin")
                    <span class="btn btn-sm btn-success float-end p-1" onclick="window.location='{{url('izin-validasi')}}/{{$detail->izin_id}}'" style="cursor: pointer;">Validasi</span>
                    @endif
                </div>
@if (session('abort'))
<script type="text/javascript">
    Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "{{session('abort')}}",
});
</script>
@endif
                <div class="card-body">
                    Nomor Dokumen : {{$detail->izin_id}} <br>
                    {{-- Nomor : {{$detail->no_dok}}/IK/{{$detail->izin_informasi->perusahaan_pemohon}}/{{$romawi}}/{{Carbon\Carbon::parse($detail->created_at)->isoFormat('YYYY')}} --}}

<style type="text/css">
    table, th, tr, td {
        padding-left: 10px;
        padding-right: 10px;
    }
    .td {
        white-space: nowrap;
    }
</style>
                    <div class="col" style="overflow: auto;">
                        <div class="row p-0 mb-3">
                            <div class="col px-0">
                           <b> A. Klasifikasi Pekerjaan </b>
                            <table>
                                <tr>
                                    <td>@foreach(explode(',',$detail->klasifikasi) as $value)
                                        {{$value}} <br>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                        </div>
                        </div>

                        <div class="row p-0 mb-3">
                            <div class="col-sm-auto px-0">
                                <b>B. Informasi Pekerjaan</b>
                                <table class="table-sm table-bordered" width="auto">

                                    <tr>
                                        <td>Pekerjaan</td>
                                        <td>{{$detail->izin_informasi->pekerjaan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi</td>
                                        <td>{{$detail->izin_informasi->lokasi}}</td>
                                    </tr>
                                    <tr>
                                        <td>Area</td>
                                        <td>{{$detail->izin_informasi->area}}</td>
                                    </tr>
                                    <tr>
                                        <td>Plant</td>
                                        <td>{{$detail->izin_informasi->plant!=null ? $detail->izin_informasi->plant : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Nama Manager</td>
                                        <td>{{$detail->izin_informasi->manager}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Nama Pemohon</td>
                                        <td>{{$detail->izin_informasi->pemohon}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Telepon Pemohon</td>
                                        <td>{{$detail->izin_informasi->tel_pemohon}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pengawas</td>
                                        <td>{{$detail->izin_informasi->pengawas}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Telepon Pengawas</td>
                                        <td>{{$detail->izin_informasi->tel_pengawas}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Petugas K3</td>
                                        <td>{{$detail->izin_informasi->k3!=null ? $detail->izin_informasi->k3 : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Telepon Petugas K3</td>
                                        <td>{{$detail->izin_informasi->tel_k3!=null ? $detail->izin_informasi->tel_k3 : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Perusahaan Pemohon</td>
                                        <td>{{$detail->izin_informasi->perusahaan_pemohon}}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-sm-auto px-0">
                                <table class="table-sm table-bordered mt-4" width="auto">
                                    <tr>
                                        <td>Daftar Pekerja</td>
                                        <td align="center">{{$detail->izin_informasi->pekerja!=null ? $detail->izin_informasi->pekerja : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Enginer</td>
                                        <td align="center">{{$detail->izin_informasi->enginer!=null ? $detail->izin_informasi->enginer : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Surveyor</td>
                                        <td align="center">{{$detail->izin_informasi->surveyor!=null ? $detail->izin_informasi->surveyor : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Operator_alat</td>
                                        <td align="center">{{$detail->izin_informasi->operator_alat!=null ? $detail->izin_informasi->operator_alat : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Rigger</td>
                                        <td align="center">{{$detail->izin_informasi->rigger!=null ? $detail->izin_informasi->rigger : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Teknisi Elektrik</td>
                                        <td align="center">{{$detail->izin_informasi->teknisi_elektrik!=null ? $detail->izin_informasi->teknisi_elektrik : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Mekanik</td>
                                        <td align="center">{{$detail->izin_informasi->mekanik!=null ? $detail->izin_informasi->mekanik : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Welder</td>
                                        <td align="center">{{$detail->izin_informasi->welder!=null ? $detail->izin_informasi->welder : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Fitter</td>
                                        <td align="center">{{$detail->izin_informasi->fitter!=null ? $detail->izin_informasi->fitter : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tukang Bangunan</td>
                                        <td align="center">{{$detail->izin_informasi->tukang_bangunan!=null ? $detail->izin_informasi->tukang_bangunan : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tukang Kayu</td>
                                        <td align="center">{{$detail->izin_informasi->tukang_kayu!=null ? $detail->izin_informasi->tukang_kayu : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Lainnya</td>
                                        <td align="center">{{$detail->izin_informasi->lainnya!=null ? $detail->izin_informasi->lainnya : '-'}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row p-0 mb-3">
                            <div class="row px-0 justify-content-around"> 
                                <b>C. Perlengkapan Pekerjaan </b>
                                <div class="col-sm-auto">
                                    <table class="table-bordered table-sm mt-1" width="100%">
                                        <tr>
                                            <th>Alat</th>
                                            <th>Jumlah</th>
                                        </tr>
                                        {{-- {{dd($alat)}} --}}
                                        @if (!empty(array_filter($alt)))
                                        @foreach ($alat[0] as $key => $alt)
                                        <tr>
                                            <td>{{$alt}}</td>
                                            <td align="center">
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
                                    </table>
                                </div>
                                <div class="col-sm-auto">
                                    <table class="table-bordered table-sm mt-1" width="100%">
                                        <tr>
                                            <th>Mesin</th>
                                            <th>Jumlah</th>
                                        </tr>
                                        @if (!empty(array_filter($msn)))
                                        @foreach ($mesin[0] as $key => $msn)
                                        <tr>
                                            <td>{{$msn}}</td>
                                            <td align="center">
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
                                    </table>
                                </div>
                                <div class="col-sm-auto">
                                    <table class="table-bordered table-sm mt-1" width="100%">
                                        <tr>
                                            <th>Material</th>
                                            <th>Jumlah</th>
                                        </tr>
                                        @if (!empty(array_filter($materi)))
                                        @foreach ($material[0] as $key => $materi)
                                        <tr>
                                            <td>{{$materi}}</td>
                                            <td align="center">
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
                                    </table>
                                </div>
                                <div class="col-sm-auto">
                                    <table class="table-bordered table-sm mt-1" width="100%">
                                        <tr>
                                            <th>Alat Berat</th>
                                            <th>Jumlah</th>
                                        </tr>
                                         @if (!empty(array_filter($brt)))
                                        @foreach ($alat_berat[0] as $key => $alber)
                                        <tr>
                                            <td>{{$alber}}</td>
                                            <td align="center">
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
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col px-0">
                                <b>D. Keselamatan Kerja</b>
                                <div>Tindakan : {{$detail->biaya}} </div>
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

                        <div class="row p-0 mb-3">
                            <div class="row  "> 
                                <b class="px-0">E. Peralatan Keselamatan</b> 
                                
                                <div class="col-sm-auto px-0">
                                <table class="table-bordered table-sm">
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
                            <div class="col-sm-auto px-0">
                                <table class="table-bordered table-sm">
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
                    @if (($detail->izin_validasi->mulai_granted || $detail->izin_validasi->mulai_denied) != null)
                    <div class="row p-0 mb-3">
                        <b class="px-0">F. Izin Validasi</b> 
                        <div class="col-sm-auto px-0">
                                <table class="table-sm table-bordered ">
                                    <tr align="center" >
                                    @if($detail->izin_validasi->mulai_granted != null)
                                        <th style="vertical-align: middle;" colspan="2">Izin Diberikan</th>
                                    @endif
                                    @if($detail->izin_validasi->mulai_denied != null)
                                        <th style="vertical-align: middle;" colspan="2">Izin Dibatalkan</th>
                                    @endif
                                    </tr>

                                    <tr>
                                        @if($detail->izin_validasi->mulai_granted != null)
                                        <td>Mulai</td>
                                        <td style="text-align: center;" class="text-capitalize">
                                            {{Carbon\Carbon::parse($detail->izin_validasi->mulai_granted)->isoFormat('DD MMMM YYYY')}} <br>
                                            {{Carbon\Carbon::parse($detail->izin_validasi->mulai_granted)->isoFormat(' HH:mm')}} WIB
                                        </td>
                                        @endif
                                    @if($detail->izin_validasi->mulai_denied != null)
                                        <td>Mulai</td>
                                        <td style="text-align: center;">
                                            {{Carbon\Carbon::parse($detail->izin_validasi->mulai_denied)->isoFormat('DD MMMM YYYY')}} <br>
                                            {{Carbon\Carbon::parse($detail->izin_validasi->mulai_denied)->isoFormat(' HH:mm')}} WIB
                                        </td>
                                    @endif
                                    </tr>
                                    <tr>
                                        @if($detail->izin_validasi->mulai_granted != null)
                                        <td>Sampai</td>
                                        <td style="text-align: center;">
                                            {{Carbon\Carbon::parse($detail->izin_validasi->sampai_granted)->isoFormat('DD MMMM YYYY')}} <br>
                                            {{Carbon\Carbon::parse($detail->izin_validasi->sampai_granted)->isoFormat(' HH:mm')}} WIB
                                        </td>
                                        @endif
                                    @if($detail->izin_validasi->mulai_denied != null)
                                        <td>Sampai</td>
                                        <td style="text-align: center;">
                                            {{Carbon\Carbon::parse($detail->izin_validasi->sampai_denied)->isoFormat('DD MMMM YYYY')}} <br>
                                            {{Carbon\Carbon::parse($detail->izin_validasi->sampai_denied)->isoFormat(' HH:mm')}} WIB
                                        </td>
                                    @endif
                                    </tr>
                                    <tr>
                                        @if($detail->izin_validasi->mulai_granted != null)
                                        <th>Nama Pemohon</th>
                                        <td rowspan="2" style="vertical-align: middle; text-align: center;">
                                            {{$detail->izin_validasi->nm_pmhn_granted}} <br>
                                            {{$detail->izin_validasi->tgl_pmhn_granted != null ? \Carbon\Carbon::parse($detail->izin_validasi->tgl_pmhn_granted)->isoFormat("DD MMMM YYYY") : ""}}
                                        </td>
                                        @endif
                                    @if($detail->izin_validasi->mulai_denied != null)
                                        <th>Nama Pemohon</th>
                                        <td rowspan="2" style="vertical-align: middle; text-align: center;">
                                            {{$detail->izin_validasi->nm_pmhn_denied}} <br>
                                            {{$detail->izin_validasi->tgl_pmhn_denied != null ? \Carbon\Carbon::parse($detail->izin_validasi->tgl_pmhn_denied)->isoFormat("DD MMMM YYYY") : ""}}
                                        </td>
                                    @endif
                                    </tr>
                                    <tr>
                                        @if($detail->izin_validasi->mulai_granted != null)
                                        <td>Tanggal Permohonan</td>
                                        @endif
                                    @if($detail->izin_validasi->mulai_denied != null)
                                        <td>Tanggal Permohonan</td>
                                    @endif
                                    </tr>
                                    <tr>
                                        @if($detail->izin_validasi->mulai_granted != null)
                                        <th>Nama Pemeriksa</th>
                                        <td rowspan="2" style="vertical-align: middle; text-align: center;">
                                            {{$detail->izin_validasi->nm_pmrks_granted}} <br>
                                            {{$detail->izin_validasi->tgl_pmrks_granted != null ? \Carbon\Carbon::parse($detail->izin_validasi->tgl_pmrks_granted)->isoFormat("DD MMMM YYYY") : ""}}
                                        </td>
                                        @endif

                                    @if($detail->izin_validasi->mulai_denied != null)
                                        <th>Nama Pemeriksa</th>
                                        <td rowspan="2" style="vertical-align: middle; text-align: center;">
                                            {{$detail->izin_validasi->nm_pmrks_denied}} <br>
                                            {{$detail->izin_validasi->tgl_pmrks_denied != null ? \Carbon\Carbon::parse($detail->izin_validasi->tgl_pmrks_denied)->isoFormat("DD MMMM YYYY") : ""}}
                                        </td>
                                    @endif
                                    </tr>
                                    <tr>
                                        @if($detail->izin_validasi->mulai_granted != null)
                                        <td>Tanggal Pemeriksaan</td>
                                        @endif
                                    @if($detail->izin_validasi->mulai_denied != null)
                                        <td>Tanggal Pemeriksaan</td>
                                    @endif
                                    </tr>
                                    <tr>
                                        @if($detail->izin_validasi->mulai_granted != null)
                                        <th>Nama Pengawas</th>
                                        <td rowspan="2" style="vertical-align: middle; text-align: center;">
                                            {{$detail->izin_validasi->nm_pngws_granted}} <br>
                                            {{$detail->izin_validasi->tgl_pngws_granted != null ? \Carbon\Carbon::parse($detail->izin_validasi->tgl_pngws_granted)->isoFormat("DD MMMM YYYY") : ""}}
                                        </td>
                                        @endif
                                    @if($detail->izin_validasi->mulai_denied != null)
                                        <th>Nama Pengawas</th>
                                        <td rowspan="2" style="vertical-align: middle; text-align: center;">
                                            {{$detail->izin_validasi->nm_pngws_denied}} <br>
                                            {{$detail->izin_validasi->tgl_pngws_denied != null ? \Carbon\Carbon::parse($detail->izin_validasi->tgl_pngws_denied)->isoFormat("DD MMMM YYYY") : ""}}
                                        </td>
                                    @endif
                                    </tr>
                                    <tr>
                                        @if($detail->izin_validasi->mulai_granted != null)
                                        <td>Tanggal Pengawasan</td>
                                        @endif
                                    @if($detail->izin_validasi->mulai_denied != null)
                                        <td>Tanggal Pengawasan</td>
                                    @endif
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="word-break: break-word; width: 250px;">Keterangan : <br>{{$detail->izin_validasi->ket}}</td>
                                    </tr>
                                </table>
                            </div>
                    </div>
                    @endif
@if(Auth::user()->unit_kerja == "Health, Safety, & Environment" || Auth::user()->unit_kerja == "Security Monitoring Center" || Auth::user()->role == "admin")
                                <div align="center">
                                    <select id="otorisasi"  required>
                                        <option value="" selected>:: Pilih Otorisasi ::</option>
                                        @foreach ($otor as $key => $oto)
                                        <option value="{{$oto->id}}">{{$oto->nama}}</option>
                                        @endforeach
                                    </select>
                                <a id="link" target="_blank"><button id="unduh" class="btn btn-primary btn-sm float-center ml-2" disabled>Download PDF</button></a>
                                </div>
        <script>
            $("#otorisasi").change(function() {
                console.log($("#otorisasi option:selected").val());
                if ($("#otorisasi option:selected").val() == '') {
                    $("#unduh").prop("disabled", true);
                    $('#link').removeAttr("href");
                } else {
                    $('#link').attr("href", "/izin-downloadPDF/{{$detail->id}}/"+this.value);
                    $("#unduh").prop("disabled", false); 
                }
        });
        </script>
                @endif
                    </div>
                </div>
                 {{-- <div align="center" class="my-2"> <a href="{{url('izin-downloadPDF')}}/{{$detail->id}}" target="_blank"> <span class="btn btn-primary">Download Dokumen</span></a></div> --}}


            </div>

        </div>
    </div>
</div>

@endsection
