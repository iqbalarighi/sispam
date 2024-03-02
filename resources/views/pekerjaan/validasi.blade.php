@extends('layouts.side')

@section('content')
@if(Auth::user()->unit_kerja != "Health, Safety, & Environment" && Auth::user()->unit_kerja != "Security Monitoring Center" && Auth::user()->role != "admin")
 @php
    header( "refresh:5;url=/dashboard" );
    return abort(401);
 @endphp
@endif
{{-- {{dd($valid->mulai_granted)}} --}}
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header fw-bold text-uppercase">{{ __('Validasi Izin Pekerjaan '.$izin->perusahaan_pemohon) }} 
                    <a href="{{ url('izin-detail') }}/{{$izin->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
                </div>
                    @if (session('success'))
                            <script type="text/javascript">

                                Swal.fire({
                                  icon: "success",
                                  title: "{{ session('success') }}",
                                  showConfirmButton: false,
                                  timer: 1500
                                });

                                setTimeout(function() {
                                    window.location = "{{url('izin-detail/'.$izin->id)}}";
                                    }, 2000);
                                
                            </script>
                    @endif
{{-- {{dd(Carbon\Carbon::parse($valid->mulai_granted)->format('Y-m-d\TH:i'),now()->setTimezone('T')->format('Y-m-dTh:m'))}} --}}

                <div class="card-body">
                    <center>
                    <div class="form-group col-sm-5">
                        <div class="form-floating">
                          <select class="form-select" id="izin" aria-label="Floating label select example" required>
                            <option selected></option>
                            <option value="1">Izin Diberikan</option>
                            <option value="2">Izin Dibatalkan</option>
                          </select>
                          <label for="izin">Pilih Izin</label>
                        </div>

                        <form action="{{url('simpan_validasi')}}/{{$izinid}}" method="post" id="form" enctype="multipart/form-data" onsubmit="return cek()">
                            @csrf
                            @method('PUT')
                            <div class="row g-2">

                                    <div class="form-floating">
                                      <input type="datetime-local" class="form-control" id="mulai" name="" value="">
                                      <label for="mulai">Mulai Jam</label>
                                    </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-floating">
                                      <input type="datetime-local" class="form-control" id="sampai" name="" value="">
                                      <label for="sampai">Sampai Jam</label>
                                    </div>
                                </div> --}}
                            </div>

                            <div class="form-floating">
                              <input type="text" class="form-control" id="nm_pmhn" name="" value="">
                              <label for="nm_pmhn">Nama Pemohon</label>
                            </div>
                            <div class="form-floating">
                              <input type="date" class="form-control" id="tgl_pmhn" name="" value="">
                              <label for="tgl_pmhn">Tanggal Permohonan</label>
                            </div>
                            <div class="form-floating">
                              {{-- <input type="text" class="form-control" id="nm_pmrks" name="" value=""> --}}
                              <select class="form-select" id="nm_pmrks" name=""  value="" required>
                                    <option value="" selected disabled></option>
                                    {{-- <option id="opt" value="{{$valid->nm_pmrks_granted}}">{{$valid->nm_pmrks_granted == null ? '::Pilih Pemeriksa::': $valid->nm_pmrks_granted}}</option> --}}
                                    @if($valid->nm_pmrks_granted != null)
                                        <option id="opt" value="{{$valid->nm_pmrks_granted}}">{{$valid->nm_pmrks_granted == null ? '::Pilih Pemeriksa::': $valid->nm_pmrks_granted}}</option>
                                    @endif
                                    @foreach($user as $item)
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                              </select>
                              <label for="nm_pmrks">Nama Pemeriksa</label>
                            </div>
                            {{-- <div class="form-floating">
                              <input type="date" class="form-control" id="tgl_pmrks" name="" value="">
                              <label for="tgl_pmrks">Tanggal Pemeriksaan</label>
                            </div> --}}
                            {{-- <div class="form-floating">
                              <input type="text" class="form-control" id="nm_pngws" name="" value="">
                              <label for="nm_pngws">Nama Pengawas</label>
                            </div> --}}
                            {{-- <div class="form-floating">
                              <input type="date" class="form-control" id="tgl_pngws" name="" value="">
                              <label for="tgl_pngws">Tanggal Pengawasan</label>
                            </div> --}}
                            <div class="form-floating">
                              <textarea class="form-control" placeholder="Leave a comment here" id="ket" style="height: 100px;" name="ket">{{$valid->ket}}</textarea>
                              <label for="ket">Keterangan</label>
                            </div>

                            <div class="text-center mt-2">
                                <button type="submit" class="btn btn-primary ">Kirim</button>
                            </div>
                        </form>
                    </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function cek() {
    if ($("#izin").val().length === 0) {
    $("#izin").focus();
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Pilih Izin dulu mas bro!",
    });
    return false;
} else {
    form.submit();
}

}
        $("#izin").change(function() {
        // console.log($("#izin option:selected").val());
        if ($("#izin option:selected").val() == '1') {
            $("#mulai").attr('name', 'mulai_granted');
            $("#sampai").attr('name', 'sampai_granted');
            $("#nm_pmhn").attr('name', 'nm_pmhn_granted');
            $("#tgl_pmhn").attr('name', 'tgl_pmhn_granted');
            $("#nm_pmrks").attr('name', 'nm_pmrks_granted');
            $("#tgl_pmrks").attr('name', 'tgl_pmrks_granted');
            $("#nm_pngws").attr('name', 'nm_pngws_granted');
            $("#tgl_pngws").attr('name', 'tgl_pngws_granted');
            $("#mulai").val('{{$valid->mulai_granted == null ? '' : Carbon\Carbon::parse($valid->mulai_granted)->format('Y-m-d\TH:i')}}');
            // $("#sampai").val('{{Carbon\Carbon::parse($valid->sampai_granted)->format('Y-m-d\TH:i')}}');
            $("#nm_pmhn").val('{{$valid->nm_pmhn_granted}}');
            $("#tgl_pmhn").val('{{$valid->tgl_pmhn_granted}}');
            $("#nm_pmrks").val('{{$valid->nm_pmrks_granted}}');
            // $("#tgl_pmrks").val('{{$valid->tgl_pmrks_granted}}');
            // $("#nm_pngws").val('{{$valid->nm_pngws_granted}}');
            // $("#tgl_pngws").val('{{$valid->tgl_pngws_granted}}');
        }  else if ($("#izin option:selected").val() == '2') {
            $("#mulai").attr('name', 'mulai_denied');
            $("#sampai").attr('name', 'sampai_denied');
            $("#nm_pmhn").attr('name', 'nm_pmhn_denied');
            $("#tgl_pmhn").attr('name', 'tgl_pmhn_denied');
            $("#nm_pmrks").attr('name', 'nm_pmrks_denied');
            $("#tgl_pmrks").attr('name', 'tgl_pmrks_denied');
            $("#nm_pngws").attr('name', 'nm_pngws_denied');
            $("#tgl_pngws").attr('name', 'tgl_pngws_denied');
            $("#mulai").val('{{$valid->mulai_denied == null ? '' : Carbon\Carbon::parse($valid->mulai_denied)->format('Y-m-d\TH:i')}}');
            // $("#sampai").val('{{Carbon\Carbon::parse($valid->sampai_denied)->format('Y-m-d\TH:i')}}');
            $("#nm_pmhn").val('{{$valid->nm_pmhn_denied}}');
            $("#tgl_pmhn").val('{{$valid->tgl_pmhn_denied}}');
            $("#nm_pmrks").val('{{$valid->nm_pmrks_denied}}');
            // $("#tgl_pmrks").val('{{$valid->tgl_pmrks_denied}}');
            // $("#nm_pngws").val('{{$valid->nm_pngws_denied}}');
            // $("#tgl_pngws").val('{{$valid->tgl_pngws_denied}}');
            $("#ket").prop('required',true);
        } else {
            $("#mulai").attr('name', '');
            $("#sampai").attr('name', '');
            $("#nm_pmhn").attr('name', '');
            $("#tgl_pmhn").attr('name', '');
            $("#nm_pmrks").attr('name', '');
            $("#tgl_pmrks").attr('name', '');
            $("#nm_pngws").attr('name', '');
            $("#tgl_pngws").attr('name', '');
            $("#mulai").val('');
            $("#sampai").val('');
            $("#nm_pmhn").val('');
            $("#tgl_pmhn").val('');
            $("#nm_pmrks").val('');
            $("#tgl_pmrks").val('');
            $("#nm_pngws").val('');
            $("#tgl_pngws").val('');
        }
    });
</script>




@endsection