@extends('layouts.side')

@section('content')
@if (Auth::user()->name == $edit->creator || Auth::user()->level === 'superadmin')

<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Edit Laporan Kegiatan') }}
                    <a href="{{url('/smc_detil')}}/{{$edit->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

                </div>

                <div class="card-body overflow pl-0 pr-0" >
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
        @if ($message = Session::get('success'))
                        <script>
                    Swal.fire({
                      title: "Berhasil",
                      text:  "{{$message}}",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 1500
                    });

            setTimeout(function () {
                   window.location = "{{url('smc_detil/'.Session::get('id'))}}";
                }, 1700); 

            </script>
        @elseif ($message = Session::get('warning'))
        <div align="center" class="alert alert-warning alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
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
<style>
    .textarea {
  width: 300px;
  height: 150px;
}
</style>

{{-- ini style buat gambar --}}
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
            <!-- form input Site -->
                    <div class="table-responsive mt-2" style="overflow-x: auto;">
            <form action="{{url('update_smc')}}/{{$edit->id}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                    <table class="table mx-auto" style="width: 70%; ">
                    <tr>
                        <td><b>No Laporan</b></td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" value="{{$edit->no_lap}}" name="nolap"  readonly></td> 
                    </tr>
                    <tr>
                        <td><b>Tanggal</b></td>
                        <td>:</td>
                        <td>
                            <input type="date" class="form-control pb-0 pt-0" value="{{Carbon\Carbon::parse($edit->tanggal)->format('Y-m-d')}}" name="tgl" required>
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Shift</b></td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0 text-capitalize" name="shift" required>
                                <option value="{{$edit->shift}}" selected>{{$edit->shift}}</option>
                            @if ($edit->shift == "Shift 1 (Pukul 06.00-14.00 WIB)")
                                <option value="Shift 2 (Pukul 14.00-22.00 WIB)">Shift 2 (Pukul 14.00-22.00 WIB)</option>
                                <option value="Shift 3 (Pukul 22.00-06.00 WIB)">Shift 3 (Pukul 22.00-06.00 WIB)</option>
                            @elseif ($edit->shift == "Shift 2 Pukul 14.00-22.00 WIB")
                                <option value="Shift 1 (Pukul 06.00-14.00 WIB)">Shift 1 (Pukul 06.00-14.00 WIB)</option>
                                <option value="Shift 3 (Pukul 22.00-06.00 WIB)">Shift 3 (Pukul 22.00-06.00 WIB)</option>
                            @else
                                <option value="Shift 1 (Pukul 06.00-14.00 WIB)">Shift 1 (Pukul 06.00-14.00 WIB)</option>
                                <option value="Shift 2 (Pukul 14.00-22.00 WIB)">Shift 2 (Pukul 14.00-22.00 WIB)</option>
                            @endif
                            </select>
                        </td> 
                    </tr>
                    <tr>
                        <td colspan="3"><b>Personil Yang Bertugas : </b><pre class="mb-0"><textarea rows="3" class="form-control pb-0 pt-0" name="petugas" required>{{$edit->petugas}}</textarea></pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Kegiatan : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="7" name="giat" required>{{$edit->giat}}</textarea></pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Keterangan : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="3" name="ket" >{{$edit->keterangan}}</textarea></pre></td>
                    </tr>

                    @if ($edit->foto == null)
                    <tr>
                        <td><b>Upload Foto</b></td>
                        <td>:</td>
                        <td>
                            <input type="file" name="images[]"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" 
                                    accept=".jpg, .jpeg, .png" 
                                    multiple/>

                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="3"><b>Foto Dokumentasi</b>: <br> <p></p>
                        <div class="row">
                            @foreach(explode('|',$edit->foto) as $item)

                                <div class="containerx">
                                
                               <img class="image" src="{{asset('storage/smc')}}/{{$edit->no_lap}}/{{$item}}" style="width: 100%; margin-bottom: 5pt"> &nbsp;
                            <div class="middle">
                            <div class="text"><a href="/hapus_foto_smc/{{$item}}/{{$edit->id}}" title="Hapus Foto" onclick="return confirm('Yakin foto dokumentasi mau di hapus ?')"><i class="bi bi-trash3"></i></a></div>
                          </div>
                            </div>

                            @endforeach
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"> Tambah Gambar : <br>
                            <input type="file" name="images[]"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" 
                                    accept=".jpg, .jpeg, .png" 
                                    multiple/>
                        </td> 
                    </tr>
                    @endif
                    </table>
                <center>
                    <button type="submit" class="btn btn-primary" style = "text-align:center">
                        {{ __('Update') }}
                    </button>
                </center>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else 
{{abort(403)}}
@endif
@endsection