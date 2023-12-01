@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Buat Laporan Insiden / Kejadian') }}
                    <a href="{{route('kejadian')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

                </div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
                <div class="card-body overflow " style="overflow-x: auto;">

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


        @if ($message = Session::get('berhasil'))
            <script>
                    Swal.fire({
                      title: "Berhasil",
                      text:  "Laporan Insiden / Kejadian Berhasil Tersimpan !",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 1500
                    });

            setTimeout(function () {
                   window.location = "{{url('kejadian-detil/'.$message)}}";
                }, 1700); 

                    
            </script>
        @endif
                        <!-- Notifikasi -->
                            {{-- @if ($message = Session::get('berhasil'))
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
                            @endif --}}
{{-- <script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
 --}}

                    <!-- form input personil -->
                        <form action="{{route('jadi-simpan')}}" method="post" id="form" enctype="multipart/form-data">
                @csrf
                        <div align="right" class="form-group mb-1">
                            <span class="btn btn-secondary btn-sm" id="set" >Reset</span>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Jenis Kejadian</label>
                            {{-- <input type="text" class="form-control form-control-sm px-1 m-0" name="jns_kejadian" value="{{old ('jns_kejadian')}}" required> --}}
                            <select class="form-select pb-0 pt-0 text-capitalize" id="jenis_kejadian" name="jenis_kejadian" required>
                                <option value="" disabled selected>Jenis Kejadian</option>
                                <option value="Kecelakaan Kerja">Kecelakaan Kerja</option>
                                <option value="Insiden">Insiden</option>
                                <option value="Unjuk Rasa">Unjuk Rasa</option>
                                <option value="Lain-lain :">Lain-lain</option>
                            </select>
                            <input type="text" id="jenis" class="form-control form-control-sm px-1 mt-1" name="" hidden>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Lokasi Kejadian</label>
                            <select class="form-select pb-0 pt-0 text-capitalize" id="lokasi_kejadian" name="lokasi_kejadian" required>
                                <option value="" disabled selected>Pilih Lokasi</option>
                                @foreach($site as $item)
                                <option value="{{$item->id}}">{{$item->nama_gd}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Waktu Kejadian</label>
                            <input type="date" class="form-control form-control-sm px-1" name="waktu_kejadian" value="{{ old('waktu_kejadian') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Jam Kejadian</label>
                            <input type="time" id="" placeholder="Time" class="form-control form-control-sm px-1" name="jam_kejadian" value="" required>
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
                                <option value="Harta Benda/Peralatan">Harta Benda/Peralatan</option>
                                <option value="Gangguan Lingkungan">Gangguan Lingkungan</option>
                                <option value="Kebakaran/Ledakan">Kebakaran/Ledakan</option>
                                <option value="Gangguan Keamanan">Gangguan Keamanan</option>
                                <option value="Lain-lain :" >Lain-lain</option>
                            </select>
                            <input type="text" id="poten" class="form-control form-control-sm px-1 mt-1" name="" value="{{ old('jenis_potensi[]') }}" hidden>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Penyebab</label>
                            <input type="text" class="form-control form-control-sm px-1" name="penyebab" value="{{ old('penyebab') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Saksi Mata</label>
                            <input type="text" class="form-control form-control-sm px-1" name="saksi_mata" value="{{ old('saksi_mata') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Korban</label>
                            <input type="text" class="form-control form-control-sm px-1" name="korban" value="{{ old('korban') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Kerugian</label>
                            <input type="text" class="form-control form-control-sm px-1" name="kerugian" value="{{ old('kerugian') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label onclick="downCek2()" class="mb-0" data-bs-toggle="collapse" title="klik untuk memperluas" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">Penyebab Dasar <i id="rubah2" class="bi bi-caret-right-fill"></i>
                            </label>
                        </div>
                    <div class="collapse" id="collapse2">
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Kemampuan fisik tidak memadai" /> Kemampuan fisik tidak memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Kurang pengetahuan" /> Kurang pengetahuan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Kurang terampil" /> Kurang terampil</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Stress" /> Stress</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Motivasi kurang/tidak tepat" /> Motivasi kurang/tidak tepat</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Kepemimpinan/pengawasan kurang memadai" /> Kepemimpinan/pengawasan kurang memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Perencanaan kurang memadai" /> Perencanaan kurang memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Pengadaan kurang memadai" /> Pengadaan kurang memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Pemeliharaan kurang memadai" /> Pemeliharaan kurang memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Alat kerja, peralatan kurang memadai" /> Alat kerja, peralatan kurang memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Fasilitas aus atau usang" /> Fasilitas aus atau usang</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_dasar[]" value="Penyalahgunaan wewenang" /> Penyalahgunaan wewenang</label>
                    </div>
                    <div>
                        <label class="mb-0">
                            <input type="checkbox" id="lainan" name="sebab_dasar[]" value="Lain-lain :" /> Lain-lain</label>
                         <input class="form-control form-control-sm px-1" type="text" id="nilain" name="sebab_dasar[]" />
                    </div>
                </div>
                        <div class="form-group mb-2">
                            <label onclick="downCek()" class="mb-0" data-bs-toggle="collapse" title="klik untuk memperluas" href="#collapseEx" role="button" aria-expanded="false" aria-controls="collapseEx">Penyebab Langsung (Tindakan Tidak Aman) <i id="rubah" class="bi bi-caret-right-fill"></i>
                            </label>
                        </div>
                        <div class="collapse" id="collapseEx">
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Menjalankan peralatan tanpa kewenangan" /> Menjalankan peralatan tanpa kewenangan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Gagal untuk mengingatkan" /> Gagal untuk mengingatkan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Gagal untuk mengamankan" /> Gagal untuk mengamankan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Mengoperasikan alat dengan kecepatan yang salah" /> Mengoperasikan alat dengan kecepatan yang salah</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Membuat alat tak bekerja" /> Membuat alat tak bekerja</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Menghilangkan alat keselamatan" /> Menghilangkan alat keselamatan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Penggunaan peralatan yang rusak" /> Penggunaan peralatan yang rusak</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Penggunaan peralatan yang tidak tepat" /> Penggunaan peralatan yang tidak tepat</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Gagal menggunakan alat pelindung diri" /> Gagal menggunakan alat pelindung diri</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Pemuatan tidak tepat" /> Pemuatan tidak tepat</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Menempatkan alat yang tidak tepat" /> Menempatkan alat yang tidak tepat</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Posisi kerja yang tidak tepat" /> Posisi kerja yang tidak tepat</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Memperbaiki peralatan dalam keadaan berjalan" /> Memperbaiki peralatan dalam keadaan berjalan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Senda gurau" /> Senda gurau</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_tindakan[]" value="Dibawah pengaruh alkohol atau obat-obatan" /> Dibawah pengaruh alkohol atau obat-obatan</label>
                    </div>
                    <div>
                        <label class="mb-0">
                            <input type="checkbox" id="other" name="sebab_tindakan[]" value="Lain-lain :" /> Lain-lain</label>
                         <input class="form-control form-control-sm px-1" type="text" id="otherValue" name="sebab_tindakan[]" aria-label="Other interest"/>
                    </div>
                </div>
                        <div class="form-group mb-2">
                            <label onclick="downCek1()" class="mb-0" data-bs-toggle="collapse" title="klik untuk memperluas" href="#collapseXX" role="button" aria-expanded="false" aria-controls="collapseXX">Penyebab Langsung (Kondisi Tidak Aman) <i id="rubah1" class="bi bi-caret-right-fill"></i></label>
                        </div>
                        <div class="collapse" id="collapseXX">
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Pelindung tidak memadai" /> Pelindung tidak memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Peralatan pelindung tidak memadai" /> Peralatan pelindung tidak memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Peralatan atau bahan yang rusak" /> Peralatan atau bahan yang rusak</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Ruang gerak yang terbatas" /> Ruang gerak yang terbatas</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Sistem peringatan tidak memadai" /> Sistem peringatan tidak memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Bahaya kebakaran/peledakan" /> Bahaya kebakaran/peledakan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Housekeeping yang tidak baik" /> Housekeeping yang tidak baik</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Kondisi lingkungan, gas, debu, asap, bau dan uap" /> Kondisi lingkungan, gas, debu, asap, bau dan uap</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Pengaruh kebisingan" /> Pengaruh kebisingan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Pengaruh radiasi" /> Pengaruh radiasi</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Pengaruh suhu rendah/tinggi" /> Pengaruh suhu rendah/tinggi</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Penerangan kurang/berlebihan" /> Penerangan kurang/berlebihan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Ventilasi tidak memadai" /> Ventilasi tidak memadai</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" name="sebab_kondisi[]" value="Pencemaran" /> Pencemaran</label>
                    </div>
                    <div>
                        <label class="mb-0">
                            <input type="checkbox" id="lain" name="sebab_kondisi[]" value="Lain-lain :"/> Lain-lain</label>
                         <input class="form-control form-control-sm px-1" type="text" id="nilaiLain" name="sebab_kondisi[]" aria-label="Other interest"/>
                    </div>
                </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Uraian Singkat</label>
                            <textarea type="text" id="checkBtn" class="form-control form-control-sm px-1" name="uraian_singkat" value="{{ old('uraian_singkat') }}" required></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Perlu Tindakan Perbaikan</label>
                            <select class="form-select pb-0 pt-0 text-capitalize" name="tindak_perbaikan">
                                <option value="" disabled selected>Pilih Tindakan</option>
                                <option value="ya">Ya</option>
                                <option value="tidak">tidak</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Rencana Perbaikan</label>
                            <input type="text" class="form-control form-control-sm px-1" name="rencana_perbaikan" value="{{ old('rencana_perbaikan') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Komentar Management Representative</label>
                            <input type="text" class="form-control form-control-sm px-1" name="kom_mng_rep" value="{{ old('kom_mng_rep') }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Nama Pelapor</label>
                            <input type="text" class="form-control form-control-sm px-1" name="nama_pelapor" value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Unit Kerja Pelapor</label>
                            <input type="text" class="form-control form-control-sm px-1" name="uker_pelapor" value="{{ old('uker_pelapor') }}" required>
                        </div>

{{--                    <div class="form-group mb-2">
                            <label class="mb-0">Nama Penyidik</label>
                            <input type="text" class="form-control form-control-sm px-1" name="nama_penyidik" value="{{ old('nama_penyidik') }}" required>
                        </div>--}}
                        <div class="form-group mb-2">
                            <label class="mb-0">Foto Dokumentasi</label>
                            <input type="file" name="images[]"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" 
                                    accept=".jpg, .jpeg, .png" 
                                    multiple/>
                        </div> 

                        <div class="form-group" style="text-align:center;">
                            <button type="submit" class="btn btn-primary" id="">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
     $("#jenis").prop("disabled", true); 

    $(window).on('load', function(){
        $("#jenis_kejadian").change(function() {
          console.log($("#jenis_kejadian option:selected").val());
          if ($("#jenis_kejadian option:selected").val() == 'Lain-lain :') {
            $("#jenis").prop("disabled", false);
            $('#jenis').prop('hidden', false);        
            $("#jenis").prop('required', true);
            $("#jenis_kejadian").prop('required', true);
            $("#jenis_kejadian").attr("name", "jenis_kejadian[]");
            $("#jenis").attr("name", "jenis_kejadian[]");
          } else {
            $("#jenis").prop("disabled", true);
            $('#jenis').prop('hidden', true);
            $("#jenis").prop('required', false);
            $("#jenis_kejadian").prop('required', true);
            $("#jenis_kejadian").attr("name", "jenis_kejadian");
            $("#jenis").attr("name", "");
          }
        }
);
});
</script>
<script type="text/javascript">
     $("#poten").prop("disabled", true); 

    $(window).on('load', function(){
        $("#jenis_potensi").change(function() {
          console.log($("#jenis_potensi option:selected").val());
          if ($("#jenis_potensi option:selected").val() == 'Lain-lain :') {
            $("#poten").prop("disabled", false);
            $('#poten').prop('hidden', false);        
            $("#poten").prop('required', true);
            $("#jenis_potensi").prop('required', true);
            $("#jenis_potensi").attr("name", "jenis_potensi[]");
            $("#poten").attr("name", "jenis_potensi[]");
          } else {
            $("#poten").prop("disabled", true);
            $('#poten').prop('hidden', true);
            $("#poten").prop('required', false);
            $("#jenis_potensi").prop('required', true);
            $("#jenis_potensi").attr("name", "jenis_potensi");
            $("#poten").attr("name", "");
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

lainan.addEventListener('change', () => {
  if (lainan.checked) {
    nilain.style.visibility = 'visible';
    nilain.value = '';
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