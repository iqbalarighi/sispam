@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100 p-1">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Tambah Data Temuan Patroli') }}
                    <a href="{{route('temuan')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

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
        {{-- @if ($message = Session::get('success'))
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

        @if ($message = Session::get('success'))
            <script>
                    Swal.fire({
                      title: "Berhasil",
                      text:  "Laporan Temuan Patroli Berhasil Tersimpan !",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 1500
                    });

            setTimeout(function () {
                   window.location = "{{url('temuan-detil/'.$message)}}";
                }, 1700); 

                    
            </script>
        @endif

<style>
    .textarea {
  width: 300px;
  height: 150px;
}
</style>
            <!-- form input Site -->
                    <div class="table-responsive mt-2" style="overflow-x: auto;">
            <form action="{{route('simpan_temuan')}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
                    <table class="mx-auto " style="width: 70%; ">
                    <tr>
                        <td><b>Tanggal</b></td>
                        <td>:</td>
                        <td>
                            <input type="date" class="form-control pb-0 pt-0" max="{{date('Y-m-d')}}" value="{{ date('Y-m-d')}}" name="tanggal" required>
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Jam</b></td>
                        <td>:</td>
                        <td>
                            <input type="time" class="form-control pb-0 pt-0"  name="jam" required>
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Gedung</b></td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0 text-capitalize" id="lokasi" name="lokasi" required>
                                <option value="" disabled selected>Pilih Gedung</option>
                                @foreach($site as $item)
                                <option value="{{$item->id}}">{{$item->nama_gd}}</option>
                                @endforeach
                            </select>
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Area</b></td>
                        <td>:</td>
                        <td colspan="3">
                        <input type="text" name="area" class="form-control pb-0 pt-0 text-capitalize" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Jenis Bahaya : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="4" name="jenis_bahaya" required></textarea></pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Potensi Bahaya : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="4" name="potensi_bahaya" id="giat" required></textarea></pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Pengendalian : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="4" name="pengendalian" id="ket" required></textarea></pre></td>
                    </tr>
                    <tr>
                        <td><b>Foto Dokumentasi</b></td>
                        <td>:</td>
                        <td>
                            <input type="file" name="images[]"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" 
                                    accept=".jpg, .jpeg, .png" 
                                    multiple 
                                    required />
                        </td>
                    </tr>
                    </table>
                <center>
                    <button type="submit" class="btn btn-primary" style = "text-align:center">
                        {{ __('Simpan') }}
                    </button>
                </center>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection