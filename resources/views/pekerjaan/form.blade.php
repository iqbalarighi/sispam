@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" id="target">
        <div class="col-md-8 px-0">
            <div class="card">
                <div class="card-header">
                    <b>{{ __('PERMINTAAN SURAT IZIN KERJA') }}</b>
                <div class="col-sm-0 float-end" onclick="quest()">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-patch-question-fill" viewBox="0 0 16 16">
                  <path d="M5.933.87a2.89 2.89 0 0 1 4.134 0l.622.638.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01zM7.002 11a1 1 0 1 0 2 0 1 1 0 0 0-2 0m1.602-2.027c.04-.534.198-.815.846-1.26.674-.475 1.05-1.09 1.05-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.7 1.7 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745.336 0 .504-.24.554-.627"></path>
                </svg>
                </div>
                </div>
<style type="text/css">
    .custom-file-button input[type=file] {
  margin-left: -2px !important;
}

.custom-file-button input[type=file]::-webkit-file-upload-button {
  display: none;
}

.custom-file-button input[type=file]::file-selector-button {
  display: none;
}

.custom-file-button:hover label {
  background-color: #dde0e3;
  cursor: pointer;
}
</style>

    @if ( Carbon\Carbon::now()->isoFormat('HHmmss') >= 200000 || Carbon\Carbon::now()->isoFormat('HHmmss') <= 80000)
<script type="text/javascript">
function quest() {
        Swal.fire({
  title: "Hubungi Kami",
  html: `
    Jika ada pertanyaan lebih lanjut silahkan hubungi kami di nomor whatsapp berikut 
    <br/>
    <br/>
    <a target="_blank" href="https://wa.me/628119809606"><img alt="Chat on WhatsApp" width="225px" src="https://static.xx.fbcdn.net/assets/?revision=947305627097899&name=platform-agnostic-green-medium-en-us&density=1" /></a>
  `,
  icon: "warning",
  showCancelButton: false,
  showConfirmButton: false,
});
}
</script>
@else
<script type="text/javascript">
function quest() {
        Swal.fire({
  title: "Hubungi Kami",
  html: `
    Jika ada pertanyaa lebih lanjut silahkan hubungi kami di nomor whatsapp berikut 
    <br/>
    <br/>
    <a target="_blank" href="https://wa.me/6285223442696"><img alt="Chat on WhatsApp" width="225px" src="https://static.xx.fbcdn.net/assets/?revision=947305627097899&name=platform-agnostic-green-medium-en-us&density=1" /></a>
  `,
  icon: "warning",
  showCancelButton: false,
  showConfirmButton: false,
});
}
</script>
@endif
                <div class="card-body px-1 pt-1">
                    @if (session('status'))
                            @if ( Carbon\Carbon::now()->isoFormat('HHmmss') >= 200000 || Carbon\Carbon::now()->isoFormat('HHmmss') <= 80000)
                                <script>
                                Swal.fire({
                                  title: "Berhasil",
                                  text:  "{{ session('status') }}",
                                  icon: "success",
                                  showConfirmButton: false,
                                  timer: 1500
                                });

                        setTimeout(function () {
                               Swal.fire({
                                      title: "Perhatian",
                                      icon: "info",
                                      html: `
                                        Klik Tombol berikut untuk menghubungi petugas agar mendapatkan persetujuan
                                        <br>
                                        <br>
                                        <a aria-label="Chat on WhatsApp" href="https://wa.me/628119809606?text=Halo%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20terkait%20dokumen%20kami%20dengan%20nomor%20laporan%20{{session('izinid')}}.%20Terima%20Kasih.%0A%0Ahttp%3A%2F%2Fwww.sispam.id%2Fizin-detail%2F{{session('id')}}">
                                        <img alt="Chat on WhatsApp" width="225px" src="https://static.xx.fbcdn.net/assets/?revision=947305627097899&name=platform-agnostic-green-medium-en-us&density=1" />
                                        <a />
                                      `,
                                  showConfirmButton: false,
                                  allowOutsideClick: false,

                                        });
                            }, 1700); 
                                
                        </script>
                            @else
                               <script>
                                Swal.fire({
                                  title: "Berhasil",
                                  text:  "{{ session('status') }}",
                                  icon: "success",
                                  showConfirmButton: false,
                                  timer: 1500
                                });

                        setTimeout(function () {
                               Swal.fire({
                                      title: "Perhatian",
                                      icon: "info",
                                      html: `
                                        Klik Tombol berikut untuk menghubungi petugas agar mendapatkan persetujuan
                                        <br>
                                        <br>
                                        <a aria-label="Chat on WhatsApp" href="https://wa.me/6285223442696?text=Halo%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20terkait%20dokumen%20kami%20dengan%20nomor%20laporan%20{{session('izinid')}}.%20Terima%20Kasih.%0A%0Ahttp%3A%2F%2Fwww.sispam.id%2Fizin-detail%2F{{session('id')}}">
                                        <img alt="Chat on WhatsApp" width="225px" src="https://static.xx.fbcdn.net/assets/?revision=947305627097899&name=platform-agnostic-green-medium-en-us&density=1" />
                                        <a />
                                      `,
                                  showConfirmButton: false,
                                  allowOutsideClick: false,

                                        });
                            }, 1700); 
                                
                        </script>
                            @endif
                    @endif
            <form action="{{route('simpan_izin')}}" method="post" id="form" enctype="multipart/form-data" onsubmit="return loding(this);">
                @csrf
                <div class="col-sm-3"> 

                    <label for="risiko">Risiko Pekerjaan : </label>
                    <select name="risiko" id="risiko" class="form-select form-select-sm" required>
                        <option value="" selected>:: Pilih Risiko Pekerjaan ::</option>
                        <option value="Sangat Rendah" style="background-color: limegreen; color: black;">Sangat Rendah</option>
                        <option value="Rendah" style="background-color: yellow; color: black;">Rendah</option>
                        <option value="Sedang" style="background-color: darkorange; color: black;">Sedang</option>
                        <option value="Tinggi" style="background-color: red; color: white;">Tinggi</option>
                        <option value="Sangat Tinggi" style="background-color: darkred; color: white">Sangat Tinggi</option>
                    </select>
                </div>
<script type="text/javascript">
    $("#risiko").change(function() {
        if ($("#risiko option:selected").val() == 'Sangat Rendah') {
            $("#risiko").css('background-color', 'limegreen');
            $("#risiko").css('color', 'black');
        } else if ($("#risiko option:selected").val() == 'Rendah') {
            $("#risiko").css('background-color', 'yellow');
            $("#risiko").css('color', 'black');
        } else if ($("#risiko option:selected").val() == 'Sedang') {
            $("#risiko").css('background-color', 'darkorange');
            $("#risiko").css('color', 'black');
        } else if ($("#risiko option:selected").val() == 'Tinggi') {
            $("#risiko").css('background-color', 'red');
            $("#risiko").css('color', 'white');
        } else if ($("#risiko option:selected").val() == 'Sangat Tinggi') {
            $("#risiko").css('background-color', 'darkred');
            $("#risiko").css('color', 'white');
        } else {
            $("#risiko").css('background-color', 'white');
            $("#risiko").css('color', 'black');
        }
    }); 
</script>

                <div class="mt-4">
                    <b>A. Klasifikasi Pekerjaan</b>
                    <div>
                        <label class="mb-0"><input id="clas1" type="checkbox" name="klasifikasi[]" onclick="firm()" value="Kerja Panas" /> Kerja Panas</label>
                    </div>
                    <div>
                        <label class="mb-0"><input id="clas2" type="checkbox" name="klasifikasi[]" onclick="firm()" value="Kerja Listrik" /> Kerja Listrik</label>
                    </div>
                    <div>
                        <label class="mb-0"><input id="clas3" type="checkbox" name="klasifikasi[]" onclick="firm()" value="Ketinggian" /> Ketinggian</label>
                    </div>
                    <div>
                        <label class="mb-0"><input id="clas4" type="checkbox" name="klasifikasi[]" onclick="firm()" value="Alat Berat" /> Alat Berat</label>
                    </div>
                    <div>
                        <label class="mb-0"><input id="clas5" type="checkbox" name="klasifikasi[]" onclick="firm()" value="Perpipaan" /> Perpipaan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input id="clas6" type="checkbox" name="klasifikasi[]" onclick="firm()" value="Tangki" /> Tangki</label>
                    </div>
                    <div>
                        <label class="mb-0"><input id="clas7" type="checkbox" name="klasifikasi[]" onclick="firm()" value="Ruang Terbatas" /> Ruang Terbatas</label>
                    </div>
                    <div>
                        <label class="mb-0"><input id="clas8" type="checkbox" name="klasifikasi[]" onclick="firm()" value="Galian" /> Galian</label>
                    </div>
                    <div class="col-md-5">
                        <label class="mb-0">
                                            <input type="checkbox" id="clas9" name="klasifikasi[]" onclick="firm()" value="Lain-lain :" /> Lain-lain</label>
                         <input class="form-control form-control-sm px-1" size="15" type="text" id="nilain" name="klasifikasi[]" hidden disabled/>
                    </div>
                </div>

        <div class="row mt-4">
            <b>B. Informasi Pekerjaan</b> <br>
            <font size="1" color="red">*Kolom bertanda bintang (*) wajib diisi !</font><br>
            <div class="col pe-0"> 
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    {{-- <input type="text" class="form-control form-control-sm px-1" name="perusahaan_pemohon" value="{{ old('perusahaan_pemohon') }}" placeholder="*Perusahaan Pemohon" required> --}}

                    <select class="form-select form-select-sm px-1 text-capitalize" id="perusahaan_pemohon" name="perusahaan_pemohon" required>
                        <option value="" disabled selected>*Perusahaan Pemohon</option>
                        <option value="PT. Prima Karya Sarana Sejahtera (PT. PKSS)">PT. Prima Karya Sarana Sejahtera (PT. PKSS)</option>
                        <option value="PT. Kopojeka Daya Indonesia (PT. KDI)">PT. Kopojeka Daya Indonesia (PT. KDI)</option>
                        <option value="PT. Swadharma Griyasatya (PT. SGRS)">PT. Swadharma Griyasatya (PT. SGRS)</option>
                        <option value="PT. Bangun Prestasi Bersama (PT. BPB)">PT. Bangun Prestasi Bersama (PT. BPB)</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <input class="form-control form-control-sm px-1 mt-1" size="15" type="text" id="perusahaan" hidden disabled placeholder="*Perusahaan Pemohon" />
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="pekerjaan" value="{{ old('pekerjaan') }}" placeholder="*Pekerjaan" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    {{-- <input type="text" class="form-control form-control-sm px-1" name="lokasi" value="{{ old('lokasi') }}" placeholder="*Lokasi" required> --}}
                    <select class="form-select form-select-sm px-1 text-capitalize" id="lokasi" name="lokasi" required>
                        <option value="" disabled selected>*Lokasi</option>
                        <option value="Gedung Soemitro Djojohadikusumo">Gedung Soemitro Djojohadikusumo</option>
                        <option value="Gedung Wisma Mulia 2">Gedung Wisma Mulia 2</option>
                        <option value="Gedung Menara Radius Prawiro">Gedung Menara Radius Prawiro</option>
                        <option value="Rumah Jabatan DK 1">Rumah Jabatan DK 1</option>
                        <option value="Rumah Jabatan DK 2">Rumah Jabatan DK 2</option>
                        <option value="Rumah Jabatan DK 3">Rumah Jabatan DK 3</option>
                        <option value="Rumah Jabatan DK 4">Rumah Jabatan DK 4</option>
                        <option value="Rumah Jabatan DK 5">Rumah Jabatan DK 5</option>
                        <option value="Rumah Jabatan DK 6">Rumah Jabatan DK 6</option>
                        <option value="Rumah Jabatan DK 7">Rumah Jabatan DK 7</option>
                        <option value="Rumah Jabatan DK 8">Rumah Jabatan DK 8</option>
                        <option value="Rumah Jabatan DK 9">Rumah Jabatan DK 9</option>
                        <option value="Gudang Matraman">Gudang Matraman</option>
                        <option value="Gudang Bekasi">Gudang Bekasi</option>
                        <option value="Gudang Salemba">Gudang Salemba</option>
                        <option value="Gudang Cilandak">Gudang Cilandak</option>
                    </select>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="area" value="{{ old('area') }}" placeholder="*Area/Lantai" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="plant" value="{{ old('plant') }}" placeholder="Ruangan">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="manager" value="{{ old('manager') }}" placeholder="*Nama Manager" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="pemohon" value="{{ old('pemohon') }}" placeholder="*Nama Pemohon (PIC Supervisor)" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="tel" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14" name="tel_pemohon" value="{{ old('tel_pemohon') }}" placeholder="*Telepon Pemohon" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="pengawas" value="{{ old('pengawas') }}" placeholder="*Pengawas" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="tel" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14" name="tel_pengawas" value="{{ old('tel_pengawas') }}" placeholder="*Telepon Pengawas" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="k3" value="{{ old('k3') }}" placeholder="Petugas K3">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="tel" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14" name="tel_k3" value="{{ old('tel_k3') }}" placeholder="Telepon Petugas K3">
                </div>
            </div>

            <div class="col ps-1">
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" name="pekerja" value="{{ old('pekerja') }}" placeholder="*Daftar Pekerja ( jumlah )" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" name="enginer" value="{{ old('enginer') }}" placeholder="Enginer">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" name="surveyor" value="{{ old('surveyor') }}" placeholder="Surveyor">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" name="operator_alat" value="{{ old('operator_alat') }}" placeholder="Operator Alat">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" name="rigger" value="{{ old('rigger') }}" placeholder="Rigger">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" name="teknisi_elektrik" value="{{ old('teknisi_elektrik') }}" placeholder="Teknisi Elektrik">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" name="mekanik" value="{{ old('mekanik') }}" placeholder="Mekanik">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" name="welder" value="{{ old('welder') }}" placeholder="Welder">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" name="fitter" value="{{ old('fitter') }}" placeholder="Fitter">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" name="tukang_bangunan" value="{{ old('tukang_bangunan') }}" placeholder="Tukang Bangunan">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" name="tukang_kayu" value="{{ old('tukang_kayu') }}" placeholder="Tukang Kayu">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" name="lainnya" value="{{ old('lainnya') }}" placeholder="Lainnya">
                </div>
                <div class="form-group mb-1 col-md-12" hidden id="foto">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    

                    <div class="input-group custom-file-button">
                    <label class="input-group-text p-1" class="form-control form-control-sm" for="inputGroupFile" style="font-size: 10pt;">Upload KTP</label>
                    <input style="font-size: 10pt;" 
                    name="images[]" 
                    class="form-control form-control-sm p-1" 
                    id="inputGroupFile" 
                    type="file" 
                    accept=".jpg, .jpeg, .png, .bnp" 
                    multiple 
                    onclick="alarm()" />
                  </div>
                </div>
            </div>
        
        </div>

        <div class="mt-4">
            <b>C. Perlengkapan Kerja</b> <br/>
            <font size="1" color="red">*Satu kolom diisi satu barang. Jika lebih dari satu barang klik Tambah Kolom</font><br>
            <div class="mb-1">
             <table class="table table-striped table-hover mx-auto mb-1" style="width: 100%; " id="dynamicAddRemove4">
                <tr align="center">
                    <td class="py-0 align-middle">Alat</td>
                    <td class="py-0 align-middle">Jumlah</td>
                    
                </tr>
                <tr>
                    <td class="p-0 align-middle">
                        <input type="text" name="alat[]" placeholder="Alat" onchange="return comma(event)" id="alats" class="form-control form-control-sm px-1" autocomplete="off" required />
                    </td>
                    <td width="30%" class="py-0 align-middle">
                        <input type="number" name="jml_alat[]" id="jmlalt" onchange="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" placeholder="Jumlah" class="form-control form-control-sm px-1">
                    </td>
                </tr>
            </table>
            <button type="button" name="add" id="dynamic-ar4" class="btn btn-primary btn-sm float-end mb-1">Tambah Kolom</button>
        </div>
        <div class="mb-1">
             <table class="table table-striped table-hover mx-auto mb-1" style="width: 100%; " id="dynamicAddRemove3">
                <tr align="center">
                    <td class="py-0 align-middle">Mesin</td>
                    <td class="py-0 align-middle">Jumlah</td>
                    
                </tr>
                <tr>
                    <td class="p-0 align-middle">
                        <input type="text" name="mesin[]" placeholder="Mesin" onchange="return comma(event)" id="mesin" class="form-control form-control-sm px-1" autocomplete="off" />
                    </td>
                    <td width="30%" class="py-0 align-middle">
                        <input type="number" name="jml_mesin[]" id="jmlmsn" onchange="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" placeholder="Jumlah" class="form-control form-control-sm px-1">
                    </td>
                </tr>
            </table>
            <button type="button" name="add" id="dynamic-ar3" class="btn btn-primary btn-sm float-end mb-1">Tambah Kolom</button>
        </div>
        <div class="mb-1">
            <table class="table table-striped table-hover mx-auto mb-1" style="width: 100%; " id="dynamicAddRemove2">
                <tr align="center">
                    <td class="py-0 align-middle">Material</td>
                    <td class="py-0 align-middle">Jumlah</td>
                    
                </tr>
                <tr>
                    <td class="p-0 align-middle">
                        <input type="text" name="material[]" id="mtr" placeholder="Material" onchange="return comma(event)" class="form-control form-control-sm px-1" autocomplete="off"/>
                    </td>
                    <td width="30%" class="py-0 align-middle">
                        <input type="number" name="jml_material[]" id="jmlmtr" onchange="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" placeholder="Jumlah" class="form-control form-control-sm px-1">
                    </td>
                </tr>
            </table>
            <button type="button" name="add" id="dynamic-ar2" class="btn btn-primary btn-sm float-end mb-1">Tambah Kolom</button>
        </div>
        <div class="mb-1">
            <table class="table table-striped table-hover mx-auto mb-1" style="width: 100%; " id="dynamicAddRemove1">
                <tr align="center">
                    <td class="py-0 align-middle">Alat Berat</td>
                    <td class="py-0 align-middle">Jumlah</td>
                    
                </tr>
                <tr>
                    <td class="p-0 align-middle">
                        <input type="text" name="alat_berat[]" placeholder="Alat Berat" onchange="return comma(event)" id="berat" class="form-control form-control-sm px-1" autocomplete="off"/>
                    </td>
                    <td width="30%" class="py-0 align-middle">
                        <input type="number" name="jml_alber[]" id="jmlbrt" onchange="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" placeholder="Jumlah" class="form-control form-control-sm px-1">
                    </td>
                </tr>
            </table>
            <button type="button" name="add" id="dynamic-ar1" class="btn btn-primary btn-sm float-end mb-1">Tambah Kolom</button>
        </div>
    </div>

    <div class="mt-4">
        <b>D. Keselamatan Kerja</b>
        <div class="mb-1">
            
            <table class="table table-striped table-hover mx-auto mb-1" style="width: 100%; " id="dynamicAddRemove0">
                <tr>
                    <td colspan="3">Bila terjadi keadaan darurat, tindakan yang akan dilakukan ?</td>
                </tr>
                <tr>
                    <td colspan="2"> <label class="mb-0"><input id="biaya1" type="radio" name="biaya" value="Pembiayaan jaminan BPJS" required /> Pembiayaan jaminan BPJS</label></td>
                    <td colspan="2"> <label class="mb-0"><input id="biaya2" type="radio" name="biaya" value="Pembiayaan Pribadi" required /> Pembiayaan Pribadi</label></td>
                </tr>
                <tr align="center">
                    <td class="py-0 align-middle">Aktivitas</td>
                    <td class="py-0 align-middle">Potensi Bahaya</td>
                    <td class="py-0 align-middle">Langkah Aman Pekerjaan</td>
                </tr>
                <tr>
                    <td class="p-0 align-middle">
                        <input type="text" name="aktivitas[]" placeholder="Aktivitas" class="form-control form-control-sm px-1" required/>
                    </td>
                    <td class="p-0 align-middle">
                        <input type="text" name="potensi_bahaya[]" placeholder="Potensi Bahaya" class="form-control form-control-sm px-1" required/>
                    </td>
                    <td class="p-0 align-middle">
                        <input type="text" name="langkah_aman[]" placeholder="Langkah Aman Pekerjaan" class="form-control form-control-sm px-1" required/>
                    </td>
                </tr>

            </table>
            <font size="1" color="red">*Identifikasi bahaya dijadikan sebagai panduan bekerja secara aman dan selamat</font><br>
            <button type="button" name="add" id="dynamic-ar0" class="btn btn-primary btn-sm float-end mb-1">Tambah Kolom</button>
        </div>
    </div>

    <div class="mt-4 overvlow" >
        <b>E. Peralatan Keselamatan</b>
        <table class="table table-striped table-hover table-bordered mx-auto mb-1 " >
            <tr style="font-size: 11pt;">
                <td colspan="3" class="py-0 align-middle">Alat Pelindung Diri</td>
            </tr>
            <tr style="font-size: 10pt; ">
                <td width="auto">
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri1" name="pelindung_diri[]" value="Helm" /> Helm</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri2" name="pelindung_diri[]" value="Kacamata"/> Kacamata</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri3" name="pelindung_diri[]" value="Googles"/> Googles</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri4" name="pelindung_diri[]" value="Tameng Muka"/> Tameng Muka</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri5" name="pelindung_diri[]" value="Kap Las" /> Kap Las</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri6" name="pelindung_diri[]" value="Masker Kain" /> Masker Kain</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri7" name="pelindung_diri[]" value="Masker Kimia" /> Masker Kimia</label>
                    </div>
                </td>
                <td width="auto">
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri8" name="pelindung_diri[]" value="Earplug / Earmuff" /> Earplug/Earmuff</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri9" name="pelindung_diri[]" value="Sarung tangan katun" /> Sarung tangan katun</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri10" name="pelindung_diri[]" value="Sarung tangan karet" /> Sarung tangan karet</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri11" name="pelindung_diri[]" value="Sarung tangan kulit" /> Sarung tangan kulit</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri12" name="pelindung_diri[]" value="Sarung tangan las" /> Sarung tangan las</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri13" name="pelindung_diri[]" value="Sabuk keselamatan" /> Sabuk keselamatan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri14" name="pelindung_diri[]" value="Full body harness" /> Full body harness</label>
                    </div>
                </td>
                <td width="auto">
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri15" name="pelindung_diri[]" value="Pelampung" /> Pelampung</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri16" name="pelindung_diri[]" value="Baju Lab" /> Baju Lab</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri17" name="pelindung_diri[]" value="Sepatu safety" /> Sepatu safety</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri18" name="pelindung_diri[]" value=" Sepatu boots" /> Sepatu boots</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri19" name="pelindung_diri[]" value="SCBA" /> SCBA</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri20" name="pelindung_diri[]" value="Apron" /> Apron</label>
                    </div>
                    {{-- <div>
                        <label class="mb-0"><input type="checkbox" name="pelindung_diri[]" value="Lainnya" />Lainnya</label>
                    </div> --}}
                    <div class="">
                        <div class="col-auto"><label class="mb-0 "><input type="checkbox" onclick="con2()" id="diri21" name="pelindung_diri[]" value="Lainnya" /> Lainnya</label>
                            <input class="form-control form-control-sm px-0 py-0" size="7" type="text" id="lainlain" name="pelindung_diri[]" /></div>
                    </div>
                </td>

            </tr>
            <tr style="font-size: 11pt; ">
                <td colspan="3" class="py-0 align-middle" style="word-wrap: normal;" > Perlengkapan Keselamatan</td>
            </tr>
            <tr style="font-size: 10pt; ">
                <td colspan="3">
                    <div>
                        <label class="mb-0"><input type="checkbox" id="pan1" name="perlengkapan[]" onclick="kap()" value="Alat Pemadam" /> Alat Pemadam</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" id="pan2" name="perlengkapan[]" onclick="kap()" value="Barikade (safety line)" /> Barikade (safety line)</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" id="pan3" name="perlengkapan[]" onclick="kap()" value="Rambu keselamatan" /> Rambu keselamatan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" id="pan4" name="perlengkapan[]" onclick="kap()" value="LOTO" /> LOTO</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" id="pan5" name="perlengkapan[]" onclick="kap()" value="Radio HT" /> Radio HT</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" id="pan6" name="perlengkapan[]" onclick="kap()" value="Jaring" /> Jaring</label>
                    </div>
                    {{-- <div>
                        <label class="mb-0"><input type="checkbox" name="perlengkapan[]" value="Lainnya" /> Lainnya</label>
                    </div> --}}

                    <div class="d-flex">
                        <label class="mb-0 pe-2"><input type="checkbox" id="pan7" name="perlengkapan[]" onclick="kap()" value="Lainnya" /> Lainnya </label>
                        <div class="col-auto col-md-7"><input class="form-control form-control-sm px-0 py-0" type="text" id="lainlain2" name="perlengkapan[]" /></div>
                    </div>
                </td>
            </tr>
        </table>
            <font size="1" color="red">*Semua perlengkapan kerja dan peralatan keselamatan akan diperiksa oleh Petugas K3 pada saat pekerjaan berlangsung</font><br>
    </div>
                <center>
                    <button type="submit" class="btn btn-primary mt-2" id="sbmt" style ="text-align:center">
                        {{ __('Simpan') }}
                    </button>
                </center>
</form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 function loding(form){
    Swal.fire({
          title: "Are you sure?",
          text: "Pastikan seluruh data benar dan lengkap",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Batal",
          confirmButtonText: "Kirim"
        }).then((result) => {
          if (result.isConfirmed) {
        form.submit();
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang validasi data",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });  
          }
        });
    return false;
 }
</script>
<script>
const clas9 = document.querySelector('#clas9');
const nilain = document.querySelector('#nilain');
// nilain.disabled = true;
// nilain.style.visibility = 'hidden';

clas9.addEventListener('change', () => {
  if (clas9.checked) {
    $("#nilain").removeAttr('hidden');
    nilain.value = '';
    nilain.name = 'klasifikasi[]';
    nilain.required= true;
    nilain.disabled = false;
  } else {
    nilain.disabled = true;
    nilain.required = false;
    $("#nilain").prop('hidden', true);
    nilain.name = '';
  }
});
</script>

<script>
 // $("#perusahaan").prop('disabled',true);
 // $("#perusahaan").prop('hidden', true);
    $("#perusahaan_pemohon").change(function() {
console.log($("#perusahaan_pemohon").val())
if ($("#perusahaan_pemohon option:selected").val() == "Lainnya") {
            $("#perusahaan_pemohon").attr('name', 'perusahaan_pemohon[]');
            $("#perusahaan").attr('name', 'perusahaan_pemohon[]');
            $("#perusahaan").removeAttr('disabled');
            $("#perusahaan").prop('required',true);
            $("#perusahaan").removeAttr('hidden');
            $("#foto").removeAttr('hidden');
            $("#inputGroupFile").prop('required',true);
       } else {
            $("#perusahaan_pemohon").attr('name', 'perusahaan_pemohon');
            $("#perusahaan").removeAttr('name');
            $("#perusahaan").prop('disabled', true);
            $("#perusahaan").prop('required', false);
            $("#perusahaan").prop('hidden', true);
            $("#inputGroupFile").prop('required', false);
            $("#foto").prop('hidden', true);
       }
    }); 

function alarm() {
    alert("Upload foto sesuai dengan jumlah pekerja !");
}
// const perusahaan_pemohon = document.querySelector('#perusahaan_pemohon');
// const perusahaan = document.querySelector('#perusahaan');
// perusahaan.disabled = true;
// perusahaan.style.visibility = 'hidden';

// perusahaan_pemohon.addEventListener('change', () => {
//   if (perusahaan_pemohon.selected) {
//     perusahaan.style.visibility = 'visible';
//     perusahaan.value = '';
//     perusahaan.name = 'klasifikasi[]';
//     perusahaan.required= true;
//     perusahaan.disabled = false;
//   } else {
//     perusahaan.disabled = true;
//     perusahaan.required = false;
//     perusahaan.style.visibility = 'hidden';
//     perusahaan.name = '';
//   }
// });
</script>

<script>
const diri21 = document.querySelector('#diri21');
const lainlain = document.querySelector('#lainlain');
lainlain.disabled = true;
lainlain.style.visibility = 'hidden';

diri21.addEventListener('change', () => {
  if (diri21.checked) {
    lainlain.style.visibility = 'visible';
    lainlain.value = '';
    lainlain.name = 'pelindung_diri[]';
    lainlain.required= true;
    lainlain.disabled = false;
  } else {
    lainlain.disabled = true;
    lainlain.required = false;
    lainlain.style.visibility = 'hidden';
    lainlain.name = '';
  }
});
</script>
<script>
const pan7 = document.querySelector('#pan7');
const lainlain2 = document.querySelector('#lainlain2');
lainlain2.disabled = true;
lainlain2.style.visibility = 'hidden';

pan7.addEventListener('change', () => {
  if (pan7.checked) {
    lainlain2.style.visibility = 'visible';
    lainlain2.value = '';
    lainlain2.name = 'perlengkapan[]';
    lainlain2.required= true;
    lainlain2.disabled = false;
  } else {
    lainlain2.disabled = true;
    lainlain2.required = false;
    lainlain2.style.visibility = 'hidden';
    lainlain2.name = '';
  }
});
</script>
<script type="text/javascript">
    function angka(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar4").click(function () {
        ++i;
        $("#dynamicAddRemove4").append('<tr><td class="p-0 align-middle"><input id="alat'+i+'" type="text" name="alat[]" placeholder="Alat" class="form-control form-control-sm px-1" required/></td><td width="30%" class="py-0 align-middle"><input type="number" name="jml_alat[]" onchange="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" placeholder="Jumlah" class="form-control form-control-sm px-1" required></td><td class="p-0 align-middle" style="width: 0px;"><button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center remove-input-field"></button></td></tr>'
            );
    
    $("#alat"+i).on('change', function() {
        if($("#alat"+i).val().includes(",")){
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Hindari tanda simbol (koma, titik, dll) !",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Oke"
            }).then((result) => {
          if (result.isConfirmed) {
                
              $("#alat"+i).val("");
          
          }
      });
        }
    });
});
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar3").click(function () {
        ++i;
        $("#dynamicAddRemove3").append('<tr><td class="p-0 align-middle"><input type="text" id="mesin'+i+'" name="mesin[]" placeholder="Mesin" class="form-control form-control-sm px-1" required/></td><td width="30%" class="py-0 align-middle"><input type="number" name="jml_mesin[]" onchange="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" placeholder="Jumlah" class="form-control form-control-sm px-1" required></td><td class="p-0 align-middle" style="width: 0px;"><button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center remove-input-field"></button></td></tr>'
            );

    $("#mesin"+i).on('change', function() {
        if($("#mesin"+i).val().includes(",")){
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Hindari tanda simbol (koma, titik, dll) !",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Oke"
            }).then((result) => {
          if (result.isConfirmed) {
                
              $("#mesin"+i).val("");
          
          }
      });
        }
    });
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar2").click(function () {
        ++i;
        $("#dynamicAddRemove2").append('<tr><td class="p-0 align-middle"><input type="text" id="materi'+i+'" name="material[]" placeholder="Material" class="form-control form-control-sm px-1" required/></td><td width="30%" class="py-0 align-middle"><input type="number" name="jml_material[]" onchange="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" placeholder="Jumlah" class="form-control form-control-sm px-1" required></td><td class="p-0 align-middle" style="width: 0px;"><button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center remove-input-field"></button></td></tr>'
            );

        $("#materi"+i).on('change', function() {
            if($("#materi"+i).val().includes(",")){
                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Hindari tanda simbol (koma, titik, dll) !",
                  showCancelButton: false,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  confirmButtonText: "Oke"
                }).then((result) => {
              if (result.isConfirmed) {
                    
                  $("#materi"+i).val("");
              
              }
          });
            }
        });
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar1").click(function () {
        ++i;
        $("#dynamicAddRemove1").append('<tr><td class="p-0 align-middle"><input type="text" id="berat'+i+'" name="alat_berat[]" placeholder="Alat Berat" class="form-control form-control-sm px-1" required/></td><td width="30%" class="py-0 align-middle"><input type="number" name="jml_alber[]" onchange="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="1" placeholder="Jumlah" class="form-control form-control-sm px-1" required></td><td class="p-0 align-middle" style="width: 0px;"><button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center remove-input-field"></button></td></tr>'
            );

        $("#berat"+i).on('change', function() {
            if($("#berat"+i).val().includes(",")){
                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Hindari tanda simbol (koma, titik, dll) !",
                  showCancelButton: false,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  confirmButtonText: "Oke"
                }).then((result) => {
              if (result.isConfirmed) {
                    
                  $("#berat"+i).val("");
              
              }
          });
            }
        });
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar0").click(function () {
        ++i;
        $("#dynamicAddRemove0").append('<tr><td class="p-0 align-middle"><input type="text" name="aktivitas[]" placeholder="Aktivitas" class="form-control form-control-sm px-1" required/></td><td class="p-0 align-middle"><input type="text" name="potensi_bahaya[]" placeholder="Potensi Bahaya" class="form-control form-control-sm px-1" required/></td><td class="p-0 align-middle"><input type="text" name="langkah_aman[]" placeholder="Langkah Aman Pekerjaan" class="form-control form-control-sm px-1" required/></td><td class="p-0 align-middle" style="width: 0px;"><button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center remove-input-field"></button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
<script>
   
       var c1 = document.getElementById("clas1");
       var c2 = document.getElementById("clas2");
       var c3 = document.getElementById("clas3");
       var c4 = document.getElementById("clas4");
       var c5 = document.getElementById("clas5");
       var c6 = document.getElementById("clas6");
       var c7 = document.getElementById("clas7");
       var c8 = document.getElementById("clas8");
       var c9 = document.getElementById("clas9");

c1.required = true;
c2.required = true;
c3.required = true;
c4.required = true;
c5.required = true;
c6.required = true;
c7.required = true;
c8.required = true;
c9.required = true;

 function firm(){
    if ((c1.checked || c2.checked || c3.checked || c4.checked || c5.checked || c6.checked || c7.checked || c8.checked || c9.checked) === true) {
        c1.required = false;
        c2.required = false;
        c3.required = false;
        c4.required = false;
        c5.required = false;
        c6.required = false;
        c7.required = false;
        c8.required = false;
        c9.required = false;
    } else {
        c1.required = true;
        c2.required = true;
        c3.required = true;
        c4.required = true;
        c5.required = true;
        c6.required = true;
        c7.required = true;
        c8.required = true;
        c9.required = true;
    }

 }
</script>
{{-- <script type="text/javascript">

       var dr1 = document.getElementById("diri1");
       var dr2 = document.getElementById("diri2");
       var dr3 = document.getElementById("diri3");
       var dr4 = document.getElementById("diri4");
       var dr5 = document.getElementById("diri5");
       var dr6 = document.getElementById("diri6");
       var dr7 = document.getElementById("diri7");

         dr1.required = true;
         dr2.required = true;
         dr3.required = true;
         dr4.required = true;
         dr5.required = true;
         dr6.required = true;
         dr7.required = true;

function con(){
       if ((dr1.checked || dr2.checked || dr3.checked || dr4.checked || dr5.checked || dr6.checked || dr7.checked ) === true ){
         dr1.required = false;
         dr2.required = false;
         dr3.required = false;
         dr4.required = false;
         dr5.required = false;
         dr6.required = false;
         dr7.required = false;

    } else {
        dr1.required = true;
         dr2.required = true;
         dr3.required = true;
         dr4.required = true;
         dr5.required = true;
         dr6.required = true;
         dr7.required = true;
    }
}
</script> --}}
{{-- <script type="text/javascript">
   var dr8 = document.getElementById("diri8");
   var dr9 = document.getElementById("diri9");
   var dr10 = document.getElementById("diri10");
   var dr11 = document.getElementById("diri11");
   var dr12 = document.getElementById("diri12");
   var dr13 = document.getElementById("diri13");
   var dr14 = document.getElementById("diri14");

    dr8.required = true;
    dr9.required = true;
    dr10.required = true;
    dr11.required = true;
    dr12.required = true;
    dr13.required = true;
    dr14.required = true;


    function con1(){
        if ((dr8.checked || dr9.checked || dr10.checked || dr11.checked || dr12.checked || dr13.checked || dr14.checked) === true ) {
         dr8.required = false;
         dr9.required = false;
        dr10.required = false;
        dr11.required = false;
        dr12.required = false;
        dr13.required = false;
        dr14.required = false;
    } else {
        dr8.required = true;
        dr9.required = true;
        dr10.required = true;
        dr11.required = true;
        dr12.required = true;
        dr13.required = true;
        dr14.required = true;
    }
}

</script> --}}
<script type="text/javascript">
   var dr1 = document.getElementById("diri1");
   var dr2 = document.getElementById("diri2");
   var dr3 = document.getElementById("diri3");
   var dr4 = document.getElementById("diri4");
   var dr5 = document.getElementById("diri5");
   var dr6 = document.getElementById("diri6");
   var dr7 = document.getElementById("diri7");
   var dr8 = document.getElementById("diri8");
   var dr9 = document.getElementById("diri9");
   var dr10 = document.getElementById("diri10");
   var dr11 = document.getElementById("diri11");
   var dr12 = document.getElementById("diri12");
   var dr13 = document.getElementById("diri13");
   var dr14 = document.getElementById("diri14");
   var dr15 = document.getElementById("diri15");
   var dr16 = document.getElementById("diri16");
   var dr17 = document.getElementById("diri17");
   var dr18 = document.getElementById("diri18");
   var dr19 = document.getElementById("diri19");
   var dr20 = document.getElementById("diri20");
   var dr21 = document.getElementById("diri21");

     dr1.required = true;
     dr2.required = true;
     dr3.required = true;
     dr4.required = true;
     dr5.required = true;
     dr6.required = true;
     dr7.required = true;
     dr8.required = true;
     dr9.required = true;
    dr10.required = true;
    dr11.required = true;
    dr12.required = true;
    dr13.required = true;
    dr14.required = true;
    dr15.required = true;
    dr16.required = true;
    dr17.required = true;
    dr18.required = true;
    dr19.required = true;
    dr20.required = true;
    dr21.required = true;

    function con2(){
        if ((dr1.checked || dr2.checked || dr3.checked || dr4.checked || dr5.checked || dr6.checked || dr7.checked || dr8.checked || dr9.checked || dr10.checked || dr11.checked || dr12.checked || dr13.checked || dr14.checked || dr15.checked || dr16.checked || dr17.checked || dr18.checked || dr19.checked || dr20.checked || dr21.checked) === true ) {
         dr1.required = false;
         dr2.required = false;
         dr3.required = false;
         dr4.required = false;
         dr5.required = false;
         dr6.required = false;
         dr7.required = false;
         dr8.required = false;
         dr9.required = false;
        dr10.required = false;
        dr11.required = false;
        dr12.required = false;
        dr13.required = false;
        dr14.required = false;
        dr15.required = false;
        dr16.required = false;
        dr17.required = false;
        dr18.required = false;
        dr19.required = false;
        dr20.required = false;
        dr21.required = false;
    } else {
         dr1.required = true;
         dr2.required = true;
         dr3.required = true;
         dr4.required = true;
         dr5.required = true;
         dr6.required = true;
         dr7.required = true;
         dr8.required = true;
         dr9.required = true;
        dr10.required = true;
        dr11.required = true;
        dr12.required = true;
        dr13.required = true;
        dr14.required = true;
        dr15.required = true;
        dr16.required = true;
        dr17.required = true;
        dr18.required = true;
        dr19.required = true;
        dr20.required = true;
        dr21.required = true;
    }
}
</script>
<script type="text/javascript">

   var kpan1 = document.getElementById("pan1");
   var kpan2 = document.getElementById("pan2");
   var kpan3 = document.getElementById("pan3");
   var kpan4 = document.getElementById("pan4");
   var kpan5 = document.getElementById("pan5");
   var kpan6 = document.getElementById("pan6");
   var kpan7 = document.getElementById("pan7");

         kpan1.required = true;
         kpan2.required = true;
         kpan3.required = true;
         kpan4.required = true;
         kpan5.required = true;
         kpan6.required = true;
         kpan7.required = true;

function kap(){
        if ((kpan1.checked || kpan2.checked || kpan3.checked || kpan4.checked || kpan5.checked || kpan6.checked || kpan7.checked ) === true) {
        kpan1.required = false;
        kpan2.required = false;
        kpan3.required = false;
        kpan4.required = false;
        kpan5.required = false;
        kpan6.required = false;
        kpan7.required = false;
    } else {
        kpan1.required = true;
        kpan2.required = true;
        kpan3.required = true;
        kpan4.required = true;
        kpan5.required = true;
        kpan6.required = true;
        kpan7.required = true;
    }
    }
</script>

<script type="text/javascript">
$("#alats").change(function() {
        if ($("#alats").val().length === 0) {
            $("#jmlalt").prop('required',false);
            $("#alats").prop('required',true);

        }  else {
            $("#jmlalt").prop('required',true);
            $("#alats").prop('required',false);
        }
    }); 

    $("#mesin").change(function() {
        if ($("#mesin").val().length === 0) {
            $("#jmlmsn").prop('required',false);
        }  else {
            $("#jmlmsn").prop('required',true);
        }
    }); 

    $("#mtr").change(function() {
        if ($("#mtr").val().length === 0) {
            $("#jmlmtr").prop('required',false);
        }  else {
            $("#jmlmtr").prop('required',true);
        }
    }); 

    $("#berat").change(function() {
        if ($("#berat").val().length === 0) {
            $("#jmlbrt").prop('required',false);
        }  else {
            $("#jmlbrt").prop('required',true);
        }
    }); 
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    function comma(evt) {

        if($("#alats").val().includes(',')){
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Hindari tanda simbol (koma, titik, dll) !",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Oke"
            }).then((result) => {
          if (result.isConfirmed) {
                
              $("input[name='alat[]']").val("");
          
          }
      });
        }

        if($("#mesin").val().includes(',')){
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Hindari tanda simbol (koma, titik, dll) !",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Oke"
            }).then((result) => {
          if (result.isConfirmed) {
                
              $("#mesin").val("");
          
          }
      });
        }

        if($("#mtr").val().includes(',')){
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Hindari tanda simbol (koma, titik, dll) !",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Oke"
            }).then((result) => {
          if (result.isConfirmed) {
                
              $("#mtr").val("");
          
          }
      });
        }

        if($("#berat").val().includes(',')){
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Hindari tanda simbol (koma, titik, dll) !",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Oke"
            }).then((result) => {
          if (result.isConfirmed) {
                
              $("#berat").val("");
          
          }
      });
        }



}
</script>
<script>
// $(document).ready(function(){
//     if ($("#:contains(,)")){
//   $("#:contains(,)").css("background-color", "yellow");

//     }
// });
</script>

@endsection
