@extends('layouts.side')

@section('content')
@if(Auth::user()->role == 'admin')

@elseif(Auth::user()->unit_kerja == 'Fasilitas Kerja')

@else 
{{abort(403)}}
@endif
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
<style>
.containerx {
  position: relative;
  width: 50%;
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
    @if (session('success'))
        <script type="text/javascript">
            Swal.fire({
              icon: "success",
              title: "{{ session('success') }}",
              showConfirmButton: false,
              timer: 1500
            });
        </script>
    @endif
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header fw-bold text-uppercase">{{ __('Halaman edit') }}
                    <a href="{{ route('layanan') }}"><span class="btn btn-primary float-right btn-sm mx-2 py-1">Kembali</span></a>
                </div>

                <div class="card-body">
<div class="col-md-8">
<form action="{{url('layanan/update')}}/{{$edit->layanan_id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="">
                <div class="fw-bold">Jenis Layanan</div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen1" name="layanan[]" required onclick="check()" value="Izin Loading Barang" {{ in_array('Izin Loading Barang', $jenis) ? 'checked' : '' }}>
                    <label class="m-0 p-0" for="jen1">Izin Loading Barang</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen2" name="layanan[]" required onclick="check()" value="Pengamanan Kegiatan/Acara" {{ in_array('Pengamanan Kegiatan/Acara', $jenis) ? 'checked' : '' }}>
                    <label class="m-0 p-0" for="jen2">Pengamanan Kegiatan/Acara</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen3" name="layanan[]" required onclick="check()" value="Pengawalan" {{ in_array('Pengawalan', $jenis) ? 'checked' : '' }}>
                    <label class="m-0 p-0" for="jen3">Pengawalan</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen4" name="layanan[]" required onclick="check()" value="Parkir" {{ in_array('Parkir', $jenis) ? 'checked' : '' }}>
                    <label class="m-0 p-0" for="jen4">Parkir</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen5" name="layanan[]" required onclick="check()" value="Peminjaman Mobil" {{ in_array('Peminjaman Mobil', $jenis) ? 'checked' : '' }}>
                    <label class="m-0 p-0" for="jen5">Peminjaman Mobil</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen6" name="layanan[]" required onclick="check()" value="Peminjaman Ruangan" {{ in_array('Peminjaman Ruangan', $jenis) ? 'checked' : '' }}>
                    <label class="m-0 p-0" for="jen6">Peminjaman Ruangan</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen7" name="layanan[]" required onclick="check()" value="Permintaan Fasilitas Kerja" {{ in_array('Permintaan Fasilitas Kerja', $jenis) ? 'checked' : '' }}>
                    <label class="m-0 p-0" for="jen7">Permintaan Fasilitas Kerja</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen9" name="layanan[]" required onclick="check()" value="Pemeliharaan Gedung" {{ in_array('Pemeliharaan Gedung', $jenis) ? 'checked' : '' }}>
                    <label class="m-0" for="jen9">Pemeliharaan Gedung</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen10" name="layanan[]" required onclick="check()" value="Pemeliharaan Rumah Jabatan" {{ in_array('Pemeliharaan Rumah Jabatan', $jenis) ? 'checked' : '' }}>
                    <label class="m-0" for="jen10">Pemeliharaan Rumah Jabatan</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen11" name="layanan[]" required onclick="check()" value="Dukungan Acara/Kegiatan" {{ in_array('Dukungan Acara/Kegiatan', $jenis) ? 'checked' : '' }}>
                    <label class="m-0" for="jen11">Dukungan Acara/Kegiatan</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input " id="jen12" name="layanan[]" required onclick="check()" value="Peminjaman Peralatan/Perlengkapan" {{ in_array('Peminjaman Peralatan/Perlengkapan', $jenis) ? 'checked' : '' }}>
                    <label class="m-0" for="jen12">Peminjaman Peralatan/Perlengkapan</label>
                </div>
                <div class="d-flex form-check" style="margin-top: -2px;">
                    <input type="checkbox" class="form-check-input " id="jen8" name="layanan[]" required onclick="check()" value="Lain-lain :" {{ 'Lain-lain :' == Str::substr(end($jenis), 0,11) ? 'checked' : '' }}>
                    <label class="m-0 px-0 pl-0 pr-2" for="jen8" class="px-2" style="margin-top: 2px;">Lain-lain</label> &nbsp;&nbsp;
                    <input class="form-control form-control-sm px-1" style="width: 200px;" type="text" id="nilain" name="layanan[]" />
                </div>
            </div>
            
            <div class="mt-2">
                <div class="form-floating">
                    <select type="datetime-local" class="form-select form-select-sm" id="gedung" name="gedung" placeholder="" required> 
                           <option value="{{$edit->lokasi}}">{{$edit->lokasi}}</option>
                            @foreach($sites as $site)
                            <option value="{{$site->nama_gd}}">{{$site->nama_gd}}</option>
                            @endforeach
                    </select>
                    <label for="gedung">Pilih Gedung</label>
                </div>
                <div class="form-floating mt-1" >
                        <select id="lantai" type="text" class="form-select form-select-sm" name="lantai">
                            <option value="{{$edit->lantai}}" selected>{{$edit->lantai}}</option>
                        </select>
                    <label for="lantai">Pilih Lantai</label>
                </div>
                <script type="text/javascript">
(function() {
    var elm = document.getElementById('lantai'),
        df = document.createDocumentFragment();
    for (var i = 1; i <= 16; i++) {
        var option = document.createElement('option');
        option.value = "Lantai " + i;
        option.appendChild(document.createTextNode("Lantai " + i));
        df.appendChild(option);
    }
    elm.appendChild(df);
}());
</script>
            </div>

            <div class="mt-2">
                <div>
                    <b> Uraian </b>
                </div>
                <div class="form-floating">
                    <input type="datetime-local" class="form-control form-control-sm" id="waktu" name="waktu" value="{{Carbon\Carbon::parse($edit->tanggal)->isoFormat('YYYY-MM-DD HH:mm:ss')}}" required>
                    <label for="waktu">Tanggal dan Waktu</label>
                </div>
                <div class="form-floating">
                  <textarea class="form-control form-control-sm" placeholder="Leave a comment here" id="detail" style="height: 75px;" name="detail" required>{{$edit->detail_kebutuhan}}</textarea>
                  <label for="detail">Detail Kebutuhan</label>
                </div>
                {{--<div class="form-floating">
                  <input class="form-control form-control-sm" placeholder="Leave a comment here" id="uraian" name="uraian">
                  <label for="uraian">Tempat</label>
                </div> --}}
            <div class="form-floating">
                <input class="form-control form-control-sm" type="text" name="pic" id="pic" placeholder="" value="{{$edit->pic}}" required>
                <label for="pic">Nama PIC</label>
            </div>
            <div class="form-floating">
                <input class="form-control form-control-sm" type="text" name="satker" id="satker" placeholder="" value="{{$edit->satker}}" required>
                <label for="satker">Satker</label>
            </div>
            <div class="form-floating">
                <input class="form-control form-control-sm" type="text" name="kontak" onkeypress="return angka(event)" id="kontak" maxlength="14" placeholder="" value="{{$edit->kontak}}" required>
                <label for="kontak">Nomor Kontak/WhatsApp</label>
            </div>
            <div class="form-floating">
                <input class="form-control form-control-sm" type="email" name="email" id="mail" placeholder="" pattern=".[^@\s]+@[^@\s]+\.[^@\s]+" autocomplete="off" value="{{$edit->email}}" required>
                <label for="mail">Email</label>
            </div>
            </div>
            <div class="mt-2">
                    @if ($edit->foto == null)
                    <td colspan="3">
                        <b>Foto Dokumentasi</b>: <br> <p></p>
                    <div class="input-group custom-file-button mt-1">
                        <label class="input-group-text p-1" class="form-control form-control-sm" for="foto" style="font-size: 10pt;">Upload Foto</label>
                        <input type="file" class="form-control form-control-sm" accept=".jpeg, .jpg, .png" name="images[]" id="foto" >
                    </div>
                    @else
                    <div>
                        <td colspan="3"><b>Dokumen Pendukung</b>: <br> <p></p>
                        <div class="row" style="vertical-align: middle;">

                            @foreach(explode('|',$edit->foto) as $foto)
                            
                            <div class="containerx">
                                
                               <img class="image" title="Hapus Foto" onclick="return ceks()" src="{{asset('storage/layanan/'.$edit->layanan_id.'/'.$foto)}}" style="width: 100%; margin-bottom: 5pt; cursor: pointer;"> &nbsp;
                            <div class="middle" >
                            <div class="text" onclick="return ceks()">
                                <i class="bi bi-trash3" style="color: red; cursor: pointer;"></i>
                            </div>
                          </div>
                            </div>

                        <script>
                            function ceks() {
                                Swal.fire({
                                          title: "Hapus Foto ?",
                                          text: "File terhapus tidak dapat dikembalikan !",
                                          icon: "warning",
                                          showCancelButton: true,
                                          confirmButtonColor: "#3085d6",
                                          cancelButtonColor: "#d33",
                                          cancelButtonText: "Batal",
                                          confirmButtonText: "Hapus"
                                        }).then((result) => {
                                          if (result.isConfirmed) {
                                            window.location = "{{url('layanan/hapus/'.$foto.'/'.$edit->layanan_id)}}";
                                          }
                                        });
                            }
                        </script>
                            @endforeach 

                        </div>
                        </td>
                    </div>
                    <tr>

                </tr>
                    @endif


            </div>

            <div class="text-center mt-2">
                <button type="submit" class="btn btn-primary ">Update</button>
            </div>
        </form>
</div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   
       var jns1 = document.getElementById("jen1");
       var jns2 = document.getElementById("jen2");
       var jns3 = document.getElementById("jen3");
       var jns4 = document.getElementById("jen4");
       var jns5 = document.getElementById("jen5");
       var jns6 = document.getElementById("jen6");
       var jns7 = document.getElementById("jen7");
       var jns8 = document.getElementById("jen8");
       var jns9 = document.getElementById("jen9");
       var jns10 = document.getElementById("jen10");
       var jns11 = document.getElementById("jen11");
       var jns12 = document.getElementById("jen12");


jns1.required = true;
jns2.required = true;
jns3.required = true;
jns4.required = true;
jns5.required = true;
jns6.required = true;
jns7.required = true;
jns8.required = true;
jns9.required = true;
jns10.required = true;
jns11.required = true;
jns12.required = true;

 function check(){
    if ((jns1.checked || jns2.checked || jns3.checked || jns4.checked || jns5.checked || jns6.checked || jns7.checked || jns8.checked || jns9.checked || jns10.checked || jns11.checked || jns12.checked) === true) {
        jns1.required = false;
        jns2.required = false;
        jns3.required = false;
        jns4.required = false;
        jns5.required = false;
        jns6.required = false;
        jns7.required = false;
        jns8.required = false;
        jns9.required = false;
        jns10.required = false;
        jns11.required = false;
        jns12.required = false;
    } else {
        jns1.required = true;
        jns2.required = true;
        jns3.required = true;
        jns4.required = true;
        jns5.required = true;
        jns6.required = true;
        jns7.required = true;
        jns8.required = true;
        jns9.required = true;
        jns10.required = true;
        jns11.required = true;
        jns12.required = true;
    }

 }

 if ((jns1.checked || jns2.checked || jns3.checked || jns4.checked || jns5.checked || jns6.checked || jns7.checked || jns8.checked || jns9.checked || jns10.checked || jns11.checked || jns12.checked) === true) {
        jns1.required = false;
        jns2.required = false;
        jns3.required = false;
        jns4.required = false;
        jns5.required = false;
        jns6.required = false;
        jns7.required = false;
        jns8.required = false;
        jns9.required = false;
        jns10.required = false;
        jns11.required = false;
        jns12.required = false;
    } else {
        jns1.required = true;
        jns2.required = true;
        jns3.required = true;
        jns4.required = true;
        jns5.required = true;
        jns6.required = true;
        jns7.required = true;
        jns8.required = true;
        jns9.required = true;
        jns10.required = true;
        jns11.required = true;
        jns12.required = true;
    }
</script>
<script>
const jen8 = document.querySelector('#jen8');
const nilain = document.querySelector('#nilain');
nilain.disabled = true;
nilain.style.visibility = 'hidden';

if (jen8.checked) {
    nilain.style.visibility = 'visible';
    nilain.name = 'layanan[]';
    nilain.required= true;
    nilain.disabled = false;
    nilain.value = '{{ Str::substr(end($jenis), 12,1000) }}';
}

jen8.addEventListener('change', () => {
  if (jen8.checked) {
    nilain.style.visibility = 'visible';
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

@endsection