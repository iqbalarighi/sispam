@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bold">{{ __('Form Layanan Kelogistikan') }}</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}
        <form action="" method="post" enctype="multipart/form-data" onsubmit="return loding(this);">
            @csrf
            <div class="">
                <div class="fw-bold">Jenis Layanan</div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen1" name="jenis[]" required onclick="check()" value="Izin Loading Barang">
                    <label for="jen1">Izin Loading Barang</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen2" name="jenis[]" required onclick="check()" value="Pengamanan Kegiatan/Acara">
                    <label for="jen2">Pengamanan Kegiatan/Acara</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen3" name="jenis[]" required onclick="check()" value="Pengawalan">
                    <label for="jen3">Pengawalan</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen4" name="jenis[]" required onclick="check()" value="Parkir">
                    <label for="jen4">Parkir</label>
                </div>
                <div class="d-flex form-check" style="margin-top: -2px;">
                    <input type="checkbox" class="form-check-input " id="jen5" name="jenis[]" required onclick="check()" value="Lain-lain :">
                    <label for="jen5" class="px-2" style="margin-top: 2px;">Lain-lain</label>
                    <input class="form-control form-control-sm px-1" style="width: 200px;" type="text" id="nilain" name="jenis[]" />
                </div>
            </div>
            <div class="mt-2">
                <div>
                    Uraian
                </div>
                <div class="form-floating">
                    <input type="datetime-local" class="form-control" id="mulai" name="" value="" required>
                    <label for="mulai">Tanggal dan Waktu</label>
                </div>
                <div class="form-floating">
                  <input class="form-control form-control-sm" placeholder="Leave a comment here" id="uraian" name="uraian" required>
                  <label for="uraian">Tempat</label>
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
                <input class="form-control form-control-sm" type="text" name="nmr" onkeypress="return angka(event)" id="nmr" maxlength="14" placeholder="" required>
                <label for="nmr">Nomor Telepon</label>
            </div>
            <div class="form-floating">
                <input class="form-control form-control-sm" type="email" name="email" id="mail" placeholder="" pattern=".[^@\s]+@[^@\s]+\.[^@\s]+" autocomplete="off" required>
                <label for="mail">Email</label>
            </div>
            </div>
            <div class="mt-2">
                <div>
                    <input type="file" name="foto" class="form-control form-control-sm" accept=".jpg, .jpeg, .png" multiple required>
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
const jen5 = document.querySelector('#jen5');
const nilain = document.querySelector('#nilain');
nilain.disabled = true;
nilain.style.visibility = 'hidden';

jen5.addEventListener('change', () => {
  if (jen5.checked) {
    nilain.style.visibility = 'visible';
    nilain.value = '';
    nilain.name = 'jenis[]';
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


jns1.required = true;
jns2.required = true;
jns3.required = true;
jns4.required = true;
jns5.required = true;

 function check(){
    if ((jns1.checked || jns2.checked || jns3.checked || jns4.checked || jns5.checked) === true) {
        jns1.required = false;
        jns2.required = false;
        jns3.required = false;
        jns4.required = false;
        jns5.required = false;
    } else {
        jns1.required = true;
        jns2.required = true;
        jns3.required = true;
        jns4.required = true;
        jns5.required = true;
    }

 }
</script>
@endsection