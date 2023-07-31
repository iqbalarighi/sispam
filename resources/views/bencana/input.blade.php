@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100 p-1">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Tambah Data Kegiatan') }}
                    <a href="{{route('kegiatan')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

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
        @endif
<style>
    .textarea {
  width: 300px;
  height: 150px;
}
</style>
            <!-- form input Site -->
                    <div class="table-responsive mt-2" style="overflow-x: auto;">
            <form action="{{route('simpan_bencana')}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
                    <table class="table mx-auto" style="width: 70%; ">
                    <tr>
                        <td><b>Tanggal</b></td>
                        <td>:</td>
                        <td>
                            <input type="date" class="form-control pb-0 pt-0" max="{{date('Y-m-d')}}" value="{{ date('Y-m-d')}}" name="tgl" id="tgl" required>
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Lokasi</b></td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0 text-capitalize" id="gedung" name="gedung" required>
                                <option value="" disabled selected>Pilih Lokasi Gedung</option>
                                @foreach($site as $item)
                                <option value="{{$item->id}}">{{$item->nama_gd}}</option>
                                @endforeach
                            </select>
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Jenis Bencana</b></td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0 text-capitalize" id="gedung" name="gedung" required>
                                <option value="" disabled selected>Pilih Jenis Bencana</option>
                                <option value="Banjir">Banjir</option>
                                <option value="Gempa Bumi">Gempa Bumi</option>
                                <option value="Longsor">Longsor</option>
                            </select>
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Nama Pelapor</b></td>
                        <td>:</td>
                        <td>
                            <input type="text" name="pelapor" value="{{Auth::user()->name}}" class="form-control pb-0 pt-0 text-capitalize" autocomplete="off">
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Satuan Kerja</b></td>
                        <td>:</td>
                        <td>
                            <input type="text" name="satker" class="form-control pb-0 pt-0 text-capitalize" autocomplete="off">
                        </td> 
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Kejadian Bencana : </b> <br>( Isian ini dapat di edit.<font color="red"> Hapus yang tidak perlu !</font> )
                            <pre class="mb-0" ><textarea style="text-align: justify;" rows="7" class="form-control pb-0 pt-0" name="personil" id="personil" required>
Pada tanggal ... pukul ... WIB/WITA/WIT, telah terjadi bencana ... di daerah .... . Bencana tersebut diakibatkan oleh ... . Dari bencana ... diatas, gedung kantor OJK ... diidentifikasi sebagai salah satu gedung yang terpengaruh. Adapun dari hasil penelusuran, ditemukan ... korban jiwa, ... korban luka berat, ... dan ... korban luka ringan yang diderita oleh pegawai OJK. Sementara untuk kerusakan sarana dan prasarana Gedung tersebut, ditemukan/tidak ditemukan kerusakan ...(jelaskan kerusakan apabila ada).</textarea></pre>
                    </td>
                    </tr>
                    {{-- <tr>
                        <td colspan="3">
                            <b>Dampak Bencana : </b><br>( Isian ini dapat di edit.<font color="red"> Hapus yang tidak perlu !</font> )
                            <pre class="mb-0"><textarea rows="5" class="form-control pb-0 pt-0" name="trc" id="trc" required>
a. Korban Jiwa : 0 (Meninggal Dunia), 0 (Luka Berat), 0 (Luka Ringan), 0 (Hilang)
b. Kerusakan : </textarea></pre>
                        </td>
                    </tr> --}}
                    <tr>
                        <td colspan="3"><b>Kronologi Kejadian : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="8" name="giat" id="giat" required>Pukul .... WIB/WITA/WIT
......

Pukul .... WIB/WITA/WIT
......

Pukul .... WIB/WITA/WIT
......</textarea></pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Upaya Penanganan yang Dilakukan : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="6" name="ket" id="ket" required></textarea></pre></td>
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