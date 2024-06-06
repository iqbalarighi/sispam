@extends('layouts.app')

@section('content')

<style type="text/css">
    .cen {
    height: auto;
    margin-top: 40%;
}
</style>
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
<div class="container">

@if (session('Open'))
    @if ( Carbon\Carbon::now()->isoFormat('HHmmss') >= 200000)
    <script>
        Swal.fire({
          icon: "warning",
          title: "{{ session('Open') }}",
          showConfirmButton: false,
          timer: 1500
        })

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
                @elseif (Carbon\Carbon::now()->isoFormat('HHmmss') <= 80000)
    <script>
        Swal.fire({
          icon: "warning",
          title: "{{ session('Open') }}",
          showConfirmButton: false,
          timer: 1500
        })

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
          icon: "warning",
          title: "{{ session('Open') }}",
          showConfirmButton: false,
          timer: 1500
        })

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

@if(session('Done'))
<script type="text/javascript">
    Swal.fire({
      icon: "success",
      title: "{{ session('Done') }}",
      showConfirmButton: true,
      // timer: 1500
    });

</script>
@endif

@if(session('Continued'))
    <script type="text/javascript">
        Swal.fire({
          icon: "success",
          title: "{{ session('Continued') }}",
          showConfirmButton: false,
          timer: 1500
        });

        setTimeout(function () {
                Swal.fire({
                title: "Loading . . . ",
                text: "Sedang Dialihkan ke Halaman Form Izin",
                showConfirmButton: false, 
                allowOutsideClick: false,
                  didOpen: () => {
                    Swal.showLoading();
                  setTimeout(function() {
                window.location = "{{route('form_izin')}}";
                    }, 2000);  
                }
                }); 
            }, 1700); 
    </script>
@endif

@if(session('notfind'))
<script type="text/javascript">
    Swal.fire({
  icon: "error",
  title: "Oops...",
  html: `
    <b>{{session('notfind')}}</b> <br/>
    Pastikan Nomor Dokumen Yang Anda Masukkan Benar!
  `,
});
</script>
@endif


    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card cen">
                <div class="card-header fw-bold">{{ __('Update Status Pekerjaan') }}
                    @if($update != null)
                    <a href="{{url('update_pekerjaan')}}"><span class="btn btn-primary float-end btn-sm mx-2 py-0">Kembali</span></a>
                    @endif
                </div>

                <div class="card-body ">
                    <form 
                    action="{{$update == null ? "" : url("update_pekerjaan/".$update->izin_id)}}" 
                    onsubmit="{{$update == null ? 'return loads()' : 'return load()'}}" 
                    method="{{$update == null ? "" : "post"}}" 
                    enctype="multipart/form-data"
                    >
                        @csrf
                        @if($update != null)
                            @method('PUT')
                        @endif
                    @if($update == null)
                    <div>
                        Nomor Dokumen
                        <input id="noid" type="text" name="izinid" class="form-control upjaan" placeholder="Contoh : SIPR-XXXX-XXXX" minlength="14" onchange="" required autocomplete="off">
                    </div>
                    @endif
                    @if($update != null)
                    <div>
                        <table width="100%" >
                            <tr>
                                <td width="30%">Nama Perusahaan</td>
                                <td width="10%">:</td>
                                <td>{{$update->izin_informasi->perusahaan_pemohon}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Pekerjaan</td>
                                <td width="10%">:</td>
                                <td>{{$update->izin_informasi->pekerjaan}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Lokasi</td>
                                <td width="10%">:</td>
                                <td>{{$update->izin_informasi->lokasi}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Area</td>
                                <td width="10%">:</td>
                                <td>{{$update->izin_informasi->area}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Status</td>
                                <td width="10%">:</td>
                                <td>{{$update->status}}</td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <select name="status" class="form-select form-select-sm" required>
                            <option selected value="" disabled>#Pilih Status Pekerjaan#</option>
                            <option value="Done">Selesai</option>
                            <option value="Continued">Belum Selesai</option>
                        </select>
                    </div>
                    <div class="input-group custom-file-button mt-1">
                        {{-- <label for="foto">Upload Foto : </label> --}}
                        <label class="input-group-text p-1" class="form-control form-control-sm" for="foto" style="font-size: 10pt;">Foto Pekerjaan</label>
                        <input type="file" class="form-control form-control-sm" accept=".jpeg, .jpg, .png" name="images[]" id="foto" multiple>
                    </div>
                    <div class="form-floating mt-1">
                      <textarea class="form-control" placeholder="Leave a comment here" id="ket" style="height: 60px;" name="ket"></textarea>
                      <label for="ket">Keterangan</label>
                    </div>
                    @endif





                    <div align="center">
                    <button type="submit" class="text-center btn btn-sm btn-primary mt-2 data-swal-template">Kirim</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function load() {

            var $fileUpload = $("input[type='file']");
            if (parseInt($fileUpload.get(0).files.length)>2){
                 Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Maksimal upload 2 foto",
                });

             return false;
            };

                Swal.fire({
            title: "Loading . . . ",
            text: "Sedang validasi data",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
            }
            }); 
    }
</script>
<script type="text/javascript">
    function loads() {
                Swal.fire({
            title: "Mohon Menunggu . . . ",
            text: "Sedang Mencari dokumen . . .",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
            }
            }); 
    }
</script>
<script>
  var path = "{{ route('upja')  }}";
  $('input.upjaan').typeahead({
      source:  function (query, process) {
      return $.get(path, { term: query }, function (data) {
              return process(data);
          });
      }
  });
</script>

@endsection