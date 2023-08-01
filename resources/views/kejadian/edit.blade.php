@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Edit Laporan Insiden / Kejadian') }}
                    <a href="{{url('kejadian-detil')}}/{{$edit->no_lap}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

                </div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
                <div class="card-body overflow " style="overflow-x: auto;">
<style>
.containerx {
  position: relative;
  width: 25%;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.containerx:hover .image {
  opacity: 0.3;
}

.containerx:hover .middle {
  opacity: 1;
}

.text {
  color: black;
  font-size: 24px;
  padding: auto;
}
</style>
                        <style>
                            .table tr td {
                            word-wrap: break-word;
                            vertical-align: middle;
                            white-space: nowrap;
                            padding:1px !important;    
                            }
                        </style>
                        <!-- Error Handle -->
        @if ($errors->any())
            <div id="timeout" class="alert alert-danger flex flex-col md:justify-between" style="width: 80%; margin: 0 auto;">
                <div class="col-md-auto">
                        <div style="float: right;">
                            <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close" align="right"></button>
                        </div>                
                    </div>
                            @foreach ($errors->all() as $error)
                <div class="row">
                    <div class="col">
                        <div class="card-text" align="center">
                            {{ $error }} 
                        </div>
                    </div>
                </div>
                    @endforeach
            </div>
        @endif

                        <!-- Notifikasi -->
                            @if ($message = Session::get('berhasil'))
                                <div id="timeout" align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
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
                            @endif
{{-- <script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
 --}}

                    <!-- form input personil -->
                        <form action="{{url('kejadian-update')}}/{{$edit->id}}" method="post" id="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                        <div align="right" class="form-group mb-1">
                            <span class="btn btn-secondary btn-sm" id="set" >Reset</span>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Jenis Kejadian</label>
                            {{-- <input type="text" class="form-control form-control-sm px-1 m-0" name="jns_kejadian" value="{{old ('jns_kejadian')}}" required> --}}
                            <select class="form-select pb-0 pt-0 text-capitalize" id="jenis_kejadian" name="jenis_kejadian" required>
                                <option value="" selected disabled>Jenis Kejadian</option>
                                <option value="Kecelakaan Kerja" {{ 'Kecelakaan Kerja' == $edit->jenis_kejadian ? 'selected' : '' }}>Kecelakaan Kerja</option>
                                <option value="Keadaan Darurat" {{ 'Keadaan Darurat' == $edit->jenis_kejadian ? 'selected' : '' }}>Keadaan Darurat</option>
                                <option value="Unjuk Rasa" {{ 'Unjuk Rasa' == $edit->jenis_kejadian ? 'selected' : '' }}>Unjuk Rasa</option>
                                <option value="Lain-lain :" {{ 'Lain-lain :' == Str::substr($edit->jenis_kejadian, 0,11) ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                        <input type="text" id="jenis" class="form-control form-control-sm px-1 mt-1" name="jenis_kejadian" value="{{Str::substr($edit->jenis_kejadian, 12,1000)}}" hidden>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Lokasi Kejadian</label>
                            <select class="form-select pb-0 pt-0 text-capitalize" id="lokasi_kejadian" name="lokasi_kejadian" required>
                                <option value="{{$id[0]->id}}">{{$edit->site->nama_gd}}</option>
                                @foreach($site as $item)
                                <option value="{{$item->id}}">{{$item->nama_gd}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Waktu Kejadian</label>
                            <input type="date" class="form-control form-control-sm px-1" name="waktu_kejadian" value="{{ $edit->waktu_kejadian }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Jam Kejadian</label>
                            <input type="time" id="" placeholder="Time" class="form-control form-control-sm px-1" name="jam_kejadian" value="{{$edit->jam_kejadian}}" required>
                        </div>
{{--                         <div class="form-group mb-2">
                            <label class="mb-0">Tanggal Laporan</label>
                            <input type="date" class="form-control form-control-sm px-1" name="tanggal_laporan" value="{{ old('tanggal_laporan') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Jam Laporan</label>
                            <input type="time" class="form-control form-control-sm px-1" name="jam_laporan" value="{{ old('jam_laporan') }}" required>
                        </div> --}}
                        <div class="form-group mb-2">
                            <label class="mb-0">Jenis Potensi</label>
                            {{-- <input type="text" class="form-control form-control-sm px-1" name="jenis_potensi" value="{{ old('jenis_potensi') }}" required> --}}
                            <select class="form-select pb-0 pt-0 text-capitalize" id="jenis_potensi" name="jenis_potensi" required>
                                <option value="" disabled selected>Jenis Potensi</option>
                                <option value="Harta Benda/Peralatan" {{ 'Harta Benda/Peralatan' == $edit->jenis_potensi ? 'selected' : '' }}>Harta Benda/Peralatan</option>
                                <option value="Gangguan Lingkungan"{{ 'Gangguan Lingkungan' == $edit->jenis_potensi ? 'selected' : '' }}>Gangguan Lingkungan</option>
                                <option value="Kebakaran/Ledakan"{{ 'Kebakaran/Ledakan' == $edit->jenis_potensi ? 'selected' : '' }}>Kebakaran/Ledakan</option>
                                <option value="Gangguan Keamanan"{{ 'Gangguan Keamanan' == $edit->jenis_potensi ? 'selected' : '' }}>Gangguan Keamanan</option>
                                <option value="Lain-lain :" {{ 'Lain-lain :' == Str::substr($edit->jenis_potensi, 0,11) ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                            <input type="text" id="poten" class="form-control form-control-sm px-1 mt-1" name="jenis_potensi" value="{{Str::substr($edit->jenis_potensi, 12,1000)}}" hidden>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Penyebab</label>
                            <input type="text" class="form-control form-control-sm px-1" name="penyebab" value="{{ $edit->penyebab }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Saksi Mata</label>
                            <input type="text" class="form-control form-control-sm px-1" name="saksi_mata" value="{{ $edit->saksi_mata }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Korban</label>
                            <input type="text" class="form-control form-control-sm px-1" name="korban" value="{{ $edit->korban }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Kerugian</label>
                            <input type="text" class="form-control form-control-sm px-1" name="kerugian" value="{{ $edit->kerugian }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label onclick="downCek2()" class="mb-0" data-bs-toggle="collapse" title="klik untuk memperluas" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">Penyebab Dasar <i id="rubah2" class="bi bi-caret-right-fill"></i>
                            </label>
                        </div>
                    <div class="collapse" id="collapse2">
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Kemampuan fisik tidak memadai" {{ in_array('Kemampuan fisik tidak memadai', $dasar) ? 'checked' : '' }} /> Kemampuan fisik tidak memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Kurang pengetahuan" {{ in_array('Kurang pengetahuan', $dasar) ? 'checked' : '' }} /> Kurang pengetahuan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Kurang terampil" {{ in_array('Kurang terampil', $dasar) ? 'checked' : '' }}/> Kurang terampil</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Stress" {{ in_array('Stress', $dasar) ? 'checked' : '' }}/> Stress</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Motivasi kurang/tidak tepat" {{ in_array('Motivasi kurang/tidak tepat', $dasar) ? 'checked' : '' }}/> Motivasi kurang/tidak tepat</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Kepemimpinan/pengawasan kurang memadai" {{ in_array('Kepemimpinan/pengawasan kurang memadai', $dasar) ? 'checked' : '' }}/> Kepemimpinan/pengawasan kurang memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Perencanaan kurang memadai" {{ in_array('Perencanaan kurang memadai', $dasar) ? 'checked' : '' }}/> Perencanaan kurang memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Pengadaan kurang memadai" {{ in_array('Pengadaan kurang memadai', $dasar) ? 'checked' : '' }}/> Pengadaan kurang memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Pemeliharaan kurang memadai" {{ in_array('Pemeliharaan kurang memadai', $dasar) ? 'checked' : '' }}/> Pemeliharaan kurang memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Alat kerja, peralatan kurang memadai" {{ in_array('Alat kerja, peralatan kurang memadai', $dasar) ? 'checked' : '' }}/> Alat kerja, peralatan kurang memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Fasilitas aus atau usang" {{ in_array('Fasilitas aus atau usang', $dasar) ? 'checked' : '' }}/> Fasilitas aus atau usang</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Penyalahgunaan wewenang" {{ in_array('Penyalahgunaan wewenang', $dasar) ? 'checked' : '' }}/> Penyalahgunaan wewenang</label>
                    </div>
                    <div>
                        <label class="mb-0">
                            <input type="checkbox" id="lainan" name="sebab_dasar[]" value="Lain-lain :" {{ 'Lain-lain :' == Str::substr(end($dasar), 0,11) ? 'checked' : '' }}/> Lain-lain</label>
                         <input class="form-control form-control-sm px-1" type="text" id="nilain" name="sebab_dasar[]" value="" /> 
                    </div>
                </div>

{{-- =========================================================================================================================================================================== --}}

                        <div class="form-group mb-2">
                            <label onclick="downCek()" class="mb-0" data-bs-toggle="collapse" title="klik untuk memperluas" href="#collapseEx" role="button" aria-expanded="false" aria-controls="collapseEx">Penyebab Langsung (Tindakan Tidak Aman) <i id="rubah" class="bi bi-caret-right-fill"></i>
                            </label>
                        </div>
                        <div class="collapse" id="collapseEx">
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Menjalankan peralatan tanpa kewenangan" {{ in_array('Menjalankan peralatan tanpa kewenangan', $tindak) ? 'checked' : '' }} /> Menjalankan peralatan tanpa kewenangan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Gagal untuk mengingatkan" {{ in_array('Gagal untuk mengingatkan', $tindak) ? 'checked' : '' }} /> Gagal untuk mengingatkan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Gagal untuk mengamankan" {{ in_array('Gagal untuk mengamankan', $tindak) ? 'checked' : '' }} /> Gagal untuk mengamankan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Mengoperasikan alat dengan kecepatan yang salah" {{ in_array('Mengoperasikan alat dengan kecepatan yang salah', $tindak) ? 'checked' : '' }}/> Mengoperasikan alat dengan kecepatan yang salah</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Membuat alat tak bekerja" {{ in_array('Membuat alat tak bekerja', $tindak) ? 'checked' : '' }}/> Membuat alat tak bekerja</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Menghilangkan alat keselamatan" {{ in_array('Menghilangkan alat keselamatan', $tindak) ? 'checked' : '' }}/> Menghilangkan alat keselamatan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Penggunaan peralatan yang rusak" {{ in_array('Penggunaan peralatan yang rusak', $tindak) ? 'checked' : '' }}/> Penggunaan peralatan yang rusak</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Penggunaan peralatan yang tidak tepat" {{ in_array('Penggunaan peralatan yang tidak tepat', $tindak) ? 'checked' : '' }}/> Penggunaan peralatan yang tidak tepat</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Gagal menggunakan alat pelindung diri" {{ in_array('Gagal menggunakan alat pelindung diri', $tindak) ? 'checked' : '' }}/> Gagal menggunakan alat pelindung diri</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Pemuatan tidak tepat" {{ in_array('Pemuatan tidak tepat', $tindak) ? 'checked' : '' }}/> Pemuatan tidak tepat</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Menempatkan alat yang tidak tepat" {{ in_array('Menempatkan alat yang tidak tepat', $tindak) ? 'checked' : '' }}/> Menempatkan alat yang tidak tepat</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Posisi kerja yang tidak tepat" {{ in_array('Posisi kerja yang tidak tepat', $tindak) ? 'checked' : '' }}/> Posisi kerja yang tidak tepat</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Memperbaiki peralatan dalam keadaan berjalan" {{ in_array('Memperbaiki peralatan dalam keadaan berjalan', $tindak) ? 'checked' : '' }}/> Memperbaiki peralatan dalam keadaan berjalan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Senda gurau" {{ in_array('Senda gurau', $tindak) ? 'checked' : '' }}/> Senda gurau</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Dibawah pengaruh alkohol atau obat-obatan" {{ in_array('Dibawah pengaruh alkohol atau obat-obatan', $tindak) ? 'checked' : '' }}/> Dibawah pengaruh alkohol atau obat-obatan</label>
                    </div>
                    <div>
                        <label class="mb-0">
                            <input type="checkbox" id="other" name="sebab_tindakan[]" value="Lain-lain :" {{ 'Lain-lain :' == Str::substr(end($tindak), 0,11) ? 'checked' : '' }}/> Lain-lain</label>
                         <input class="form-control form-control-sm px-1" type="text" id="otherValue" name="sebab_tindakan[]" aria-label="Other interest"/>
                    </div>
                </div>

{{-- ============================================================================================================================================================= --}}
                        <div class="form-group mb-2">
                            <label onclick="downCek1()" class="mb-0" data-bs-toggle="collapse" title="klik untuk memperluas" href="#collapseXX" role="button" aria-expanded="false" aria-controls="collapseXX">Penyebab Langsung (Kondisi Tidak Aman) <i id="rubah1" class="bi bi-caret-right-fill"></i></label>
                        </div>
                        <div class="collapse" id="collapseXX">
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Pelindung tidak memadai" {{ in_array('Pelindung tidak memadai', $kondisi) ? 'checked' : '' }}/> Pelindung tidak memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Peralatan pelindung tidak memadai" {{ in_array('Peralatan pelindung tidak memadai', $kondisi) ? 'checked' : '' }}/> Peralatan pelindung tidak memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Peralatan atau bahan yang rusak" {{ in_array('Peralatan atau bahan yang rusak', $kondisi) ? 'checked' : '' }}/> Peralatan atau bahan yang rusak</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Ruang gerak yang terbatas" {{ in_array('Ruang gerak yang terbatas', $kondisi) ? 'checked' : '' }}/> Ruang gerak yang terbatas</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Sistem peringatan tidak memadai" {{ in_array('Sistem peringatan tidak memadai', $kondisi) ? 'checked' : '' }}/> Sistem peringatan tidak memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Bahaya kebakaran/peledakan" {{ in_array('Bahaya kebakaran/peledakan', $kondisi) ? 'checked' : '' }}/> Bahaya kebakaran/peledakan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Housekeeping yang tidak baik" {{ in_array('Housekeeping yang tidak baik', $kondisi) ? 'checked' : '' }}/> Housekeeping yang tidak baik</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Kondisi lingkungan, gas, debu, asap, bau dan uap" {{ in_array('Kondisi lingkungan, gas, debu, asap, bau dan uap', $kondisi) ? 'checked' : '' }}/> Kondisi lingkungan, gas, debu, asap, bau dan uap</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Pengaruh kebisingan" {{ in_array('Pengaruh kebisingan', $kondisi) ? 'checked' : '' }}/> Pengaruh kebisingan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Pengaruh radiasi" {{ in_array('Pengaruh radiasi', $kondisi) ? 'checked' : '' }}/> Pengaruh radiasi</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Pengaruh suhu rendah/tinggi" {{ in_array('Pengaruh suhu rendah/tingg', $kondisi) ? 'checked' : '' }}/> Pengaruh suhu rendah/tinggi</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Penerangan kurang/berlebihan" {{ in_array('Penerangan kurang/berlebihan', $kondisi) ? 'checked' : '' }}/> Penerangan kurang/berlebihan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Ventilasi tidak memadai" {{ in_array('Ventilasi tidak memadai', $kondisi) ? 'checked' : '' }}/> Ventilasi tidak memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Pencemaran" {{ in_array('Pencemaran', $kondisi) ? 'checked' : '' }}/> Pencemaran</label>
                    </div>
                    <div>
                        <label class="mb-0">
                            <input type="checkbox" id="lain" name="sebab_kondisi[]" value="Lain-lain :" {{ 'Lain-lain :' == Str::substr(end($kondisi), 0,11) ? 'checked' : '' }}/> Lain-lain</label>
                         <input class="form-control form-control-sm px-1" type="text" id="nilaiLain" name="sebab_kondisi[]" aria-label="Other interest"/>
                    </div>
                </div>

{{-- =================================================================================================================================================== --}}

                        <div class="form-group mb-2">
                            <label class="mb-0">Uraian Singkat</label>
                            <textarea type="text" id="checkBtn" class="form-control form-control-sm px-1" name="uraian_singkat" required>{{ $edit->uraian_singkat }}</textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Perlu Tindakan Perbaikan</label>
                            <select class="form-select pb-0 pt-0 text-capitalize" name="tindak_perbaikan">
                                <option value="" disabled selected>Pilih Tindakan</option>
                                <option value="ya" {{ 'ya' == $edit->tindak_perbaikan ? 'selected' : '' }}>Ya</option>
                                <option value="tidak" {{ 'tidak' == $edit->tindak_perbaikan ? 'selected' : '' }}>tidak</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Rencana Perbaikan</label>
                            <input type="text" class="form-control form-control-sm px-1" name="rencana_perbaikan" value="{{ $edit->rencana_perbaikan }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Komentar Management Representative</label>
                            <input type="text" class="form-control form-control-sm px-1" name="kom_mng_rep" value="{{ $edit->kom_mng_rep }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Nama Pelapor</label>
                            <input type="text" class="form-control form-control-sm px-1" name="nama_pelapor" value="{{ $edit->nama_pelapor }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Unit Kerja Pelapor</label>
                            <input type="text" class="form-control form-control-sm px-1" name="uker_pelapor" value="{{ $edit->uker_pelapor }}" required>
                        </div>

{{--                    <div class="form-group mb-2">
                            <label class="mb-0">Nama Penyidik</label>
                            <input type="text" class="form-control form-control-sm px-1" name="nama_penyidik" value="{{ old('nama_penyidik') }}" required>
                        </div>--}}
                    @if ($edit->dokumentasi == null)
                    <div>
                            Upload Foto
                            <input type="file" name="images[]"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" 
                                    accept=".jpg, .jpeg, .png" 
                                    multiple/>

                    </div>
                    @else
                    <div>
                        <td colspan="3"><b>Foto Dokumentasi</b>: <br> <p></p>
                        <div class="row">
                            @foreach(explode('|',$edit->dokumentasi) as $item)

                            <div class="containerx">
                                
                               <img class="image" src="{{asset('storage/kejadian')}}/{{$edit->no_lap}}/{{$item}}" style="width: 100%; margin-bottom: 5pt"> &nbsp;
                            <div class="middle">
                            <div class="text"><a href="/kejadian/hapus-foto/{{$item}}/{{$edit->id}}" title="Hapus Foto" onclick="return confirm('Yakin foto dokumentasi mau di hapus ?')"><i class="bi bi-trash3"></i></a></div>
                          </div>
                            </div>

                            @endforeach
                        </div>
                        </td>
                    </div>
                    <div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Tambah Foto</label>
                            <input type="file" name="images[]"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" 
                                    accept=".jpg, .jpeg, .png" 
                                    multiple/>
                        </div> 
                    </div>
                    @endif

                        <div class="form-group" style="text-align:center;">
                            <button type="submit" class="btn btn-primary" id="">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$("#jenis").prop("disabled", true);

if ($("#jenis_kejadian option:selected").val() == 'Lain-lain :') {
        $("#jenis").prop("disabled", false);
        $('#jenis').prop('hidden', false); 
        $("#jenis").prop('required', true);
        $("#jenis_kejadian").prop('required', true);
        $("#jenis_kejadian").attr("name", "jenis_kejadian[]");
        $("#jenis").attr("name", "jenis_kejadian[]");
        $("#jenis").attr("value", "{{Str::substr($edit->jenis_kejadian, 12,1000)}}");
};

    $(window).on('load', function(){
        $("#jenis_kejadian").change(function() {
          console.log($("#jenis_kejadian option:selected").val());
          if ($("#jenis_kejadian option:selected").val() == 'Lain-lain :') {
                $("#jenis").prop("disabled", false);
                $('#jenis').prop('hidden', false); 
                $("#jenis").prop('required', true);
                $("#jenis_kejadian").prop('required', false);
                $("#jenis_kejadian").attr("name", "jenis_kejadian[]");
                $("#jenis").attr("name", "jenis_kejadian[]");
                $("#jenis").attr("value", "");
          } else {
            $("#jenis").prop("disabled", true);
            $('#jenis').prop('hidden', true);
            $("#jenis").prop('required', false);
            $("#jenis").attr("name", '');
            $("#jenis_kejadian").prop('required', true);
            $("#jenis_kejadian").attr("name", "jenis_kejadian");
          }
        }
);
});
</script>
<script type="text/javascript">
$("#poten").prop("disabled", true);

if ($("#jenis_potensi option:selected").val() == 'Lain-lain :') {
        $("#poten").prop("disabled", false);
        $('#poten').prop('hidden', false); 
        $("#poten").prop('required', true);
        $("#jenis_potensi").prop('required', true);
        $("#jenis_potensi").attr("name", "jenis_potensi[]");
        $("#poten").attr("name", "jenis_potensi[]");
        $("#poten").attr("value", "{{Str::substr($edit->jenis_potensi, 12,1000)}}");
};

    $(window).on('load', function(){
        $("#jenis_potensi").change(function() {
          console.log($("#jenis_potensi option:selected").val());
          if ($("#jenis_potensi option:selected").val() == 'Lain-lain :') {
                $("#poten").prop("disabled", false);
                $('#poten').prop('hidden', false); 
                $("#poten").prop('required', true);
                $("#jenis_potensi").prop('required', false);
                $("#jenis_potensi").attr("name", "jenis_potensi[]");
                $("#poten").attr("name", "jenis_potensi[]");
                $("#poten").attr("value", "");
          } else {
            $("#poten").prop("disabled", true);
            $('#poten').prop('hidden', true);
            $("#poten").prop('required', false);
            $("#poten").attr("name", '');
            $("#jenis_potensi").prop('required', true);
            $("#jenis_potensi").attr("name", "jenis_potensi");
          }
        }
);
});
</script>
<script>
$("#set").click(function() {
    if (confirm('Yakin isian mau dihapus?')) {
        $("#form").trigger("reset");
        $("#poten").prop('hidden', true);
        $("#poten").prop('required', false);
        $("#jenis_potensi").prop('required', true);
        $("#jenis_potensi").attr("name", "jenis_potensi");
    } else {

    }
        
});
</script>
<script>
const otherCheckbox = document.querySelector('#other');
const otherText = document.querySelector('#otherValue');
otherText.style.visibility = 'hidden';
otherText.disabled = true;
if (otherCheckbox.checked) {
    otherText.style.visibility = 'visible';
    otherText.name = 'sebab_tindakan[]';
    otherText.required= true;
    otherText.disabled = false;
    otherText.value = '{{Str::substr(end($tindak), 12,1000)}}';
}
otherCheckbox.addEventListener('change', () => {
  if (otherCheckbox.checked) {
    otherText.style.visibility = 'visible';
    otherText.value = '';
    otherText.name = 'sebab_tindakan[]';
    otherText.required= true;
    otherText.disabled = false;
  } else {
    otherText.disabled = true;
    otherText.required = false;
    otherText.style.visibility = 'hidden';
    otherText.name = '';
  }
});
</script>

<script>
const lain = document.querySelector('#lain');
const nilaiLain = document.querySelector('#nilaiLain');
nilaiLain.disabled = true;
nilaiLain.style.visibility = 'hidden';
if (lain.checked) {
    nilaiLain.style.visibility = 'visible';
    nilaiLain.name = 'sebab_kondisi[]';
    nilaiLain.required= true;
    nilaiLain.disabled = false;
    nilaiLain.value = '{{Str::substr(end($kondisi), 12,1000)}}';
} else {
        nilaiLain.disabled = true;
    nilaiLain.required = false;
    nilaiLain.style.visibility = 'hidden';
    nilaiLain.name = '';
};

lain.addEventListener('change', () => {
  if (lain.checked) {
    nilaiLain.style.visibility = 'visible';
    nilaiLain.value = '';
    nilaiLain.name = 'sebab_kondisi[]';
    nilaiLain.required= true;
    nilaiLain.disabled = false;
  } else {
    nilaiLain.disabled = true;
    nilaiLain.required = false;
    nilaiLain.style.visibility = 'hidden';
    nilaiLain.name = '';
  }
});
</script>

<script>
const lainan = document.querySelector('#lainan');
const nilain = document.querySelector('#nilain');
nilain.disabled = true;
nilain.style.visibility = 'hidden';
if (lainan.checked) {
    nilain.style.visibility = 'visible';
    nilain.name = 'sebab_dasar[]';
    nilain.required= true;
    nilain.disabled = false;
    nilain.value = '{{Str::substr(end($dasar), 12,1000)}}';
}

lainan.addEventListener('change', () => {
  if (lainan.checked) {
    nilain.style.visibility = 'visible';
    nilain.name = 'sebab_dasar[]';

    nilain.required= true;
    nilain.disabled = false;
  } else {
    nilain.disabled = true;
    nilain.required = false;
    nilain.style.visibility = 'hidden';
    nilain.name = '';
  }
});
</script>

<script>
    function downCek() {
  var x = document.getElementById("rubah");
  if (x.className === "bi bi-caret-right-fill") {
    x.className = "bi bi-caret-down-fill";
  } else {
    x.className = "bi bi-caret-right-fill";
  }
}
</script>
<script>
    function downCek1() {
  var x = document.getElementById("rubah1");
  if (x.className === "bi bi-caret-right-fill") {
    x.className = "bi bi-caret-down-fill";
  } else {
    x.className = "bi bi-caret-right-fill";
  }
}
</script>
<script>
    function downCek2() {
  var x = document.getElementById("rubah2");
  if (x.className === "bi bi-caret-right-fill") {
    x.className = "bi bi-caret-down-fill";
  } else {
    x.className = "bi bi-caret-right-fill";
  }
}
</script>

@endsection