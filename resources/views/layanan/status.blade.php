@extends('layouts.app')

@section('content')

<style type="text/css">
    .cen {
    height: auto;
    margin-top: 40%;
}
</style>

<div class="container">

@if (session('Open'))
    {{-- @if (Carbon\Carbon::now()->isoFormat('HHmmss') >= 200000 || Carbon\Carbon::now()->isoFormat('HHmmss') <= 80000) --}}
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
                            <a aria-label="Chat on WhatsApp" target="_blank" href="https://wa.me/628119809606?text=Halo%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20terkait%20dokumen%20kami%20dengan%20nomor%20dokumen%20{{session('id')}}.%20Terima%20Kasih.%0A%0Ahttp%3A%2F%2Fwww.sispam.id%2Flayanan%2Fdetail%2F{{session('id')}}">
                            <img alt="Chat on WhatsApp" width="225px" src="https://static.xx.fbcdn.net/assets/?revision=947305627097899&name=platform-agnostic-green-medium-en-us&density=1" />
                            <a />
                          `,
                      showConfirmButton: false,
                      allowOutsideClick: false,

                            });
                }, 1700); 
            
    </script>

@endif

@if(session('selesai'))
<script type="text/javascript">
    Swal.fire({
      icon: "success",
      title: "{{ session('selesai') }}",
      showConfirmButton: false,
      timer: 4000
    });

</script>
@endif

@if(session('Closed'))
    <script type="text/javascript">
        Swal.fire({
          icon: "success",
          title: "{{ session('Closed') }}",
          showConfirmButton: false,
          timer: 1500
        });

        setTimeout(function () {
                Swal.fire({
                title: "Loading . . . ",
                text: "Sedang Dialihkan ke Halaman Survei",
                showConfirmButton: false, 
                allowOutsideClick: false,
                  didOpen: () => {
                  Swal.showLoading();  

                  setTimeout(function() {
                    Swal.close()
                        $(document).ready(function(){
                            $("#exampleModal").modal({backdrop: 'static', keyboard: false });
                            $("#exampleModal").modal("show");
                            });
                    }, 2000);  
                }
                }); 
            }, 1700); 
    </script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Survei Kepuasan {{session('id')}}</h5>
        {{-- <button type="button" class="close" onclick="return closex()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body">
        <form action="{{url('layanan/survei/'.session('id'))}}" method="POST">
        @csrf
        @method('PUT')
<div >
    <center>
    <div class="fw-bold">Response Time</div>
    
    <div>
        <table style="text-align: center;" width="100%">
            <tr>
                <td width="10px"><label for="1">Tidak Puas</label></td>
                <td width="10px"><label for="2">Kurang Puas</label></td>
                <td width="10px"><label for="3">Puas </label></td>
                <td width="10px"><label for="4">Cukup Puas</label></td>
                <td width="10px"><label for="5">Sangat Puas</label></td>
            </tr>
            <tr>
                <td class="px-1"><input type="radio" name="cepat" id="1" value="Tidak Puas" title="Tidak Puas" required></td>
                <td class="px-1"><input type="radio" name="cepat" id="2" value="Kurang Puas" title="Kurang Puas" required></td>
                <td class="px-1"><input type="radio" name="cepat" id="3" value="Puas" title="Puas" required></td>
                <td class="px-1"><input type="radio" name="cepat" id="4" value="Cukup Puas" title="Cukup Puas" required></td>
                <td class="px-1"><input type="radio" name="cepat" id="5" value="Sangat Puas" title="Sangat Puas" required></td>
            </tr>
        </table>
    </div>
    </center>
</div>
<div class="mt-2">
    <center>
    <div class="fw-bold">Hasil Pekerjaan</div>
    <div>
        <table style="text-align: center;" width="100%">
            <tr>
                <td width="10px"><label for="a">Tidak Puas</label></td>
                <td width="10px"><label for="b">Kurang Puas</label></td>
                <td width="10px"><label for="c">Puas </label></td>
                <td width="10px"><label for="d">Cukup Puas</label></td>
                <td width="10px"><label for="e">Sangat Puas</label></td>
            </tr>
            <tr>
                <td class="px-1"><input type="radio" name="perilaku" id="a" value="Tidak Puas" title="Tidak Puas" required></td>
                <td class="px-1"><input type="radio" name="perilaku" id="b" value="Kurang Puas" title="Kurang Puas" required></td>
                <td class="px-1"><input type="radio" name="perilaku" id="c" value="Puas" title="Puas" required></td>
                <td class="px-1"><input type="radio" name="perilaku" id="d" value="Cukup Puas" title="Cukup Puas" required></td>
                <td class="px-1"><input type="radio" name="perilaku" id="e" value="Sangat Puas" title="Sangat Puas" required></td>
            </tr>
        </table>
    </div>
    </center>
</div>
<div class="mt-3">
    <center>
    <div>
        <table style="text-align: center;">
            <tr>
                <td width="10px" style="vertical-align: top;">Saran/masukan</td>

                <td class="px-1"><textarea name="masukan" class="form-control "></textarea></td>
            </tr>
        </table>
    </div>
    </center>
</div>
        <button type="submit" id="kirim" class="btn btn-primary" hidden>Simpan</button>

        </form>
      </div>
      <div class="modal-footer">
        <label for="kirim" class="btn btn-primary">Simpan</label>
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function closex() {
   $('#exampleModal').modal("toggle");
}
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
                <div class="card-header fw-bold">{{ __('Update Status Permintaan Layanan') }}
                    @if($update != null)
                    <a href="{{url('layanan/status')}}"><span class="btn btn-primary float-end btn-sm mx-2 py-0">Kembali</span></a>
                    @endif
                </div>

                <div class="card-body ">
                    <form 
                    action="{{$update == null ? "" : url("layanan/status/".$update->layanan_id)}}" 
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
                        <input id="noid" type="text" name="id" class="form-control stat" placeholder="Contoh : PLKG-XXXX-XXXX" minlength="13" onchange="" required autocomplete="off">
                    </div>
                    @endif
                    @if($update != null)
                    <div>
                        <table width="100%" >
                            <tr>
                                <td width="30%">Jenis Layanan</td>
                                <td width="10%">:</td>
                                <td>
                                    @foreach(explode(',',$update->layanan) as $item)
                                    @if ('Lain-lain' == Str::substr($item, 0,9))
                                    <li>{{Str::substr($item, 12,1000)}}</li>
                                    @else
                                        <li>{{$item}}</li>
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Nama PIC</td>
                                <td width="10%">:</td>
                                <td>{{$update->pic}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Satker</td>
                                <td width="10%">:</td>
                                <td>{{$update->satker}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Detail Kebutuhan</td>
                                <td width="10%">:</td>
                                <td>{{$update->detail_kebutuhan}}</td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <select name="status" class="form-select form-select-sm" required>
                            <option selected value="" disabled># Pilih Status Permintaan #</option>
                            <option value="Closed">Selesai</option>
                            <option value="Cancelled by user">Batal</option>
                        </select>
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
  var path = "{{ route('stat')  }}";
  $('input.stat').typeahead({
      source:  function (query, process) {
      return $.get(path, { term: query }, function (data) {
              return process(data);
          });
      }
  });
</script>

@endsection