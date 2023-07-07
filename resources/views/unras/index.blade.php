@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Rekap Giat Unjuk Rasa') }}
                    @if (Auth::user()->role === 'admin')
                    <span data-toggle="modal" data-target="#tambah" class="btn btn-primary float-right btn-sm">Tambah Laporan</span>
                    @endif
                </div>
                <style type="text/css">
                    .modal {
                        --bs-modal-width: 35% !important;
                        --bs-modal-padding: 0.1rem !important;
                    }
                    ::placeholder {
                        text-align: center; 
                    }
                    input {
                      text-align: center;
                    }
                    select {
                    text-align-last: center;
                    text-align: center
                    }
                </style>
                    <!-- Modal -->
    <div class="modal fade "
        id="tambah"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Add image inside the body of modal -->
                <div align="center" class="modal-body center">
                    <form action="{{url('simpan-unras')}}" method="POST" id="form">
                        @csrf
                <table class="mx-auto" style="width: 100%; ">
                    <tr align="center">
                        <th colspan="10">Rencana Giat Unras</th>
                    </tr>
                    <tr>
                        <td>
                        <input type="text" name="tanggal" placeholder="Tanggal & Waktu" class="form-control m-0" onfocus="(this.type='datetime-local')" onblur="(this.type='datetime-local')" required/>
                        </td>
                    </tr>
                    <tr>
                        {{-- <td>
                            <input type="time" name="waktu" placeholder="Waktu" class="form-control m-0" required/>
                        </td> --}}
                        <td>
                            <input type="text" name="tempat" id="tempat" placeholder="Tempat Kegiatan" id="" class="typeahead2 form-control m-0" autocomplete="off" required/>
                            <span id="messag"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="search" type="text" name="pelaksana"  placeholder="Pelaksana" class="typeahead form-control m-0" autocomplete="off" required/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="tuntut" placeholder="Tuntutan" class="form-control m-0" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{-- <input type="text" name="kegiatan" placeholder="Bentuk Kegiatan" class="form-control m-0" required/> --}}
                            <select class="form-select pb-0 pt-0" id="kegiatan" name="kegiatan" aria-label="Default select example" required>
                                <option value="" disabled selected >Bentuk Kegiatan</option>
                                <option value="Unjuk Rasa">Unjuk Rasa</option>
                                <option value="Audiensi">Audiensi</option>
                                <option value="Lain-lain :">Lain-lain</option>
                            </select>
                            <input type="text" id="jenis" class="form-control form-control-sm px-1 mt-1" autocomplete="off" name="" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="number" name="jumlah" id="jumlah" onkeypress="return angka(event)" autocomplete="off" placeholder="Jumlah Massa" class="form-control m-0" required/>
                            <span id="messages"></span>
                        </td>
                    </tr>
{{--                     <tr>
                        <td>
                            <select class="form-select pb-0 pt-0" id="status" name="status" aria-label="Default select example" required>
                                <option value="" disabled selected >Status Kegiatan</option>
                                <option value="Kecelakaan Kerja">Selesai Kondusif</option>
                                <option value="Keadaan Darurat">Ricuh</option>
                                <option value="Lain-lain :">Lain-lain</option>
                            </select>
                            <input type="text" id="jenis" class="form-control form-control-sm px-1 mt-1" name="" hidden>
                        </td>
                    </tr> --}}
                    <tr>
                        <td>
                            {{-- <input type="text" name="level" placeholder="Level Risiko" class="form-control m-0" required/> --}}
                            <select class="level form-select pb-0 pt-0 " id="" name="level" aria-label="Default select example" >
                                <option value="" disabled selected >Level Risiko</option>
                                <option style="background-color: limegreen; color: black;" value="Minimal">Minimal</option>
                                <option style="background-color: yellow; color: black;" value="Rendah">Rendah</option>
                                <option style="background-color: orange; color: black;" value="Sedang">Sedang</option>
                                <option style="background-color: red; color: white;" value="Tinggi">Tinggi</option>
                                <option style="background-color: darkred; color: white;" value="Ekstrem">Ekstrem</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-select pb-0 pt-0" id="sifat" name="sifat" aria-label="Default select example" >
                                <option value="" disabled selected >Sifat Kegiatan</option>
                                <option value="Terencana">Terencana</option>
                                <option value="Tidak Terencana">Tidak Terencana</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="ket" placeholder="Keterangan" class="form-control m-0" ></textarea>
                        </td>
                    </tr>
                </table>
                <center> <button type="submit" class="btn btn-primary btn-sm mt-2">Tambah</button></center>
                <button type="reset"
                        class="btn btn-secondary"
                        id="rese"
                        hidden>
                        Reset
                </button>

            </form>
                </div>
 
                <div class="modal-footer">
                <label for="rese" class="btn btn-secondary">Reset</label>
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


        <div class="card-body overflow " style="overflow-x: auto;">
        
        <center class="mb-2">
            @if ($message = Session::get('berhasil'))
            <div id="timeout" align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between mx-1" style="width: 80%; margin: 0 auto;" role="alert">
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
        </center>
        @elseif ($message = Session::get('warning'))
        <div id="" align="center" class="alert alert-warning alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between mx-1" style="width: 80%; margin: 0 auto;" role="alert">
                <div class="row">
                    <div class="col">
        <div class="card-text" align="center">
                    {{ $message }} <br />
                    @if ($cektest != null)
                    @foreach ($cektest as $key => $cekis) 
                    <a href="#{{$cekis->id}}" >{{Carbon\Carbon::parse($cekis->tanggal)->isoFormat('D MMMM Y')}}</a> 
                    @endforeach
                    @endif
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
                        .xx {
                            font-size: 10pt;
                            text-align: center;
                        }
                        .table tr td {
                            padding:0.3rem;
                            vertical-align: middle;
                            max-width:100%;
                            white-space:nowrap;
                            font-size: 10.5pt;
                        }
                        .table th {
                            padding:0.3rem;
                            white-space: break-word;
                            background-color: seashell;
                        }

                        label {
                            margin: 0em;
                        }
                    </style>

                        @if (Auth::user()->role === 'admin')
                        @if ($start == null)

                        @else
                        @if ($unras->count() == 0)

                        @else
                        <a href="unras/export/{{$start}}/{{$end}}/{{$unras->count()}}"><span class="btn btn-primary btn-sm float-left">Export Excel</span></a>
{{--                         
                        <a href="unras/export/{{$start}}/{{$end}}/{{$unras->count()}}"><span class="btn btn-primary btn-sm float-left">Export Excel</span></a>
                        @else
                        <a href="#" ><span class="btn btn-primary btn-sm float-left" onclick="alert('Status Kegiatan Unras Belum Lengkap')">Export Excel</span></a>
                        @endif --}}
                        @endif
                        @endif
                    <form action="" method="GET" class="float-right mb-2">Pilih Tanggal: 
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="start" > - 
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="end" >
                        <button class="submit bi bi-search"></button>
                    </form>
                    @else
                    <form action="" method="GET" class="float-right mb-2">
                        <input type="date" class="" name="date">
                        <button class="submit bi bi-search"></button>
                    </form>
                       @endif 

                    <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm text-center ">
                    <tr class="font-weight-normal xx ">
                        <th scope="col" class="align-middle" style="max-width:50px; min-width:30px;">No</th>
                        <th scope="col" class="align-middle">Tanggal</th>
                        <th scope="col" class="align-middle">Waktu</th>
                        <th scope="col" class="align-middle">Tempat Kegiatan</th>
                        <th scope="col" class="align-middle">Pelaksana</th>
                        <th scope="col" class="align-middle">Tuntutan</th>
                        <th scope="col" class="align-middle">Bentuk Kegiatan</th>
                        <th scope="col" class="align-middle">Kisaran Jumlah Massa</th>
                        <th scope="col" class="align-middle" >Status Kegiatan</th>
                        <th scope="col" class="align-middle" >Level Risiko</th>
                        <th scope="col" class="align-middle" >Sifat Kegiatan</th>
                        <th scope="col" class="align-middle" >Keterangan</th>
                        @if (Auth::user()->role === 'admin')
                        <th scope="col" class="align-middle" >Creator</th>
                        <th scope="col" class="align-middle" >Editor</th>
                        <th scope="col" class="align-middle" >Opsi</th>
                        @endif
                    </tr>
                    @if ($unras->count() == 0)
                    <tr>
                        <td colspan="15"> Data Tidak Ditemukan</td>
                    </tr>
                    @endif
                    @foreach ($unras as $key => $rasa)

                    @if ($rasa->status_kegiatan == 'Rencana')
                    <tr style="background-color: #b8fffa;" id="{{$rasa->id}}">
                    @else
                    <tr>
                    @endif
                       <td>{{$unras->firstitem() + $key}}</td>
                       <td>{{Carbon\Carbon::parse($rasa->tanggal)->isoFormat('D MMMM Y')}}</td> 
                       <td>{{$rasa->waktu}} WIB</td> 
                       <td style="white-space:normal !important;">{{$rasa->tempat_kegiatan}}</td> 
                       <td style="white-space:normal !important;">{{$rasa->pelaksana}}</td> 
                       <td style="white-space:normal !important;">{{$rasa->tuntutan}}</td> 
                       <td>
                        @if ('Lain-lain :' == Str::substr($rasa->bentuk_kegiatan, 0,11))
                            {{Str::substr($rasa->bentuk_kegiatan, 12,1000)}}
                            @else
                            {{$rasa->bentuk_kegiatan}}<br>
                            @endif
                       </td> 
                       <td>{{$rasa->jumlah_massa}} Orang</td> 
                       <td>
                        @if ('Lain-lain :' == Str::substr($rasa->status_kegiatan, 0,11))
                            {{Str::substr($rasa->status_kegiatan, 12,1000)}}
                            @else
                            {{$rasa->status_kegiatan}}<br>
                            @endif
                    </td> 
                        @if ($rasa->level_resiko == 'Minimal')
                        <td style="background-color: limegreen; color: black;"><b>{{$rasa->level_resiko}}</b></td>
                        @elseif ($rasa->level_resiko == 'Rendah')
                        <td style="background-color: yellow; color: black;"><b>{{$rasa->level_resiko}}</b></td>
                        @elseif ($rasa->level_resiko == 'Sedang')
                        <td style="background-color: orange; color: black;"><b>{{$rasa->level_resiko}}</b></td>
                        @elseif ($rasa->level_resiko == 'Tinggi')
                        <td style="background-color: red; color: black;"><b>{{$rasa->level_resiko}}</b></td>
                        @elseif ($rasa->level_resiko == 'Ekstrem')
                        <td style="background-color: darkred; color: white;"><b>{{$rasa->level_resiko}}</b></td>
                        @else
                        <td>{{$rasa->level_resiko}}</td>
                            @endif
                         
                       <td>{{$rasa->sifat_kegiatan}}</td> 
                       <td>{{$rasa->keterangan}}</td>
                       @if (Auth::user()->role === 'admin')
                       <td>{{$rasa->creator}}</td>
                       <td>{{$rasa->editor}}</td>
                        
                        <td >
                        <div class="d-flex justify-content-between">
                        <label style="vertical-align: middle;"  data-toggle="modal" data-target="#unras{{$unras->firstitem()+$key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn-sm align-self-center">

                        </label>
{{-- Modal --}}
    <div class="modal fade "
        id="unras{{$unras->firstitem()+$key}}"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Add image inside the body of modal -->
                <div align="center" class="modal-body center">
                   <form action="{{url('update-unras')}}/{{$rasa->id}}" method="POST">
                      @csrf
                       @method('PUT')
                <table class="mx-auto" style="width: 100%; ">
                    <tr align="center">
                        <th colspan="10">Rencana Giat Unras</th>
                    </tr>
                    <tr>
                        <td>
                        <input type="date" name="tanggal2" placeholder="Tanggal & Waktu" class="form-control m-0"  required value="{{$rasa->tanggal}}" />
                        </td>
                    </tr>
                    <tr>
                         <td>
                            <input type="time" name="waktu2" placeholder="Waktu" class="form-control m-0" value="{{$rasa->waktu}}" required/>
                        </td> 
                    </tr>
                    <tr>

                        <td>
                            <input type="text" name="tempat2" id="tempat" placeholder="Tempat Kegiatan" id="" class="typeahead2 form-control m-0" autocomplete="off" value="{{$rasa->tempat_kegiatan}}" required/>
                            <span id="messag"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="search" type="text" name="pelaksana2"  placeholder="Pelaksana" class="typeahead form-control m-0" autocomplete="off" value="{{$rasa->pelaksana}}" required/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="tuntut2" placeholder="Tuntutan" class="form-control m-0" >{{$rasa->tuntutan}}</textarea>
                        </td>
                    </tr>
                    @php 
if ($unras->count() == 0) {
    $giat = "";
    $sta = "";
} else {
    $giat = Str::substr($rasa->bentuk_kegiatan, 12,1000);
    $sta = Str::substr($rasa->status_kegiatan, 12,1000);
}
@endphp 
                    <tr>
                        <td>
                            <select class="form-select pb-0 pt-0" id="kegiatan2{{$unras->firstitem()+$key}}" name="kegiatan2" aria-label="Default select example" required>
                                <option value="" disabled selected >Bentuk Kegiatan</option>
                                <option value="Unjuk Rasa" {{ 'Unjuk Rasa' == $rasa->bentuk_kegiatan ? 'selected' : '' }}>Unjuk Rasa</option>
                                <option value="Audiensi" {{ 'Audiensi' == $rasa->bentuk_kegiatan ? 'selected' : '' }}>Audiensi</option>
                                <option value="Lain-lain :" {{ 'Lain-lain :' == Str::substr($rasa->bentuk_kegiatan, 0,11) ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                            <input type="text" id="jenis2{{$unras->firstitem()+$key}}" class="form-control form-control-sm px-1 mt-1" autocomplete="off" name="" value="{{$giat}}" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="number" name="jumlah2" id="jumlah" onkeypress="return angka(event)" autocomplete="off" placeholder="Jumlah Massa" class="form-control m-0" value="{{$rasa->jumlah_massa}}" required/>
                            <span id="messages"></span>
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <select class="level form-select pb-0 pt-0 " id="" name="level2" aria-label="Default select example" >
                                <option value="" disabled selected >Level Risiko</option>
                                <option style="background-color: limegreen; color: black;" value="Minimal"{{'Minimal' ==$rasa->level_resiko ? 'selected' : '' }}>Minimal</option>
                                <option style="background-color: yellow; color: black;" value="Rendah"{{'Rendah' == $rasa->level_resiko ? 'selected' : '' }}>Rendah</option>
                                <option style="background-color: orange; color: black;" value="Sedang"{{'Sedang' == $rasa->level_resiko ? 'selected' : '' }}>Sedang</option>
                                <option style="background-color: red; color: white;" value="Tinggi"{{'Tinggi' == $rasa->level_resiko ? 'selected' : '' }}>Tinggi</option>
                                <option style="background-color: darkred; color: white;" value="Ekstrem"{{'Ekstrem' == $rasa->level_resiko ? 'selected' : '' }}>Ekstrem</option>
                            </select>
                        </td>
                    </tr>
               <tr>
                        <td>
                            <select class="form-select pb-0 pt-0" id="status{{$unras->firstitem()+$key}}" name="status" aria-label="Default select example" required>
                                <option value="" disabled selected >Status Kegiatan</option>
                                <option value="Selesai Kondusif" {{ 'Selesai Kondusif' == $rasa->status_kegiatan ? 'selected' : '' }}>Selesai Kondusif</option>
                                <option value="Ricuh" {{ 'Ricuh' == $rasa->status_kegiatan ? 'selected' : '' }}>Ricuh</option>
                                <option value="Lain-lain :" {{ 'Lain-lain :' == Str::substr($rasa->status_kegiatan, 0,11) ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                            <input type="text" id="stat{{$unras->firstitem()+$key}}" class="form-control form-control-sm px-1 mt-1" autocomplete="off" name="" value="{{$sta}}" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-select pb-0 pt-0" id="sifat" name="sifat2" aria-label="Default select example" >
                                <option value="" disabled selected >Sifat Kegiatan</option>
                                <option value="Terencana" {{ 'Terencana' == $rasa->sifat_kegiatan ? 'selected' : '' }}>Terencana</option>
                                <option value="Tidak Terencana" {{ 'Tidak Terencana' == $rasa->sifat_kegiatan ? 'selected' : '' }}>Tidak Terencana</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="ket2" placeholder="Keterangan" class="form-control m-0" >{{$rasa->keterangan}}</textarea>
                        </td>
                    </tr>
                </table>  
                <center> <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button></center>
{{--                 <button type="reset"
                        class="btn btn-secondary"
                        id="rese"
                        hidden>
                        Reset
                </button> --}}

            </form>
                </div>
 
                <div class="modal-footer">
                {{-- <label for="rese" class="btn btn-secondary">Reset</label> --}}
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                </button>
                </div>
            </div>
        </div>
    </div>
{{-- end of modal   --}}
                        <pre> </pre>
                        <form action="unras/hapus/{{$rasa->id}}" method="post" class="align-self-center m-auto">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button id="del{{$unras->firstitem() + $key}}" onclick="return confirm('Yakin nih mau di hapus ?')" type="submit" title="Hapus Data" hidden>
                                </button>
                                <label for="del{{$unras->firstitem() + $key}}" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn-sm align-self-center">
                                </label>
                        </form>
                        </div>
                         @endif
                    
                       </td> 
                    </tr>
<script type="text/javascript">
$("#jenis2{{$unras->firstitem()+$key}}").prop("disabled", true);

if ($("#kegiatan2{{$unras->firstitem()+$key}} option:selected").val() == 'Lain-lain :') {
        $("#jenis2{{$unras->firstitem()+$key}}").prop("disabled", false);
        $('#jenis2{{$unras->firstitem()+$key}}').prop('hidden', false); 
        $("#jenis2{{$unras->firstitem()+$key}}").prop('required', true);
        $("#kegiatan2{{$unras->firstitem()+$key}}").prop('required', true);
        $("#kegiatan2{{$unras->firstitem()+$key}}").attr("name", "kegiatan2[]");
        $("#jenis2{{$unras->firstitem()+$key}}").attr("name", "kegiatan2[]");

};

    $(window).on('load', function(){
        $("#kegiatan2{{$unras->firstitem()+$key}}").change(function() {
          console.log($("#kegiatan2{{$unras->firstitem()+$key}} option:selected").val());
          if ($("#kegiatan2{{$unras->firstitem()+$key}} option:selected").val() == 'Lain-lain :') {
                $("#jenis2{{$unras->firstitem()+$key}}").prop("disabled", false);
                $('#jenis2{{$unras->firstitem()+$key}}').prop('hidden', false); 
                $("#jenis2{{$unras->firstitem()+$key}}").prop('required', true);
                $("#kegiatan2{{$unras->firstitem()+$key}}").prop('required', false);
                $("#kegiatan2{{$unras->firstitem()+$key}}").attr("name", "kegiatan2[]");
                $("#jenis2{{$unras->firstitem()+$key}}").attr("name", "kegiatan2[]");
                $("#jenis2{{$unras->firstitem()+$key}}").attr("value", "");
          } else {
            $("#jenis2{{$unras->firstitem()+$key}}").prop("disabled", true);
            $('#jenis2{{$unras->firstitem()+$key}}').prop('hidden', true);
            $("#jenis2{{$unras->firstitem()+$key}}").prop('required', false);
            $("#jenis2{{$unras->firstitem()+$key}}").attr("name", '');
            $("#kegiatan2{{$unras->firstitem()+$key}}").prop('required', true);
            $("#kegiatan2{{$unras->firstitem()+$key}}").attr("name", "kegiatan2");
          }
        }
);
});
</script>

<script type="text/javascript">
$("#stat{{$unras->firstitem()+$key}}").prop("disabled", true);

if ($("#status{{$unras->firstitem()+$key}} option:selected").val() == 'Lain-lain :') {
        $("#stat{{$unras->firstitem()+$key}}").prop("disabled", false);
        $('#stat{{$unras->firstitem()+$key}}').prop('hidden', false); 
        $("#stat{{$unras->firstitem()+$key}}").prop('required', true);
        $("#status{{$unras->firstitem()+$key}}").prop('required', true);
        $("#status{{$unras->firstitem()+$key}}").attr("name", "status[]");
        $("#stat{{$unras->firstitem()+$key}}").attr("name", "status[]");

};

    $(window).on('load', function(){
        $("#status{{$unras->firstitem()+$key}}").change(function() {
          console.log($("#status{{$unras->firstitem()+$key}} option:selected").val());
          if ($("#status{{$unras->firstitem()+$key}} option:selected").val() == 'Lain-lain :') {
                $("#stat{{$unras->firstitem()+$key}}").prop("disabled", false);
                $('#stat{{$unras->firstitem()+$key}}').prop('hidden', false); 
                $("#stat{{$unras->firstitem()+$key}}").prop('required', true);
                $("#status{{$unras->firstitem()+$key}}").prop('required', false);
                $("#status{{$unras->firstitem()+$key}}").attr("name", "status[]");
                $("#stat{{$unras->firstitem()+$key}}").attr("name", "status[]");
                $("#stat{{$unras->firstitem()+$key}}").attr("value", "");
          } else {
            $("#stat{{$unras->firstitem()+$key}}").prop("disabled", true);
            $('#stat{{$unras->firstitem()+$key}}').prop('hidden', true);
            $("#stat{{$unras->firstitem()+$key}}").prop('required', false);
            $("#stat{{$unras->firstitem()+$key}}").attr("name", '');
            $("#status{{$unras->firstitem()+$key}}").prop('required', true);
            $("#status{{$unras->firstitem()+$key}}").attr("name", "status");
          }
        }
);
});
</script>
  

                    @endforeach



                    </table>
                    </div>
                    {{$unras->onEachSide(1)->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#tempat').on('change', function () {
  if ($('#tempat').val().toLowerCase().includes('ojk')) {
    $('.level').attr('id', 'level');
    $('#jumlah').val('');
    $('#level').val("").change().css('background', '');
    $('#level').val("").change().css('color', 'black');
  } else if ($('#tempat').val().toLowerCase().includes('wisma mulia 2')) {
    $('.level').attr('id', 'level');
    $('#jumlah').val('');
    $('#level').val("").change().css('background', '');
    $('#level').val("").change().css('color', 'black');
  } else if ($('#tempat').val().toLowerCase().includes('mrp')) {
    $('.level').attr('id', 'level');
    $('#jumlah').val('');
    $('#level').val("").change().css('background', '');
    $('#level').val("").change().css('color', 'black');
  } else if ($('#tempat').val().toLowerCase().includes('menara radius prawiro')) {
    $('.level').attr('id', 'level');
    $('#jumlah').val('');
    $('#level').val("").change().css('background', '');
    $('#level').val("").change().css('color', 'black');
  } else if ($('#tempat').val().toLowerCase().includes('soemitro')) {
    $('.level').attr('id', 'level');
    $('#jumlah').val('');
    $('#level').val("").change().css('background', '');
    $('#level').val("").change().css('color', 'black');
  } else if ($('#tempat').val().toLowerCase().includes('ojk bi')) {
    $('.level').attr('id', 'level');
    $('#jumlah').val('');
    $('#level').val("").change().css('background', '');
    $('#level').val("").change().css('color', 'black');
  } else if ($('#tempat').val().toLowerCase().includes('bank indonesia')) {
    $('.level').attr('id', 'level');
    $('#jumlah').val('');
    $('#level').val("").change().css('background', '');
    $('#level').val("").change().css('color', 'black');
  } else {
    $('#jumlah').val('');
    $('.level').attr('id', '');
    $('.level').val("").change().css('background', '');
    $('.level').val("").change().css('color', 'black');
}
});
</script>
<script type="text/javascript">
$('#jumlah').on('keyup', function () {
  if (25 >= $('#jumlah').val()) {
    $('#level').val("Minimal").change().css('background', 'limegreen');
  } else if (75 >= $('#jumlah').val()) {
    $('#level').val("Rendah").change().css('background', 'yellow');
        $('#level').val("Rendah").change().css('color', 'black');
  } else if (150 >= $('#jumlah').val()) {
    $('#level').val("Sedang").change().css('background', 'orange');
  } else if (300 >= $('#jumlah').val()) {
    $('#level').val("Tinggi").change().css('background', 'red');
  } else if (500 >= $('#jumlah').val()) {
    $('#level').val("Ekstrem").change().css('background', 'darkred');
    $('#level').val("Ekstrem").change().css('color', 'white');
  }  else {
    $('#level').val("Ekstrem").change().css('background', 'darkred');
    $('#level').val("Ekstrem").change().css('color', 'white');
  }

  // if ($('.level').val().length() === 0) {
  //   $('#level').val("").change().css('background', '');
  // }
    

  if (0 == $('#jumlah').val()) {
    $('#level').val("").change().css('background', '');
  }

  if ($('#jumlah').val().length === 0) {
    $('#level').val("").change().css('background', '');
  }
    
});
</script>

<script>
  var path = "{{ route('automasi')  }}";
  $('input.typeahead').typeahead({
      source:  function (query, process) {
      return $.get(path, { term: query }, function (data) {
              return process(data);
          });
      }
  });
</script>

<script>
  var path2 = "{{ route('automasi2')  }}";
  $('input.typeahead2').typeahead({
      source:  function (query2, process) {
      return $.get(path2, { term: query2 }, function (data2) {
              return process(data2);
          });
      }
  });
</script>

<script>
$("#rese").click(function() {
    if (confirm('Yakin isian mau dihapus?')) {
        $("#form").trigger("reset");
        $('#level').val("").change().css('background', '');
        $('#level').val("").change().css('color', 'black');
    } else {

    }
        
});
</script>

<script type="text/javascript">
     $("#jenis").prop("disabled", true); 

    $(window).on('load', function(){
        $("#kegiatan").change(function() {
          console.log($("#kegiatan option:selected").val());
          if ($("#kegiatan option:selected").val() == 'Lain-lain :') {
            $("#jenis").prop("disabled", false);
            $('#jenis').prop('hidden', false);        
            $("#jenis").prop('required', true);
            $("#kegiatan").prop('required', true);
            $("#kegiatan").attr("name", "kegiatan[]");
            $("#jenis").attr("name", "kegiatan[]");
          } else {
            $("#jenis").prop("disabled", true);
            $('#jenis').prop('hidden', true);
            $("#jenis").prop('required', false);
            $("#kegiatan").prop('required', true);
            $("#kegiatan").attr("name", "kegiatan");
            $("#jenis").attr("name", "");
          }
        }
);
});
</script>


@endsection

