@extends('layouts.side')

@section('content')
@if(Auth::user()->unit_kerja != "Health, Safety, & Environment" && Auth::user()->unit_kerja != "Security Monitoring Center" && Auth::user()->role != "admin")
 @php
    header( "refresh:5;url=/dashboard" );
    return abort(401);
 @endphp
@endif
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
                <div class="card-header fw-bold text-uppercase">{{ __('SURAT IZIN PEKERJAAN RESIKO '.$detail->risiko) }}
                    <a href="{{route('izin_kerja')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
                </div>
                <div class="card-body">
                    {{ __('Risiko Pekerjaan : '.$detail->risiko) }} <span data-toggle="modal" data-target="#ubahresiko" class="btn btn-primary btn-sm  py-0">ubah</span> 
                    <!-- Modal -->
    <div class="modal fade "
        id="ubahresiko"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Add image inside the body of modal -->
                <div align="center" class="modal-body center">
                    <form action="{{url('update_risiko/'.$detail->id)}}">
                        @csrf
                        <label for="risiko">Risiko Pekerjaan : </label>
                        <select name="risiko" id="risiko" class="form-select form-select-sm" required>
                        <option value="" selected>:: Pilih Risiko Pekerjaan ::</option>
                        <option value="Sangat Rendah" style="background-color: limegreen; color: black;">Sangat Rendah</option>
                        <option value="Rendah" style="background-color: yellow; color: black;">Rendah</option>
                        <option value="Sedang" style="background-color: darkorange; color: black;">Sedang</option>
                        <option value="Tinggi" style="background-color: red; color: white;">Tinggi</option>
                        <option value="Sangat Tinggi" style="background-color: darkred; color: white">Sangat Tinggi</option>
                    </select>
                        <button id="sub" type="submit" hidden></button>
                    </form>
                </div>
                <div class="modal-footer">
                <label for="sub" class="btn btn-primary btn-sm">Simpan</label>
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                </button>
                </div>
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
        </div>
    </div>
{{-- end of modal --}}
<br>
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
                           <b> A. Klasifikasi Pekerjaan </b> <span data-toggle="modal" data-target="#klasifikasi" class="btn btn-primary btn-sm  py-0">ubah</span>
                            <table>
                                <tr>
                                    <td>@foreach(explode(',',$detail->klasifikasi) as $value)
                                        {{$value}} <br>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <!-- Modal -->
    <div class="modal fade "
        id="klasifikasi"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Add image inside the body of modal -->
                <div align="left" class="modal-body">
                    <form action="{{url('update_klasifikasi/'.$detail->id)}}" method="get">
                        @csrf
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
                    <div class="col-md-auto px-0">
                        <label class="mb-0">
                                            <input type="checkbox" id="clas9" name="klasifikasi[]" onclick="firm()" value="Lain-lain :" /> Lain-lain</label>
                         <input class="form-control form-control-sm px-1" size="15" type="text" id="nilain" name="klasifikasi[]" />
                    </div>

                        <button id="klas" type="submit" hidden></button>
                    </form>
                </div>
                <div class="modal-footer">
                <label for="klas" class="btn btn-primary btn-sm">Simpan</label>
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                </button>
                </div>
            </div>
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

 function firm(){
    if ((c1.checked || c2.checked || c3.checked || c4.checked || c5.checked || c6.checked || c7.checked || c8.checked || c9.checked) === true) {
        c1.required = false;

    } else {
        c1.required = true;

    }

 }
</script>   
<script>
const clas9 = document.querySelector('#clas9');
const nilain = document.querySelector('#nilain');
nilain.disabled = true;
nilain.style.visibility = 'hidden';

clas9.addEventListener('change', () => {
  if (clas9.checked) {
    nilain.style.visibility = 'visible';
    nilain.value = '';
    nilain.name = 'klasifikasi[]';
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
        </div>
    </div>
{{-- end of modal --}}
                        </div>

                        <div class="row p-0 mb-3">
                            <div class="col-sm-auto px-0">
                                <b>B. Informasi Pekerjaan</b> &nbsp; <span data-toggle="modal" data-target="#ubahinfo" class="btn btn-primary btn-sm py-0" >ubah</span>
                    <!-- Modal -->
    <div class="modal fade "
        id="ubahinfo"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         
        <div class="modal-dialog" role="document" style="--bs-modal-width: 650px; !important">
            <div class="modal-content">
                <!-- Add image inside the body of modal -->
                <div align="center" class="modal-body center">
                    <form action="{{url('update_info/'.$detail->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="row">
            <b>B. Informasi Pekerjaan</b>
            <div class="col pe-0"> 
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="pekerjaan" value="{{ $detail->izin_informasi->pekerjaan}}" placeholder="Pekerjaan" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="lokasi" value="{{ $detail->izin_informasi->lokasi }}" placeholder="Lokasi" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="area" value="{{ $detail->izin_informasi->area }}" placeholder="Area/Lantai" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="plant" value="{{ $detail->izin_informasi->plant }}" placeholder="Ruangan">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="manager" value="{{ $detail->izin_informasi->manager }}" placeholder="Nama Manager" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="pemohon" value="{{ $detail->izin_informasi->pemohon }}" placeholder="Nama Pemohon" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="tel" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14" name="tel_pemohon" value="{{ $detail->izin_informasi->tel_pemohon }}" placeholder="Telepon Pemohon" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="pengawas" value="{{ $detail->izin_informasi->pengawas }}" placeholder="Pengawas" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="tel" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14" name="tel_pengawas" value="{{ $detail->izin_informasi->tel_pengawas }}" placeholder="Telepon Pengawas" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="k3" value="{{ $detail->izin_informasi->k3 }}" placeholder="Petugas K3">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="tel" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14" name="tel_k3" value="{{ $detail->izin_informasi->tel_k3 }}" placeholder="Telepon Petugas K3">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="text" class="form-control form-control-sm px-1" name="perusahaan_pemohon" value="{{ $detail->izin_informasi->perusahaan_pemohon }}" placeholder="Perusahaan Pemohon" required>
                </div>
            </div>

            <div class="col ps-1">
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" name="pekerja" value="{{ $detail->izin_informasi->pekerja }}" placeholder="Daftar Pekerja ( jumlah )" required>
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" name="enginer" value="{{ $detail->izin_informasi->enginer }}" placeholder="Enginer">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" name="surveyor" value="{{ $detail->izin_informasi->surveyor }}" placeholder="Surveyor">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" name="operator_alat" value="{{ $detail->izin_informasi->operator_alat }}" placeholder="Operator Alat">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" name="rigger" value="{{ $detail->izin_informasi->rigger }}" placeholder="Rigger">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" name="teknisi_elektrik" value="{{ $detail->izin_informasi->teknisi_elektrik }}" placeholder="Teknisi Elektrik">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" name="mekanik" value="{{ $detail->izin_informasi->mekanik }}" placeholder="Mekanik">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" name="welder" value="{{ $detail->izin_informasi->welder }}" placeholder="Welder">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" name="fitter" value="{{ $detail->izin_informasi->fitter }}" placeholder="Fitter">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" name="tukang_bangunan" value="{{ $detail->izin_informasi->tukang_bangunan }}" placeholder="Tukang Bangunan">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" name="tukang_kayu" value="{{ $detail->izin_informasi->tukang_kayu }}" placeholder="Tukang Kayu">
                </div>
                <div class="form-group mb-1 col-md-12">
                    {{-- <label class="mb-0">Pekerjaan</label> --}}
                    <input type="number" class="form-control form-control-sm px-1" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" name="lainnya" value="{{ $detail->izin_informasi->lainnya }}" placeholder="Lainnya">
                </div>
            </div>
        
        </div>

                        <button id="informan" type="submit" hidden></button>
                    </form>
                </div>
                <div class="modal-footer">
                <label for="informan" class="btn btn-primary btn-sm">Simpan</label>
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                </button>
                </div>
            </div>
        </div>
    </div>
{{-- end of modal --}}

                        <div class="col-sm-auto px-0">
                                <table class="table-sm table-bordered" width="auto">

                                    <tr>
                                        <td>Pekerjaan</td>
                                        <td>{{$detail->izin_informasi->pekerjaan}}</td>
                                        <td>Daftar Pekerja</td>
                                        <td align="center">{{$detail->izin_informasi->pekerja!=null ? $detail->izin_informasi->pekerja : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi</td>
                                        <td>{{$detail->izin_informasi->lokasi}}</td>
                                        <td>Enginer</td>
                                        <td align="center">{{$detail->izin_informasi->enginer!=null ? $detail->izin_informasi->enginer : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Area</td>
                                        <td>{{$detail->izin_informasi->area}}</td>
                                        <td>Surveyor</td>
                                        <td align="center">{{$detail->izin_informasi->surveyor!=null ? $detail->izin_informasi->surveyor : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Plant</td>
                                        <td>{{$detail->izin_informasi->plant!=null ? $detail->izin_informasi->plant : '-' }}</td>
                                        <td>Operator_alat</td>
                                        <td align="center">{{$detail->izin_informasi->operator_alat!=null ? $detail->izin_informasi->operator_alat : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Nama Manager</td>
                                        <td>{{$detail->izin_informasi->manager}}</td>
                                        <td>Rigger</td>
                                        <td align="center">{{$detail->izin_informasi->rigger!=null ? $detail->izin_informasi->rigger : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Nama Pemohon</td>
                                        <td>{{$detail->izin_informasi->pemohon}}</td>
                                        <td>Teknisi Elektrik</td>
                                        <td align="center">{{$detail->izin_informasi->teknisi_elektrik!=null ? $detail->izin_informasi->teknisi_elektrik : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Telepon Pemohon</td>
                                        <td>{{$detail->izin_informasi->tel_pemohon}}</td>
                                        <td>Mekanik</td>
                                        <td align="center">{{$detail->izin_informasi->mekanik!=null ? $detail->izin_informasi->mekanik : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pengawas</td>
                                        <td>{{$detail->izin_informasi->pengawas}}</td>
                                        <td>Welder</td>
                                        <td align="center">{{$detail->izin_informasi->welder!=null ? $detail->izin_informasi->welder : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Telepon Pengawas</td>
                                        <td>{{$detail->izin_informasi->tel_pengawas}}</td>
                                        <td>Fitter</td>
                                        <td align="center">{{$detail->izin_informasi->fitter!=null ? $detail->izin_informasi->fitter : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Petugas K3</td>
                                        <td>{{$detail->izin_informasi->k3!=null ? $detail->izin_informasi->k3 : '-' }}</td>
                                        <td>Tukang Bangunan</td>
                                        <td align="center">{{$detail->izin_informasi->tukang_bangunan!=null ? $detail->izin_informasi->tukang_bangunan : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Telepon Petugas K3</td>
                                        <td>{{$detail->izin_informasi->tel_k3!=null ? $detail->izin_informasi->tel_k3 : '-'}}</td>
                                        <td>Tukang Kayu</td>
                                        <td align="center">{{$detail->izin_informasi->tukang_kayu!=null ? $detail->izin_informasi->tukang_kayu : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td">Perusahaan Pemohon</td>
                                        <td>{{$detail->izin_informasi->perusahaan_pemohon}}</td>
                                        <td>Lainnya</td>
                                        <td align="center">{{$detail->izin_informasi->lainnya!=null ? $detail->izin_informasi->lainnya : '-'}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        </div>
                        <div class="row p-0 mb-3 justify-content-center">
                            <div class="row px-0 justify-content-around"> 
                                <b align="left" class="px-0">C. Perlengkapan Pekerjaan </b>
                                <div class="col-sm-auto mb-1">
                                    <table class="table-bordered table-sm my-1" width="100%">
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
                                            <td class="p-0 align-middle" style="width: 0px;">
                                                <button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center" id="alat{{$key+1}}">  </button>
                                            </td>
                                        </tr>
                <script>
        $('#alat{{$key+1}}').click(function(event){
    Swal.fire({
          title: "Yakin ingin dihapus?",
          text: "Data terhapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Batal",
          confirmButtonText: "Kirim"
        }).then((result) => {
          if (result.isConfirmed) {
        
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang menghapus data",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });  

               window.location="{{url('hapus_alat')}}/{{$alt}}/{{$detail->izin_peralatan->id}}/{{$alat[1][$key]}}";

          }
        });
    return false;
 });
                </script>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="2">Tidak ada data</td>
                                        </tr>
                                        @endif
                                    </table>
                                    <span data-toggle="modal" data-target="#ubahalat" class="btn btn-primary btn-sm float-end py-0">Tambah</span> 
                    <!-- Modal -->
    <div class="modal fade "
        id="ubahalat"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Add image inside the body of modal -->
                <div align="center" class="modal-body center">
                    <form action="{{url('update_perlengkapan/'.$detail->id)}}" onsubmit="return checkAlat()">
                        @csrf

            <div class="mb-1">
             <table class="table table-striped table-hover mx-auto mb-1" style="width: 100%; " id="dynamicRemove4">
                <tr align="center">
                    <td class="py-0 align-middle">Alat</td>
                    <td class="py-0 align-middle">Jumlah</td>
                </tr>
                <tr>
                    <td class="p-0 align-middle">
                        <input type="text" name="alat[]" placeholder="Alat" id="alats" class="form-control form-control-sm px-1" autocomplete="off" />
                    </td>
                    <td width="30%" class="py-0 align-middle">
                        <input type="number" name="jml_alat[]" id="jmlalt" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="0" placeholder="Jumlah" class="form-control form-control-sm px-1">
                    </td>
                </tr>
            </table>
            <button type="button" name="add" id="dinamik-ar4" class="btn btn-primary btn-sm float-end mb-1">Tambah Kolom</button>
        </div>
                        <button id="ala" type="submit" hidden></button>
                    </form>
                </div>
                <div class="modal-footer">
                <label for="ala" class="btn btn-primary btn-sm">Simpan</label>
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                </button>
                </div>
            </div>
            <script>

            $("#alats").change(function() {
        if ($("#alats").val().length === 0) {
            $("#jmlalt").prop('required',false);
            $("#alats").prop('required',true);
        }  else {
            $("#jmlalt").prop('required',true);

        }
    }); 
            function checkAlat() {
            if ($("#alats").val().length === 0) {
                $("#alats").focus();
                $("#jmlalt").prop('required',false);
                 return false;
            } 
                }

        $("#dinamik-ar4").click(function() {
            $("#alats").prop('required',true);
    }); 

        $(document).on('click', '.remove-input-field', function () {
            $("#alats").prop('required',false);
    });
            </script>
        </div>
    </div>
{{-- end of modal --}}
                                </div>

                                <div class="col-sm-auto mb-1">
                                    <table class="table-bordered table-sm my-1" width="100%">
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
                                            <td class="p-0 align-middle" style="width: 0px;">
                                                <button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center" id="mesin{{$key+1}}">  </button>
                                            </td>
                                        </tr>
                <script>
        $('#mesin{{$key+1}}').click(function(event){
    Swal.fire({
          title: "Yakin ingin dihapus?",
          text: "Data terhapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Batal",
          confirmButtonText: "Kirim"
        }).then((result) => {
          if (result.isConfirmed) {
        
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang menghapus data",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });  

               window.location="{{url('hapus_mesin')}}/{{$msn}}/{{$detail->izin_peralatan->id}}/{{$mesin[1][$key]}}";

          }
        });
    return false;
 });
                </script>

                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="2">Tidak ada data</td>
                                        </tr>
                                        @endif
                                    </table>
                                    <span data-toggle="modal" data-target="#ubahmesin" class="btn btn-primary btn-sm float-end py-0">Tambah</span> 
                    <!-- Modal -->
    <div class="modal fade "
        id="ubahmesin"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Add image inside the body of modal -->
                <div align="center" class="modal-body center">
                    <form action="{{url('update_perlengkapan/'.$detail->id)}}" onsubmit="return checkMesin()">
                        @csrf
                            <div class="mb-1">
                                 <table class="table table-striped table-hover mx-auto mb-1" style="width: 100%; " id="AddRemove3">
                                    <tr align="center">
                                        <td class="py-0 align-middle">Mesin</td>
                                        <td class="py-0 align-middle">Jumlah</td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="p-0 align-middle">
                                            <input type="text" name="mesin[]" placeholder="Mesin" id="mesin" class="form-control form-control-sm px-1" autocomplete="off" />
                                        </td>
                                        <td width="30%" class="py-0 align-middle">
                                            <input type="number" name="jml_mesin[]" id="jmlmsn" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="0" placeholder="Jumlah" class="form-control form-control-sm px-1">
                                        </td>
                                    </tr>
                                </table>
                                <button type="button" name="add" id="dinamik-ar3" class="btn btn-primary btn-sm float-end mb-1">Tambah Kolom</button>
                            </div>    
                        <button id="msn" type="submit" hidden></button>
                    </form>
                </div>
                <div class="modal-footer">
                <label for="msn" class="btn btn-primary btn-sm">Simpan</label>
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                </button>
                </div>
            </div>
            <script>
    $("#mesin").change(function() {
        if ($("#mesin").val().length === 0) {
            $("#mesin").prop('required',true);
            $("#jmlmsn").prop('required',false);
        }  else {
            $("#jmlmsn").prop('required',true);
        }
    }); 

    function checkMesin() {
            if ($("#mesin").val().length === 0) {
                $("#mesin").focus();
                $("#jmlmsn").prop('required',false);
                 return false;
            } 
                }

        $("#dinamik-ar4").click(function() {
            $("#mesin").prop('required',true);
    }); 

        $(document).on('click', '.remove-input-field', function () {
            $("#mesin").prop('required',false);
    });
            </script>
        </div>
    </div>
{{-- end of modal --}}
                                </div>
                                <div class="col-sm-auto mb-1">
                                    <table class="table-bordered table-sm my-1" width="100%">
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
                                            <td class="p-0 align-middle" style="width: 0px;">
                                                <button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center" id="material{{$key+1}}">  </button>
                                            </td>
                                        </tr>
                <script>
        $('#material{{$key+1}}').click(function(event){
    Swal.fire({
          title: "Yakin ingin dihapus?",
          text: "Data terhapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Batal",
          confirmButtonText: "Kirim"
        }).then((result) => {
          if (result.isConfirmed) {
        
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang menghapus data",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });  
               window.location="{{url('hapus_material')}}/{{$materi}}/{{$detail->izin_peralatan->id}}/{{$material[1][$key]}}";
          }
        });
    return false;
 });
                </script>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="2">Tidak ada data</td>
                                        </tr>
                                        @endif
                                    </table>
                                        <span data-toggle="modal" data-target="#ubahmaterial" class="btn btn-primary btn-sm float-end py-0">Tambah</span> 
                    <!-- Modal -->
    <div class="modal fade "
        id="ubahmaterial"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Add image inside the body of modal -->
                <div align="center" class="modal-body center">
                    <form action="{{url('update_perlengkapan/'.$detail->id)}}" onsubmit="return checkMaterial()">
                        @csrf
                            <div class="mb-1">
                                <table class="table table-striped table-hover mx-auto mb-1" style="width: 100%; " id="AddRemove2">
                                    <tr align="center">
                                        <td class="py-0 align-middle">Material</td>
                                        <td class="py-0 align-middle">Jumlah</td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="p-0 align-middle">
                                            <input type="text" name="material[]" id="mtr" placeholder="Material" class="form-control form-control-sm px-1" autocomplete="off"/>
                                        </td>
                                        <td width="30%" class="py-0 align-middle">
                                            <input type="number" name="jml_material[]" id="jmlmtr" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="0" placeholder="Jumlah" class="form-control form-control-sm px-1">
                                        </td>
                                    </tr>
                                </table>
                                <button type="button" name="add" id="dinamik-ar2" class="btn btn-primary btn-sm float-end mb-1">Tambah Kolom</button>
                            </div>
                        <button id="mtrl" type="submit" hidden></button>
                    </form>
                </div>
                <div class="modal-footer">
                <label for="mtrl" class="btn btn-primary btn-sm">Simpan</label>
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                </button>
                </div>
            </div>
            <script>
    $("#mtr").change(function() {
        if ($("#mtr").val().length === 0) {
            $("#mtr").prop('required',true);
            $("#jmlmtr").prop('required',false);
        }  else {
            $("#mtr").prop('required',false);
            $("#jmlmtr").prop('required',true);
        }
    }); 

    function checkMaterial() {
            if ($("#mtr").val().length === 0) {
                $("#mtr").focus();
                $("#jmlmtr").prop('required',false);
                 return false;
            } 
                }

        $("#dinamik-ar4").click(function() {
            $("#mtr").prop('required',true);
    }); 

        $(document).on('click', '.remove-input-field', function () {
            $("#mtr").prop('required',false);
    });
            </script>
        </div>
    </div>
{{-- end of modal --}}
                                </div>

                                <div class="col-sm-auto mb-1">
                                    <table class="table-bordered table-sm my-1" width="100%">
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
                                        <td class="p-0 align-middle" style="width: 0px;">
                                            <button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center" id="alber{{$key+1}}">  </button>
                                        </td>
                                        </tr>
<script>
        $('#alber{{$key+1}}').click(function(event){
    Swal.fire({
          title: "Yakin ingin dihapus?",
          text: "Data terhapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Batal",
          confirmButtonText: "Kirim"
        }).then((result) => {
          if (result.isConfirmed) {
        
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang menghapus data",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });  
               window.location="{{url('hapus_alatberat')}}/{{$alber}}/{{$detail->izin_peralatan->id}}/{{$alat_berat[1][$key]}}";
          }
        });
    return false;
 });
                </script>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="2">Tidak ada data</td>
                                        </tr>
                                        @endif
                                    </table>
                                        <span data-toggle="modal" data-target="#ubahalatberat" class="btn btn-primary btn-sm float-end py-0">Tambah</span> 
                    <!-- Modal -->
    <div class="modal fade "
        id="ubahalatberat"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Add image inside the body of modal -->
                <div align="center" class="modal-body center">
                    <form action="{{url('update_perlengkapan/'.$detail->id)}}" onsubmit="return checkAlatBerat()">
                        @csrf
                            <div class="mb-1">
                                <table class="table table-striped table-hover mx-auto mb-1" style="width: 100%; " id="AddRemove1">
                                    <tr align="center">
                                        <td class="py-0 align-middle">Alat Berat</td>
                                        <td class="py-0 align-middle">Jumlah</td>
                                    </tr>
                                    <tr>
                                        <td class="p-0 align-middle">
                                            <input type="text" name="alat_berat[]" placeholder="Alat Berat" id="berat" class="form-control form-control-sm px-1" autocomplete="off"/>
                                        </td>
                                        <td width="30%" class="py-0 align-middle">
                                            <input type="number" name="jml_alber[]" id="jmlbrt" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" placeholder="Jumlah" class="form-control form-control-sm px-1">
                                        </td>
                                    </tr>

                                    </table>
                                <button type="button" name="add" id="dinamik-ar1" class="btn btn-primary btn-sm float-end mb-1">Tambah Kolom</button>
                            </div>
                        <button id="alber" type="submit" hidden></button>
                    </form>
                </div>
                <div class="modal-footer">
                <label for="alber" class="btn btn-primary btn-sm">Simpan</label>
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                </button>
                </div>
            </div>
            <script>
    $("#berat").change(function() {
        if ($("#berat").val().length === 0) {
            $("#berat").prop('required',true);
            $("#jmlbrt").prop('required',false);
        }  else {
            $("#berat").prop('required',false);
            $("#jmlbrt").prop('required',true);
        }
    }); 

    function checkAlatBerat() {
            if ($("#berat").val().length === 0) {
                $("#berat").focus();
                $("#jmlbrt").prop('required',false);
                 return false;
            } 
                }

        $("#dinamik-ar4").click(function() {
            $("#berat").prop('required',true);
    }); 

        $(document).on('click', '.remove-input-field', function () {
            $("#berat").prop('required',false);
    });
            </script>
        </div>
    </div>
{{-- end of modal --}}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col px-0">
                                <b>D. Keselamatan Kerja</b>
                                <div>Tindakan : {{$detail->biaya}} &nbsp; <span data-toggle="modal" data-target="#ubahbiaya" class="btn btn-primary btn-sm py-0">Ubah</span> </div> 
<!-- Modal -->
    <div class="modal fade "
        id="ubahbiaya"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Add image inside the body of modal -->
                <div align="center" class="modal-body center">
                    <form action="{{url('update_risiko/'.$detail->id)}}">
                        @csrf
                            <div class="mb-1">
                                <table class="table table-striped table-hover mx-auto mb-1" style="width: 100%; " >
                                        <tr>
                                            <td colspan="3">Bila terjadi keadaan darurat, tindakan yang akan dilakukan ?</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> <label class="mb-0"><input id="biaya1" type="radio" name="biaya" value="Pembiayaan jaminan BPJS" required /> Pembiayaan jaminan BPJS</label></td>
                                            <td colspan="2"> <label class="mb-0"><input id="biaya2" type="radio" name="biaya" value="Pembiayaan Pribadi" required /> Pembiayaan Pribadi</label></td>
                                        </tr>
                                    </table>
                        </div>
                        <button id="byy" type="submit" hidden></button>
                    </form>
                </div>
                <div class="modal-footer">
                <label for="byy" class="btn btn-primary btn-sm">Simpan</label>
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                </button>
                </div>
            </div>

        </div>
    </div>
{{-- end of modal --}}
                                <div class="col-md-5 px-0">
                                <table class="table-bordered table-sm mb-1">
                                    <tr>
                                        <th>Aktivitas</th>
                                        <th>Potensi Bahaya</th>
                                        <th>Langkah Aman Pekerjaan</th>
                                    </tr>
                                    @foreach($selamat as $key => $selamat)
                                    <tr>
                                        <td>{{$selamat->aktivitas}}</td>
                                        <td>{{$selamat->potensi_bahaya}}</td>
                                        <td>{{$selamat->langkah_aman}}</td>
                                        <td><button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center" id="slm{{$key+1}}">  </button></td>
                                    </tr>
<script>
        $('#slm{{$key+1}}').click(function(event){
    Swal.fire({
          title: "Yakin ingin dihapus?",
          text: "Data terhapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Batal",
          confirmButtonText: "Kirim"
        }).then((result) => {
          if (result.isConfirmed) {
        
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang menghapus data",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });  
               window.location="{{url('hapus_kslmtn')}}/{{$selamat->id}}}}";
          }
        });
    return false;
 });
                </script>
                                    @endforeach
                                </table>
<span data-toggle="modal" data-target="#ubahkeselamatan" class="btn btn-primary btn-sm float-end py-0">Tambah</span> 
                            </div>
                    
                    <!-- Modal -->
    <div class="modal fade "
        id="ubahkeselamatan"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Add image inside the body of modal -->
                <div align="center" class="modal-body center">
                    <form action="{{url('update_selamat/'.$detail->izin_id)}}" >
                        @csrf
                            <div class="mb-1">
                                <table class="table table-striped table-hover mx-auto mb-1" style="width: 100%; " id="dynamicAddRemove0">
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
                            <button type="button" name="add" id="dynamic-ar0" class="btn btn-primary btn-sm float-end mb-1">Tambah Kolom</button>
                        </div>
                        <button id="slmt" type="submit" hidden></button>
                    </form>
                </div>
                <div class="modal-footer">
                <label for="slmt" class="btn btn-primary btn-sm">Simpan</label>
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                </button>
                </div>
            </div>

        </div>
    </div>
{{-- end of modal --}}
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
                                    @foreach(explode(',',$detail->izin_peralatan->pelindung_diri) as $key => $pdiri)
                                    <tr>
                                        <td>
                                            @if('Lainnya' === Str::substr($pdiri, 0,7))
                                            {{Str::substr($pdiri, 10,1000)}}
                                            @else
                                            {{$pdiri}}
                                            @endif
                                    </td>
                                        <td><button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center" id="apd{{$key+1}}">  </button></td>
                                    </tr>
                                    
                                            
                <script>
        $('#apd{{$key+1}}').click(function(event){
    Swal.fire({
          title: "Yakin ingin dihapus?",
          text: "Data terhapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Batal",
          confirmButtonText: "Kirim"
        }).then((result) => {
          if (result.isConfirmed) {
        
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang menghapus data",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });  

               window.location="{{url('hapus_apd/'.$detail->izin_peralatan->id.'/'.$pdiri)}}";

          }
        });
    return false;
 });
                </script>
                                    @endforeach
                                </table>

                            </div>
                            <div class="col-sm-auto px-0">
                                <table class="table-bordered table-sm">
                                    <tr>
                                        <th>Perlengkapan Keselamatan</th>
                                    </tr>
                                    @foreach(explode(',',$detail->izin_peralatan->perlengkapan) as $key => $lengkap)
                                    <tr>
                                        <td>
                                            @if('Lainnya' === Str::substr($lengkap, 0,7))
                                            {{Str::substr($lengkap, 10,1000)}}
                                            @else
                                            {{$lengkap}}
                                            @endif
                                    </td>
                                        <td><button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center" id="apk{{$key+1}}">  </button></td>
                                    </tr>
                                    
                                            
                <script>
        $('#apk{{$key+1}}').click(function(event){
    Swal.fire({
          title: "Yakin ingin dihapus?",
          text: "Data terhapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Batal",
          confirmButtonText: "Kirim"
        }).then((result) => {
          if (result.isConfirmed) {
        
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang menghapus data",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });  

               window.location="{{url('hapus_apk/'.$detail->izin_peralatan->id.'/'.$lengkap)}}";

          }
        });
    return false;
 });
                </script>
                                    @endforeach
                                </table>

                            </div>
                            <div class="row">
                                <div class="col-md-5 px-0">
                                    <span data-toggle="modal" data-target="#ubahpk" class="btn btn-primary float-end btn-sm py-0">Ubah</span>
                                </div>
                            </div>

                            </div>

<!-- Modal -->
    <div class="modal fade "
        id="ubahpk"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Add image inside the body of modal -->
                <div align="center" class="modal-body center">
                    <form action="{{url('update_apdk/'.$detail->id)}}" method="post">
                        @csrf
                        @method('PUT')
                            <div class="mb-1">
                                <table class="table table-striped table-hover table-bordered mx-auto mb-1 " >
            <tr style="font-size: 11pt;">
                <td colspan="3" class="py-0 align-middle">Alat Pelindung Diri</td>
            </tr>
            <tr style="font-size: 10pt; ">
                <td width="auto">
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri1" name="pelindung_diri[]" {{ in_array('Helm', $pds) ? 'checked' : '' }} value="Helm" /> Helm</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri2" name="pelindung_diri[]" {{ in_array('Kacamata', $pds) ? 'checked' : ''}} value="Kacamata"/> Kacamata</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri3" name="pelindung_diri[]" {{ in_array('Googles', $pds) ? 'checked' : ''}} value="Googles"/> Googles</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri4" name="pelindung_diri[]" {{ in_array('Tameng Muka', $pds) ? 'checked' : ''}} value="Tameng Muka"/> Tameng Muka</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri5" name="pelindung_diri[]" {{ in_array('Kap Las', $pds) ? 'checked' : ''}} value="Kap Las" /> Kap Las</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri6" name="pelindung_diri[]" {{ in_array('Masker Kain', $pds) ? 'checked' : ''}} value="Masker Kain" /> Masker Kain</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri7" name="pelindung_diri[]" {{ in_array('Masker Kimia', $pds) ? 'checked' : ''}} value="Masker Kimia" /> Masker Kimia</label>
                    </div>
                </td>
                <td width="auto">
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri8" name="pelindung_diri[]" {{in_array('Earplug / Earmuff', $pds ) ? 'checked' : ''}} value="Earplug / Earmuff" /> Earplug/Earmuff</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri9" name="pelindung_diri[]" {{in_array('Sarung tangan katun', $pds ) ? 'checked' : ''}} value="Sarung tangan katun" /> Sarung tangan katun</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri10" name="pelindung_diri[]" {{in_array('Sarung tangan karet', $pds ) ? 'checked' : ''}} value="Sarung tangan karet" /> Sarung tangan karet</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri11" name="pelindung_diri[]" {{in_array('Sarung tangan kulit', $pds ) ? 'checked' : ''}} value="Sarung tangan kulit" /> Sarung tangan kulit</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri12" name="pelindung_diri[]" {{in_array('Sarung tangan las', $pds ) ? 'checked' : ''}} value="Sarung tangan las" /> Sarung tangan las</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri13" name="pelindung_diri[]" {{in_array('Sabuk keselamatan' , $pds )? 'checked' : ''}} value="Sabuk keselamatan" /> Sabuk keselamatan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri14" name="pelindung_diri[]" {{in_array('Full body harness', $pds ) ? 'checked' : ''}} value="Full body harness" /> Full body harness</label>
                    </div>
                </td>
                <td width="auto">
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri15" name="pelindung_diri[]" {{in_array('Pelampung',$pds) ? 'checked' : ''}} value="Pelampung" /> Pelampung</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri16" name="pelindung_diri[]" {{in_array('Baju Lab',$pds) ? 'checked' : ''}} value="Baju Lab" /> Baju Lab</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri17" name="pelindung_diri[]" {{in_array('Sepatu safety',$pds) ? 'checked' : ''}} value="Sepatu safety" /> Sepatu safety</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri18" name="pelindung_diri[]" {{in_array('Sepatu boots',$pds) ? 'checked' : ''}} value="Sepatu boots" /> Sepatu boots</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri19" name="pelindung_diri[]" {{in_array('SCBA',$pds) ? 'checked' : ''}} value="SCBA" /> SCBA</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" onclick="con2()" id="diri20" name="pelindung_diri[]" {{in_array('Apron',$pds) ? 'checked' : ''}} value="Apron" /> Apron</label>
                    </div>
                    {{-- <div>
                        <label class="mb-0"><input type="checkbox" name="pelindung_diri[]" value="Lainnya" />Lainnya</label>
                    </div> --}}
                    <div class="">
                        <div class="col-auto p-0"><label class="mb-0 "><input type="checkbox" onclick="con2()" id="diri21" name="pelindung_diri[]" value="Lainnya" {{'Lainnya' === Str::substr(end($pds), 0,7) ? 'checked' : '' }} /> Lainnya</label>
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
                        <label class="mb-0"><input type="checkbox" id="pan1" name="perlengkapan[]" onclick="kap()" {{in_array('Alat Pemadam', $leng) ? 'checked' : ''}} value="Alat Pemadam" /> Alat Pemadam</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" id="pan2" name="perlengkapan[]" onclick="kap()" {{in_array('Barikade (safety line)', $leng) ? 'checked' : ''}} value="Barikade (safety line)" /> Barikade (safety line)</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" id="pan3" name="perlengkapan[]" onclick="kap()" {{in_array('Rambu keselamatan', $leng) ? 'checked' : ''}} value="Rambu keselamatan" /> Rambu keselamatan</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" id="pan4" name="perlengkapan[]" onclick="kap()" {{in_array('LOTO', $leng) ? 'checked' : ''}} value="LOTO" /> LOTO</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" id="pan5" name="perlengkapan[]" onclick="kap()" {{in_array('Radio HT', $leng) ? 'checked' : ''}} value="Radio HT" /> Radio HT</label>
                    </div>
                    <div>
                        <label class="mb-0"><input type="checkbox" id="pan6" name="perlengkapan[]" onclick="kap()" {{in_array('Jaring', $leng) ? 'checked' : ''}} value="Jaring" /> Jaring</label>
                    </div>
                    {{-- <div>
                        <label class="mb-0"><input type="checkbox" name="perlengkapan[]" value="Lainnya" /> Lainnya</label>
                    </div> --}}

                    <div class="d-flex">
                        <label class="mb-0 pe-2"><input type="checkbox" id="pan7" name="perlengkapan[]" onclick="kap()" value="Lainnya" {{'Lainnya' === Str::substr(end($leng), 0,7) ? 'checked' : '' }} /> Lainnya </label>
                        <div class="col-auto col-md-7"><input class="form-control form-control-sm px-0 py-0" type="text" id="lainlain2" name="perlengkapan[]" /></div>
                    </div>
                </td>
            </tr>
        </table>
                        </div>
                        <button id="apdk" type="submit" hidden></button>
                    </form>
                </div>
                <div class="modal-footer">
                <label for="apdk" class="btn btn-primary btn-sm">Simpan</label>
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                </button>
                </div>
            </div>

        </div>
    </div>
{{-- end of modal --}}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var i = 0;
    $("#dinamik-ar4").click(function () {
        ++i;
        $("#dynamicRemove4").append('<tr><td class="p-0 align-middle"><input type="text" name="alat[]" placeholder="Alat" class="form-control form-control-sm px-1" required/></td><td width="30%" class="py-0 align-middle"><input type="number" name="jml_alat[]" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="0" placeholder="Jumlah" class="form-control form-control-sm px-1" required></td><td class="p-0 align-middle" style="width: 0px;"><button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center remove-input-field"></button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
<script type="text/javascript">
    var i = 0;
    $("#dinamik-ar3").click(function () {
        ++i;
        $("#AddRemove3").append('<tr><td class="p-0 align-middle"><input type="text" name="mesin[]" placeholder="Mesin" class="form-control form-control-sm px-1" required/></td><td width="30%" class="py-0 align-middle"><input type="number" name="jml_mesin[]" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="0" placeholder="Jumlah" class="form-control form-control-sm px-1" required></td><td class="p-0 align-middle" style="width: 0px;"><button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center remove-input-field"></button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
<script type="text/javascript">
    var i = 0;
    $("#dinamik-ar2").click(function () {
        ++i;
        $("#AddRemove2").append('<tr><td class="p-0 align-middle"><input type="text" name="material[]" placeholder="Material" class="form-control form-control-sm px-1" required/></td><td width="30%" class="py-0 align-middle"><input type="number" name="jml_material[]" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" placeholder="Jumlah" class="form-control form-control-sm px-1" required></td><td class="p-0 align-middle" style="width: 0px;"><button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center remove-input-field"></button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
<script type="text/javascript">
    var i = 0;
    $("#dinamik-ar1").click(function () {
        ++i;
        $("#AddRemove1").append('<tr><td class="p-0 align-middle"><input type="text" name="alat_berat[]" placeholder="Alat Berat" class="form-control form-control-sm px-1" required/></td><td width="30%" class="py-0 align-middle"><input type="number" name="jml_alber[]" onkeypress="return angka(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" max="999" min="0" placeholder="Jumlah" class="form-control form-control-sm px-1" required></td><td class="p-0 align-middle" style="width: 0px;"><button type="button" class="bi bi-trash-fill btn bg-danger btn-sm align-self-center remove-input-field"></button></td></tr>'
            );
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
const diri21 = document.querySelector('#diri21');
const lainlain = document.querySelector('#lainlain');
lainlain.disabled = true;
lainlain.style.visibility = 'hidden';
if (diri21.checked) {
    lainlain.style.visibility = 'visible';
    lainlain.name = 'pelindung_diri[]';
    lainlain.required= true;
    lainlain.disabled = false;
    lainlain.value = '{{Str::substr(end($pds), 10,1000)}}';
}

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
if (pan7.checked) {
    lainlain2.style.visibility = 'visible';
    lainlain2.name = 'perlengkapan[]';
    lainlain2.required= true;
    lainlain2.disabled = false;
    lainlain2.value = '{{Str::substr(end($leng), 10,1000)}}';
}

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
</script>
@endsection
