@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Edit Laporan Kegawatdaruratan') }}
                    {{-- <a href="{{url('/giat-detil')}}/{{$edit->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a> --}}
                    <a href="{{url('bencana-detil')}}/{{$edit->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

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
            <form action="{{url('/update-bencana')}}/{{$edit->id}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                    <table class="table mx-auto" style="width: 70%;">
                    <tr>
                        <td><b>Tanggal Kejadian</b></td>
                        <td>:</td>
                        <td>
                            <input type="date" class="form-control pb-0 pt-0" max="{{date('Y-m-d')}}" value="{{$edit->tanggal}}" name="tgl" id="tgl" required>
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Lokasi Kejadian</b></td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0" id="gedung" name="gedung" required>
                                <option value="{{$id[0]->id}}">{{$edit->site->nama_gd}}</option>
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
                            {{-- <input type="text" class="form-control form-control-sm px-1 m-0" name="jns_kejadian" value="{{old ('jns_kejadian')}}" required> --}}
                            <select class="form-select pb-0 pt-0 text-capitalize" id="jenis_bencana" name="jenis_bencana" required>
                                <option value="" disabled selected>Jenis Bencana</option>
                                <option value="Gempa Bumi" {{ 'Gempa Bumi' == $edit->jenis_bencana ? 'selected' : '' }}>Gempa Bumi</option>
                                <option value="Gunung Meletus" {{ 'Gunung Meletus' == $edit->jenis_bencana ? 'selected' : '' }}>Gunung Meletus</option>
                                <option value="Tsunami" {{ 'Tsunami' == $edit->jenis_bencana ? 'selected' : '' }}>Tsunami</option>
                                <option value="Banjir" {{ 'Banjir' == $edit->jenis_bencana ? 'selected' : '' }}>Banjir</option>
                                <option value="Tanah Longsor" {{ 'Tanah Longsor' == $edit->jenis_bencana ? 'selected' : '' }}>Tanah Longsor</option>
                                <option value="Angin Topan" {{ 'Angin Topan' == $edit->jenis_bencana ? 'selected' : '' }}>Angin Topan</option>
                                <option value="Kebakaran" {{ 'Kebakaran' == $edit->jenis_bencana ? 'selected' : '' }}>Kebakaran</option>
                                <option value="Man-made Hazard :" {{ 'Man-made Hazard : ' == Str::substr($edit->jenis_bencana, 0,18) ? 'selected' : '' }}>Man-made Hazard</option>
                            </select>
                            <input type="text" id="jenis" class="form-control form-control-sm mt-1 text-capitalize pb-0 pt-0" name="jenis_bencana" value="" hidden>

                        </td> 
                    </tr>
                    <tr>
                        <td><b>Nama Pelapor</b></td>
                        <td>:</td>
                        <td>
                            <input type="text" name="pelapor" value="{{$edit->nama_pelapor}}" class="form-control pb-0 pt-0 text-capitalize" autocomplete="off" required>
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Satuan Kerja</b></td>
                        <td>:</td>
                        <td>
                            <input type="text" name="satker" class="form-control pb-0 pt-0 text-capitalize" autocomplete="off" value="{{$edit->satker}}" required>
                        </td> 
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Uraian Kejadian : </b> <br>( Isian ini dapat di edit.<font color="red"> Hapus yang tidak perlu !</font> )
                            <pre class="mb-0" ><textarea style="text-align: justify;" rows="7" class="form-control pb-0 pt-0" name="kejadian_bencana" id="kejadian_bencana" required>{{$edit->kejadian_bencana}}
                            </textarea></pre>
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
                        <td colspan="3">
                            <b>Kronologi Kejadian : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="8" name="kronologi_bencana" id="kronologi_bencana" required>{{$edit->kronologi_bencana}}</textarea></pre>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Upaya Penanganan yang Dilakukan : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="6" name="penanganan" id="penanganan" required>{{$edit->penanganan}}</textarea></pre></td></tr>
                    <tr>
                    @if ($edit->foto == null)
                    <td colspan="3"><b>Foto Dokumentasi</b>: <br> <p></p>
                    <div>
                            Upload Foto
                            <input type="file" name="images[]"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" 
                                    accept=".jpg, .jpeg, .png" 
                                    multiple/>

                    </div>
                    @else
                    <div>
                        <td colspan="3"><b>Foto Dokumentasi</b>: <br> <p></p>
                        <div class="row" style="vertical-align: middle;">

                            @foreach(explode('|',$edit->foto) as $item)
                            
                            <div class="containerx">
                                
                               <img class="image" src="{{asset('storage/bencana')}}/{{$edit->no_bencana}}/{{$item}}" style="width: 100%; margin-bottom: 5pt"> &nbsp;
                            <div class="middle">
                            <div class="text"><a href="/bencana/hapus-foto/{{$item}}/{{$edit->id}}" title="Hapus Foto" onclick="return confirm('Yakin foto dokumentasi mau di hapus ?')"><i class="bi bi-trash3"></i></a></div>
                          </div>
                            </div>
                        
                            @endforeach 

                        </div>
                        </td>
                    </div>
                    <tr>
                        <td colspan="3">
                    <div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Tambah Foto</label>
                            <input type="file" name="images[]"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" 
                                    accept=".jpg, .jpeg, .png" 
                                    multiple/>
                        </div> 
                    </div>
                </td>
                </tr>
                    @endif
                        </td>
                    </tr>
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


<script type="text/javascript">
$("#jenis").prop("disabled", true);

if ($("#jenis_bencana option:selected").val() == 'Man-made Hazard :') {
        $("#jenis").prop("disabled", false);
        $('#jenis').prop('hidden', false); 
        $("#jenis").prop('required', true);
        $("#jenis_bencana").prop('required', true);
        $("#jenis_bencana").attr("name", "jenis_bencana[]");
        $("#jenis").attr("name", "jenis_bencana[]");
        $("#jenis").attr("value", "{{Str::substr($edit->jenis_bencana, 18,1000)}}");
};

    $(window).on('load', function(){
        $("#jenis_bencana").change(function() {

          if ($("#jenis_bencana option:selected").val() == 'Man-made Hazard :') {
                $("#jenis").prop("disabled", false);
                $('#jenis').prop('hidden', false); 
                $("#jenis").prop('required', true);
                $("#jenis_bencana").prop('required', false);
                $("#jenis_bencana").attr("name", "jenis_bencana[]");
                $("#jenis").attr("name", "jenis_bencana[]");
                $("#jenis").attr("value", "");
          } else {
            $("#jenis").prop("disabled", true);
            $('#jenis').prop('hidden', true);
            $("#jenis").prop('required', false);
            $("#jenis").attr("name", '');
            $("#jenis_bencana").prop('required', true);
            $("#jenis_bencana").attr("name", "jenis_bencana");
          }
        }
);
});
</script>
@endsection