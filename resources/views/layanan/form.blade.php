@extends('layouts.app')

@section('content')
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
{{-- @if (Session::get('sukses'))
<script type="text/javascript">
    Swal.fire({
  icon: "success",
  title: "{{Session::get('sukses')}}",
  showConfirmButton: false,
  timer: 1500,
});
</script>
@endif --}}

        @if (session('sukses'))
            {{-- @if ( Carbon\Carbon::now()->isoFormat('HHmmss') >= 200000 || Carbon\Carbon::now()->isoFormat('HHmmss') <= 80000) --}}
                <script>
                Swal.fire({
                  title: "Berhasil",
                  text:  "{{ session('sukses') }}",
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
                        <a aria-label="Chat on WhatsApp" target="_blank" href="https://wa.me/628119809606?text=Halo%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20terkait%20dokumen%20kami%20dengan%20nomor%20dokumen%20{{session('id')}}.%20Terima%20Kasih.%0A%0Ahttp%3A%2F%2Fwww.sispam.id%2Flayanan%2Fdetail%2F{{session('id')}}">
                        <img alt="Chat on WhatsApp" width="225px" src="https://static.xx.fbcdn.net/assets/?revision=947305627097899&name=platform-agnostic-green-medium-en-us&density=1" />
                        <a />
                      `,
                  showConfirmButton: false,
                  allowOutsideClick: false,

                        });
            }, 1700); 
                
        </script>
{{--             @else
               <script>
                Swal.fire({
                  title: "Berhasil",
                  text:  "{{ session('sukses') }}",
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
                        <a aria-label="Chat on WhatsApp" target="_blank" href="https://wa.me/6285223442696?text=Halo%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20terkait%20dokumen%20kami%20dengan%20nomor%20dokumen%20{{session('id')}}.%20Terima%20Kasih.%0A%0Ahttp%3A%2F%2Fwww.sispam.id%2Flayanan%2Fdetail%2F{{session('id')}}">
                        <img alt="Chat on WhatsApp" width="225px" src="https://static.xx.fbcdn.net/assets/?revision=947305627097899&name=platform-agnostic-green-medium-en-us&density=1" />
                        <a />
                      `,
                  showConfirmButton: false,
                  allowOutsideClick: false,

                        });
            }, 1700); 
                
        </script>
            @endif --}}
    @endif





<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bold text-center">{{ __('Form Layanan Kelogistikan') }}</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}
        <form action="{{route('store_layanan')}}" method="POST" enctype="multipart/form-data" onsubmit="return loding(this);">
            @csrf
            <div class="">
                <div class="fw-bold">Jenis Layanan</div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen1" name="layanan[]" required onclick="check()" value="Izin Loading Barang">
                    <label class="m-0" for="jen1">Izin Loading Barang</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen2" name="layanan[]" required onclick="check()" value="Pengamanan Kegiatan/Acara">
                    <label class="m-0" for="jen2">Pengamanan Kegiatan/Acara</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen3" name="layanan[]" required onclick="check()" value="Pengawalan">
                    <label class="m-0" for="jen3">Pengawalan</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen4" name="layanan[]" required onclick="check()" value="Parkir">
                    <label class="m-0" for="jen4">Parkir</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen5" name="layanan[]" required onclick="check()" value="Peminjaman Mobil">
                    <label class="m-0" for="jen5">Peminjaman Mobil</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen6" name="layanan[]" required onclick="check()" value="Peminjaman Ruangan">
                    <label class="m-0" for="jen6">Peminjaman Ruangan</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen7" name="layanan[]" required onclick="check()" value="Permintaan Fasilitas Kerja">
                    <label class="m-0" for="jen7">Permintaan Fasilitas Kerja</label>
                </div>
                <div class="d-flex form-check" style="margin-top: -2px;">
                    <input type="checkbox" class="form-check-input " id="jen8" name="layanan[]" required onclick="check()" value="Lain-lain :">
                    <label class="m-0 pe-2" for="jen8" class="px-2" style="margin-top: 2px;">Lain-lain</label>
                    <input class="form-control form-control-sm px-1" style="width: 200px;" type="text" id="nilain" name="layanan[]" />
                </div>
            </div>
            <div class="mt-2">
                <div>
                    <b> Uraian </b>
                </div>
                <div class="form-floating">
                    <input type="datetime-local" class="form-control form-control-sm" id="waktu" name="waktu" value="" required>
                    <label for="waktu">Tanggal dan Waktu</label>
                </div>
                <div class="form-floating">
                  <textarea class="form-control form-control-sm" placeholder="Leave a comment here" id="detail" style="height: 100px;" name="detail" required></textarea>
                  <label for="detail">Detail Kebutuhan</label>
                </div>
                {{--<div class="form-floating">
                  <input class="form-control form-control-sm" placeholder="Leave a comment here" id="uraian" name="uraian">
                  <label for="uraian">Tempat</label>
                </div> --}}
            <div class="form-floating">
                <input class="form-control form-control-sm" type="text" name="pic" id="pic" placeholder="" required>
                <label for="pic">Nama PIC</label>
            </div>
            <div class="form-floating">
                <input class="form-control form-control-sm" type="text" name="satker" id="satker" placeholder="" required>
                <label for="satker">Satker</label>
            </div>
            <div class="form-floating">
                <input class="form-control form-control-sm" type="number" name="kontak" onkeypress="return angka(event)" id="kontak" maxlength="14" placeholder="" required>
                <label for="kontak">Nomor Kontak/WhatsApp</label>
            </div>
            <div class="form-floating">
                <input class="form-control form-control-sm" type="email" name="email" id="mail" placeholder="" pattern=".[^@\s]+@[^@\s]+\.[^@\s]+" autocomplete="off" required>
                <label for="mail">Email</label>
            </div>
            </div>
            <div class="mt-2">
                    <div class="input-group custom-file-button mt-1">
                        <label class="input-group-text p-1" class="form-control form-control-sm" for="foto" style="font-size: 10pt;">Upload Foto</label>
                        <input type="file" class="form-control form-control-sm" accept=".jpeg, .jpg, .png" name="images[]" id="foto" multiple>
                    </div>
            </div>

            <div class="text-center mt-2">
                <button type="submit" class="btn btn-primary ">Kirim</button>
            </div>
        </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
$("#kontak").on("input change paste",
function filterNumericAndDecimal(event) {
    var formControl;
    formControl = $(event.target);
    var newtext = formControl.val().replace(/[^0-9]+/g, "");
    formControl.val(''); //without this the DOT will not go away on my phone!
    formControl.val(newtext);
});
</script>
<script type="text/javascript">
 function loding(form){
    Swal.fire({
          title: "Sudah Yakin ?",
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
const jen8 = document.querySelector('#jen8');
const nilain = document.querySelector('#nilain');
nilain.disabled = true;
nilain.style.visibility = 'hidden';

jen8.addEventListener('change', () => {
  if (jen8.checked) {
    nilain.style.visibility = 'visible';
    nilain.value = '';
    nilain.name = 'layanan[]';
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
   
       var jns1 = document.getElementById("jen1");
       var jns2 = document.getElementById("jen2");
       var jns3 = document.getElementById("jen3");
       var jns4 = document.getElementById("jen4");
       var jns5 = document.getElementById("jen5");
       var jns6 = document.getElementById("jen6");
       var jns7 = document.getElementById("jen7");
       var jns8 = document.getElementById("jen8");


jns1.required = true;
jns2.required = true;
jns3.required = true;
jns4.required = true;
jns5.required = true;
jns6.required = true;
jns7.required = true;
jns8.required = true;

 function check(){
    if ((jns1.checked || jns2.checked || jns3.checked || jns4.checked || jns5.checked || jns6.checked || jns7.checked || jns8.checked) === true) {
        jns1.required = false;
        jns2.required = false;
        jns3.required = false;
        jns4.required = false;
        jns5.required = false;
        jns6.required = false;
        jns7.required = false;
        jns8.required = false;
    } else {
        jns1.required = true;
        jns2.required = true;
        jns3.required = true;
        jns4.required = true;
        jns5.required = true;
        jns6.required = true;
        jns7.required = true;
        jns8.required = true;
    }

 }
</script>
@endsection