@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header fw-bold text-uppercase">{{ __('SURAT IZIN PEKERJAAN RISIKO '.$detail->risiko) }}
                    <a href="{{ route('izin_kerja') }}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
                    @if(Auth::user()->unit_kerja == "Health, Safety, & Environment" || Auth::user()->unit_kerja == "Security Monitoring Center" || Auth::user()->role == "admin")
                        @if($otorized != null)
                            @if($detail->otorizedby != null && $detail->validatedby != null)
                            @elseif($detail->validatedby != null)
                                <span class="btn btn-sm btn-success float-end p-1" onclick="return oto()" style="cursor: pointer;">Otorisasi</span>
                                <script>
                                    function oto() {                              
                                        Swal.fire({
                                              title: "Otorisasi Dokumen",
                                              icon: "warning",
                                              showCancelButton: true,
                                              confirmButtonColor: "#3085d6",
                                              cancelButtonColor: "#d33",
                                              confirmButtonText: "Otorisasi",
                                              cancelButtonText: "Batal"
                                            }).then((result) => {
                                              if (result.isConfirmed) {
                                                window.location='{{url('/layanan/detail/otorisasi/'.$detail->izin_id.'/'.$otorized->id)}}'
                                              }
                                            });
                                        }
                                </script>
                            @endif
                        @else
                            @if($detail->validatedby == null)
                            <span class="btn btn-sm btn-success float-end p-1" onclick="window.location='{{url('izin-validasi')}}/{{$detail->izin_id}}'" style="cursor: pointer;">Validasi</span>
                            @endif
                        @endif
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

@if (session('sukses'))
    <script type="text/javascript">
        Swal.fire({
          icon: "success",
          title: "{{ session('sukses') }}",
          showConfirmButton: false,
          timer: 1500
        });
    </script>
@endif
                <div class="card-body">
                    Nomor Dokumen : {{$detail->izin_id}} <br>


<style type="text/css">
    table, th, tr, td {
        padding-left: 10px;
        padding-right: 10px;
    }
    .td {
        white-space: nowrap;
    }
</style>
                    <div class="col" style="overflow-y: none;overflow-x: auto;">
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
                                        <td class="td">Perusahaan Pemohon</td>
                                        <td>
                                    @if ('Lainnya ' == Str::substr($detail->izin_informasi->perusahaan_pemohon, 0,8))
                                        {{Str::substr($detail->izin_informasi->perusahaan_pemohon, 8,1000)}}
                                    @else
                                        {{$detail->izin_informasi->perusahaan_pemohon}}
                                    @endif
                                        </td>


                                    </tr>
                                    <tr>
                                        <td>Pekerjaan</td>
                                        <td>{{$detail->izin_informasi->pekerjaan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi</td>
                                        <td>{{$detail->izin_informasi->lokasi}}</td>
                                    </tr>
                                    <tr>
                                        <td>Area/Lantai</td>
                                        <td>{{$detail->izin_informasi->area}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ruangan</td>
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

                    @if ($detail->izin_informasi->ktp != null)
                    <div class="row p-0 mb-3">
                        <div class="col-sm-auto px-0">
                            <center>
                                <table class="table-sm">
                                    <tr>
                    <td style="text-align: center;" colspan="3"><b>Foto KTP Pekerja: </b>
                            <p></p>
                            
                    @foreach(explode('|',$detail->izin_informasi->ktp) as $ktp)
                    <img  src="{{asset('storage/izin_kerja')}}/{{$detail->izin_id}}/{{$ktp}}" style="width:280px; margin-bottom: 5pt"> &nbsp;
                    @endforeach
                        
                        
                        </td>
                    
                                    </tr>
                        </table>
                            </center>
                    </div>
                </div>
@endif
{{-- {{dd( 214800 <= 220000 )}} --}}
    @if(Auth::user()->unit_kerja == "Health, Safety, & Environment" || Auth::user()->unit_kerja == "Security Monitoring Center" || Auth::user()->role == "admin")
        {{-- @if ( Carbon\Carbon::now()->isoFormat('HHmmss') >= 235959 || Carbon\Carbon::now()->isoFormat('HHmmss') <= 90000) --}}
{{-- yang ini buat jam 00.00 sampai 9 pagi --}}
        @if (Carbon\Carbon::now()->isoFormat('HHmmss') <= 90000) {{-- 23.59 - jam 09.00--}}

            @if($detail->otorizedby != null && $detail->validatedby != null)
                <div align="center" >
                    <a target="_blank" href="/izin-downloadPDF/{{$detail->id}}/{{$detail->otorizedby}}/{{$detail->validatedby}}"><button class="btn btn-primary btn-sm float-center">Download PDF</button></a>
                </div>
            @elseif($detail->otorizedby == null && $detail->validatedby == null)
                <div align="center" class="mb-2">
                    <span class="bg-danger text-white rounded fw-bold py-1 px-2">Dokumen belum di Otorisasi dan di Validasi</span>
                </div>
            @elseif($detail->validatedby != null && $otorized == true)
                <div align="center" class="mb-2">
                   <span class="bg-success text-white rounded fw-bold py-1 px-2">Dokumen telah di Validasi</span>
                </div>
           {{-- @elseif($detail->validatedby != null)
                <div align="center" class="mb-2">
                   <a target="_blank" href="https://wa.me/62811163361?text=Halo%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20terkait%20dokumen%20kami%20dengan%20nomor%20laporan%20{{$detail->izin_id}}.%20Terima%20Kasih.%0A%0Ahttp%3A%2F%2Fwww.sispam.id%2Fizin-detail%2F{{$detail->id}}"><span class="bg-success text-white rounded fw-bold py-1 px-2">Nanang Ariantox</span></a>
                   <a target="_blank" href="https://wa.me/628128051226?text=Halo%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20terkait%20dokumen%20kami%20dengan%20nomor%20laporan%20{{$detail->izin_id}}.%20Terima%20Kasih.%0A%0Ahttp%3A%2F%2Fwww.sispam.id%2Fizin-detail%2F{{$detail->id}}"><span class="bg-success text-white rounded fw-bold py-1 px-2">Tomi Hartonox</span></a>
                   <a target="_blank" href="https://wa.me/6281253005354?text=Halo%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20terkait%20dokumen%20kami%20dengan%20nomor%20laporan%20{{$detail->izin_id}}.%20Terima%20Kasih.%0A%0Ahttp%3A%2F%2Fwww.sispam.id%2Fizin-detail%2F{{$detail->id}}"><span class="bg-success text-white rounded fw-bold py-1 px-2">Budi Murtopox</span></a>
                </div> --}}

              {{--    <div align="center">
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

                        $("#unduh").on('click', function() {
                             setTimeout(function(){
                               window.location.reload(1);
                            }, 3000);
                        })
                });
                </script>  --}}

            @endif

        @else 
{{-- yang ini buat jam 9 pagi sampe jam 12 malam --}}
            @if($detail->otorizedby != null && $detail->validatedby != null)
                <div align="center">
                    <a target="_blank" href="/izin-downloadPDF/{{$detail->id}}/{{$detail->otorizedby}}/{{$detail->validatedby}}"><button class="btn btn-primary btn-sm float-center ml-2">Download PDF</button></a>
                </div>{{-- 
            @elseif($detail->otorizedby)
                <div align="center" class="mb-2">
                   <span class="bg-success text-white rounded fw-bold py-1 px-2">Dokumen telah di Otorisasi</span>
                </div> --}}
            @elseif($detail->validatedby != null)
                @if($otorized == true)
                <div align="center" class="mb-2">
                   <span class="bg-success text-white rounded fw-bold py-1 px-2">Dokumen telah di Validasi</span>
                </div>
                @else
                    @if(Carbon\Carbon::now()->isoFormat('HHmmss') <= 160000)
                        <div align="center" class="mb-2">
                           <a target="_blank" href="https://wa.me/62811163361?text=Assalamualaikum%20Pak%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20pada%20dokumen%20izin%20kerja%20dengan%20nomor%20{{$detail->izin_id}}.%20Terima%20Kasih.%0A%0Ahttps%3A%2F%2Fwww.sispam.id%2Fizin-detail%2F{{$detail->id}}"><span class="bg-success text-white rounded fw-bold py-1 px-2">Nanang Arianto</span></a>
                           <a target="_blank" href="https://wa.me/628128051226?text=Assalamualaikum%20Pak%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20pada%20dokumen%20izin%20kerja%20dengan%20nomor%20{{$detail->izin_id}}.%20Terima%20Kasih.%0A%0Ahttps%3A%2F%2Fwww.sispam.id%2Fizin-detail%2F{{$detail->id}}"><span class="bg-success text-white rounded fw-bold py-1 px-2">Tomi Hartono</span></a>
                           <a target="_blank" href="https://wa.me/6281253005354?text=Assalamualaikum%20Pak%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20pada%20dokumen%20izin%20kerja%20dengan%20nomor%20{{$detail->izin_id}}.%20Terima%20Kasih.%0A%0Ahttps%3A%2F%2Fwww.sispam.id%2Fizin-detail%2F{{$detail->id}}"><span class="bg-success text-white rounded fw-bold py-1 px-2">Budi Murtopo</span></a>
                        </div>
                    @elseif(Carbon\Carbon::now()->isoFormat('HHmmss') >= 160001)
                        <div align="center" class="mb-2">

                           <a target="_blank" href="https://wa.me/628128051226?text=Assalamualaikum%20Pak%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20pada%20dokumen%20izin%20kerja%20dengan%20nomor%20{{$detail->izin_id}}.%20Terima%20Kasih.%0A%0Ahttps%3A%2F%2Fwww.sispam.id%2Fizin-detail%2F{{$detail->id}}"><span class="bg-success text-white rounded fw-bold py-1 px-2">Tomi Hartono</span></a>

                        </div>
                    @endif
                @endif
            @elseif($detail->otorizedby == null && $detail->validatedby == null)
                <div align="center" class="mb-2">
                    <span class="bg-danger text-white rounded fw-bold py-1 px-2">Dokumen belum di Otorisasi dan di Validasi</span>
                </div>
{{--             @elseif($detail->otorizedby == null)
                <div align="center" class="mb-2">
                   <span class="bg-danger text-white rounded fw-bold py-1 px-2">Dokumen belum di Otorisasi</span>
                </div>
            @elseif($detail->validatedby == null)
                <div align="center" class="mb-2">
                   <span class="bg-danger text-white rounded fw-bold py-1 px-2">Dokumen belum di Validasi</span>
                </div> --}}
            @endif

        @endif
    @endif
                    </div>
                </div>
                 {{-- <div align="center" class="my-2"> <a href="{{url('izin-downloadPDF')}}/{{$detail->id}}" target="_blank"> <span class="btn btn-primary">Download Dokumen</span></a></div> --}}


            </div>

        </div>
    </div>
</div>

@endsection
