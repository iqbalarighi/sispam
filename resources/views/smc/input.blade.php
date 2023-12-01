@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100 p-1">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Tambah Data Kegiatan') }}
                    <a href="{{route('laporan_smc')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

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
{{--         @if ($message = Session::get('success'))
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
        @if ($message = Session::get('sukses'))
            <script>
                    Swal.fire({
                      title: "Berhasil",
                      text:  "Laporan Kegiatan Berhasil Tersimpan !",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 1500
                    });

            setTimeout(function () {
                   window.location = "{{url('smc_detil/'.$message)}}";
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
            <form action="{{route('simpan_lap_smc')}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
                    <table class="mx-auto" style="width: 70%; ">
                    <tr>
                        <td><b>Tanggal</b></td>
                        <td>:</td>
                        <td>
                            <input type="date" class="form-control pb-0 pt-0" max="{{date('Y-m-d')}}" value="{{ date('Y-m-d')}}" name="tgl" id="tgl" required>
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Shift</b></td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0 text-capitalize" name="shift" required>
                                <option value="" disabled selected>Pilih Shift</option>
                                <option value="Shift 1 (Pukul 06.00-14.00 WIB)">Shift 1 (Pukul 06.00-14.00 WIB)</option>
                                <option value="Shift 2 (Pukul 14.00-22.00 WIB)">Shift 2 (Pukul 14.00-22.00 WIB)</option>
                                <option value="Shift 3 (Pukul 22.00-06.00 WIB)">Shift 3 (Pukul 22.00-06.00 WIB)</option>
                            </select>
                        </td> 
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Petugas SMC : </b> <br>( Isian ini dapat di edit.<font color="red"> Hapus yang tidak perlu !</font> )
                            <pre class="mb-0"><textarea rows="3" class="form-control pb-0 pt-0" name="petugas" required>
Supervisor SMC : Esa Lanang Perkasa
Staf SMC 1 : {{Auth::user()->name}}
Staf SMC 2 : </textarea></pre>
                    </td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Kegiatan : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="5" name="giat" required></textarea></pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Keterangan : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="5" name="ket" id="ket" ></textarea></pre></td>
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
                                     />
                        </td>
                    </tr>
                    </table>
                <center>
                    <button type="submit" class="btn btn-primary mt-2" style = "text-align:center">
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