@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100 p-1">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Buat Laporan Atensia') }}
                    <a href="{{ url()->previous() }}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

                </div>

                <div class="card-body overflow pl-0 pr-0" >
                        <style>
                            .table tr td {
                            word-wrap: break-word;
                            vertical-align: middle;
                            white-space: nowrap;
                            padding:1px !important;    
                            }
                            pre {font-family: "Times New Roman";}
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
        @if ($message = Session::get('sukses'))
            <script>
                    Swal.fire({
                      title: "Berhasil",
                      text:  "Laporan Atensi Berhasil Tersimpan !",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 1500
                    });

            setTimeout(function () {
                   window.location = "{{url('atensi_detil/'.$message)}}";
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
            <form action="{{route('simpan_atensi')}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
                    <table class="mx-auto" style="width: 70%; ">

                    <tr>
                        <td colspan="3">
                            <b>Yth : </b> <br>( Isian ini dapat di edit.<font color="red"> Hapus yang tidak perlu !</font> )
                            <pre class="mb-0"><textarea rows="4" class="form-control pb-0 pt-0" name="yth" required>1. Plt. Deputi Komisioner Sekretariat Dewan Komisioner dan Logistik
2. Kepala Departemen Logistik
3. Direktur Pengadaan dan Manajemen Aset
4. Deputi Direktur Fasilitas dan Dukungan Kelogistikan</textarea></pre>
                    </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Rencana Kegiatan : </b> <br>( Isian ini dapat di edit.<font color="red"> Hapus yang tidak perlu !</font> )
                            <pre class="mb-0"><textarea rows="2" class="form-control pb-0 pt-0" name="rencana" required>Aksi Unjuk Rasa {{$tensi->pelaksana}}</textarea></pre>
                    </td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Uraian Rencana Kegiatan : </b>
                            <pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="10" name="uraian" required>Informasi rencana unjuk rasa sebagaimana dimaksud diatas diperoleh dari Polda Metro Jaya. Unjuk rasa akan dilaksanakan oleh {{$tensi->pelaksana}} sebanyak kurang lebih {{$tensi->jumlah_massa}} orang berlokasi di {{$tensi->tempat_kegiatan}} pada tanggal {{Carbon\Carbon::parse($tensi->tanggal)->isoFormat('D MMMM Y')}}. Adapun tuntutan unjuk rasa tersebut adalah {{$tensi->tuntutan}}.
</textarea></pre></td>
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