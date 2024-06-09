@extends('layouts.side')

@section('content')

@if(Auth::user()->role == 'admin')
@elseif(Auth::user()->unit_kerja == 'Fasilitas Kerja')
@else 
{{abort(403)}}
@endif

<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header fw-bold text-uppercase">{{ __('Detail Layanan Kelogistikan') }}
                    <a href="{{ route('layanan') }}"><span class="btn btn-primary float-right btn-sm mx-2 py-1">Kembali</span></a>
                    @if(Auth::user()->name == 'Superadmin')
                        <span class="btn btn-sm btn-primary align-self-center float-right mx-2 py-1" onclick="window.location='{{route('layanan')}}/validasi/{{$show->layanan_id}}'" style="cursor: pointer; z-index: 0; vertical-align: middle; margin-bottom: -1px; padding: 4px 3px 4px 3px;">Otorisasi</span>
                        <span class="btn btn-sm btn-primary align-self-center float-right mx-2 py-1" onclick="window.location='{{route('layanan')}}/validasi/{{$show->layanan_id}}'" style="cursor: pointer; z-index: 0; vertical-align: middle; margin-bottom: -1px; padding: 4px 3px 4px 3px;">Validasi</span>
                    @elseif(Auth::user()->unit_kerja == 'Fasilitas Kerja' || Auth::user()->role == 'admin')
                        @if($otorized == null) 
                            @if($show->validatedby == null)
                            <span class="btn btn-sm btn-primary align-self-center float-right mx-2 py-1" onclick="window.location='{{route('layanan')}}/validasi/{{$show->layanan_id}}'" style="cursor: pointer; z-index: 0; vertical-align: middle; margin-bottom: -1px; padding: 4px 3px 4px 3px;">Validasi</span>
                            @endif
                        @else 
                            <span class="btn btn-sm btn-primary align-self-center float-right mx-2 py-1" onclick="return oto()" style="cursor: pointer; z-index: 0; vertical-align: middle; margin-bottom: -1px; padding: 4px 3px 4px 3px;">Otorisasi</span>
                            <script type="text/javascript">
                                function oto() {                              
                                        Swal.fire({
                                              title: "Otorisasi Dokumen",
                                              icon: "warning",
                                              showCancelButton: true,
                                              confirmButtonColor: "#3085d6",
                                              cancelButtonColor: "#d33",
                                              confirmButtonText: "Otorisasi",
                                              cancelButtonText: "Batal"
                                            }).then((result) => {
                                              if (result.isConfirmed) {
                                                window.location='{{url('/layanan/detail/otorisasi/'.$show->layanan_id.'/'.$otorized->id)}}'
                                              }
                                            });
                                        }

                            </script>
                        @endif
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
                    <div>
                        <b>Lokasi</b>
                        <div>
                            {{$show->lokasi}}
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

                    @if($show->otorizedby != null && $show->validatedby != null)
                <div align="center">
                    <a target="_blank" href="{{url('layanan/detail')}}/{{$show->id}}/{{$show->otorizedby}}/{{$show->validatedby}}"><button class="btn btn-primary btn-sm float-center ml-2">Download PDF</button></a>
                </div>
                @endif

                @if($show->validatedby != null && $show->otorizedby == null)
                <div align="center" class="my-3">
                   <span class="bg-success text-white rounded fw-bold py-1 px-2">Dokumen telah di Validasi</span>
                </div>
                @endif

                @if($show->otorizedby == null && $show->validatedby == null)
                <div align="center" class="my-2">
                    <span class="bg-danger text-white rounded fw-bold py-1 px-2">Dokumen belum di Otorisasi dan di Validasi</span>
                </div>
                @endif



                {{-- @if(Auth::user()->unit_kerja != "Health, Safety, & Environment" || Auth::user()->unit_kerja != "Security Monitoring Center" || Auth::user()->role != "admin") 
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
                 @endif --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
