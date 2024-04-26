@extends('layouts.side')

@section('content')
@if(Auth::user()->role == "user")
 {{abort(403)}}
@endif
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header fw-bold text-uppercase">{{ __('Detail Layanan Kelogistikan') }}
                    <a href="{{ route('layanan') }}"><span class="btn btn-primary float-right btn-sm mx-2 py-1">Kembali</span></a>
                    @if(Auth::user()->role == 'admin')
                    <span class="btn btn-sm btn-primary align-self-center float-right" onclick="window.location='{{route('layanan')}}/validasi/{{$show->layanan_id}}'" style="cursor: pointer; z-index: 0; vertical-align: middle; margin-bottom: -1px; padding: 4px 3px 4px 3px;">Validasi</span>
                    @endif
                </div>
@if (session('abort'))
<script type="text/javascript">
    Swal.fire({
  icon: "error",
  title: "Oops...",
  allowOutsideClick: false,
  text: "{{session('abort')}}",
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    window.open('', '_self', ''); window.close();
  }
});
</script>
@endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-center">
                <div class="col-md-6" >
                    <div>
                        <b>Nomor Layanan </b>: {{$show->layanan_id}}
                    </div>
                    <div>
                        <b>Jenis Layanan</b>
                        <div>
                            
                            @foreach(explode(',',$show->layanan) as $item)
                                @if ('Lain-lain' == Str::substr($item, 0,9))
                                <li>{{Str::substr($item, 12,1000)}}</li>
                                @else
                                    <li>{{$item}}</li>
                                @endif
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="mt-2">
                        <b>Uraian</b>
                    <table width="100%" class="table-striped">
                        <tr>
                            <td style="width: 130px;">Tanggal</td>
                            <td style="width: 10px;">:</td>
                            <td>{{Carbon\Carbon::parse($show->tanggal)->isoFormat('DD MMMM YYYY')}}
                        Pukul {{Carbon\Carbon::parse($show->tanggal)->isoFormat('HH:mm:ss')}}</td>
                        </tr>
                        <tr>
                            <td style="width: 130px;">Nama PIC</td>
                            <td style="width: 10px;">:</td>
                            <td>{{$show->pic}}</td>
                        </tr>
                        <tr>
                            <td style="width: 130px;">Satker</td>
                            <td style="width: 10px;">:</td>
                            <td>{{$show->satker}}</td>
                        </tr>
                        <tr>
                            <td style="width: 130px;">Detail Kebutuhan</td>
                            <td style="width: 10px;">:</td>
                            <td>{{$show->detail_kebutuhan}}</td>
                        </tr>
                        <tr>
                            <td style="width: 130px;">No Handphone</td>
                            <td style="width: 10px;">:</td>
                            <td>{{$show->kontak}}</td>
                        </tr>
                        <tr>
                            <td style="width: 130px;">Email</td>
                            <td style="width: 10px;">:</td>
                            <td>{{$show->email}}</td>
                        </tr>
                    </table>

                    </div>
                    @if($show->foto != null) 
                    <div class="mt-4">
                        <div>
                        <b>Dokumentasi</b> 
                        </div>
                        @foreach(explode('|', $show->foto) as $foto)
                        <img src="{{asset('storage/layanan/'.$show->layanan_id.'/'.$foto)}}" width="200px">
                        @endforeach
                    </div>
                    @endif
                </div>
                    </div>

                @if(Auth::user()->unit_kerja == "Health, Safety, & Environment" || Auth::user()->unit_kerja == "Security Monitoring Center" || Auth::user()->role == "admin")
                        <div align="center" class="mt-4">
                            <select id="otorisasi"  required>
                                <option value="" selected>:: Pilih Otorisasi ::</option>
                                @foreach ($otor as $key => $oto)
                                <option value="{{$oto->id}}">{{$oto->nama}}</option>
                                @endforeach
                            </select>
                        <a id="link" target="_blank"><button id="unduh" class="btn btn-primary btn-sm float-center ml-2" disabled>Download PDF</button></a>
                        </div>
                    <script>
                        $("#otorisasi").change(function() {
                            console.log($("#otorisasi option:selected").val());
                            if ($("#otorisasi option:selected").val() == '') {
                                $("#unduh").prop("disabled", true);
                                $('#link').removeAttr("href");
                            } else {
                                $('#link').attr("href", "/layanan/detail/{{$show->layanan_id}}/"+this.value);
                                $("#unduh").prop("disabled", false); 
                            }
                    });
                    </script>
                @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
