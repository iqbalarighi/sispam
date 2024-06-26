@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header fw-bold text-uppercase">{{ __('Izin Kerja') }}</div>

@if(session('sukses'))
<script type="text/javascript">
    Swal.fire({
      icon: "success",
      title: "{{ session('sukses') }}",
      showConfirmButton: true,
      // timer: 1500
    });

</script>
@endif
                <div class="card-body  ">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   <style type="text/css">
                       th, td {
                        vertical-align: middle !important;
                       }
                       th {
                          position: sticky;
                          top: -2px;
                          background: seashell;
                          z-index: 1;
                        }
                        .table th {
                            padding:0.3rem;
                            white-space: break-word;
                            background-color: #e6e6e6;
                        }
                        .btn-cancel {
                            background-color : #fd7e14;
                        }
                        .btn-cancel:hover {
                            background-color : #ff851f;
                        }

                        .btn-extrem {
                            background-color : #8b0000;
                        }
                        .btn-extrem:hover {
                            background-color : #9b0101;
                        }
                        label {
                            margin-bottom: -1px;
                        }
                   </style>

            <div class="row">
                <div class="col-md-10">
                <form action="" method="GET" class="mb-2" id="carii">
                    <div class="col-sm-4 float-start mb-1 px-1" style="display: inline-block;">
                        <input type="text" class="form-control form-control-sm" name="cari" placeholder="Cari" autocomplete="off" id="cari" value="{{$cari ? $cari:''}}"> 
                    </div>
            @if(Auth::user()->role == "admin" or Auth::user()->unit_kerja == "Teknisi" or Auth::user()->unit_kerja == "Health, Safety, & Environment")
                    <div class="col-sm-3 float-start mb-1 px-1" style="display: inline-block; ">
                      <input type="text" class="form-control form-control-sm" id="start" name="start" value="{{$start ? Carbon\Carbon::parse($start)->isoFormat('MM/DD/YYYY'):''}}" placeholder="Tanggal Awal" onfocus="(this.type='date')" onblur="(this.type='date')">
                    </div>
                    <div class="col-sm-3 float-start mb-1 px-1" style="display: inline-block; ">
                      <input type="text" class="form-control form-control-sm" id="end" name="end" value="{{$end ? Carbon\Carbon::parse($end)->isoFormat('MM/DD/YYYY'):''}}" placeholder="Tangal Akhir" onfocus="(this.type='date')" onblur="(this.type='date')">
                    </div>
            @endif
                    <div class="float-start col-sm-2 mb-1 px-1 ">
                        <span class="mx-1 btn btn-sm float-end " style="display: inline-block; background-color: lightgrey;" id="reset"> Reset </span>
                        <button class="submit bi bi-search mx-1 float-end " style="display: inline-block;"></button> &nbsp;
                    </div>
                </form>
                </div>
            @if(Auth::user()->role == "admin" or Auth::user()->unit_kerja == "Teknisi" or Auth::user()->unit_kerja == "Health, Safety, & Environment")
                <div class="col-md-2 float-end">
                    @if($cari or $start)
                        @if($cari == null)
                     {{-- <button class="btn btn-sm float-end btn-primary mr-1">Download</button> --}}
                            <a href="izinkerja/{{$start}}/{{$end}}" target="_blank"><span class="btn btn-primary btn-sm float-end mr-1">Download</span></a>
                        @elseif($start == null)
                    <a href="izinkerja/{{$cari}}/" target="_blank"><span class="btn btn-primary btn-sm float-end mr-1">Download</span></a>
                        @else
                    <a href="izinkerja/{{$cari}}/{{$start}}/{{$end}}" target="_blank"><span class="btn btn-primary btn-sm float-end mr-1">Download</span></a>
                        @endif
                    @endif 
                </div>
            @endif
            </div>

            <div class="table-responsive-sm overflow" style="overflow-x: auto; height: 75vh;">
                <table class="table table-striped table-hover table-sm align-middle sticky-header">
                        <tr align="center">
                            <th scope="col">No</th>
                            <th scope="col">No. Laporan</th>
                            <th scope="col">Nama PT</th>
                            <th scope="col">PIC</th>
                            <th scope="col">Tanggal Permintaan</th>
                            <th scope="col">Risiko</th>
                            {{-- <th scope="col">Validasi</th> --}}
                            <th scope="col">Status</th>
                    @if(Auth::user()->unit_kerja == "Health, Safety, & Environment" || Auth::user()->unit_kerja == "Security Monitoring Center" || Auth::user()->role == "admin")
                            <th scope="col">Option</th>
                    @endif
                        </tr>
                    @foreach ($index as $key => $izin)
                        <tr>
                            <td onclick="window.location='{{url('izin-detail')}}/{{$izin->id}}'" style="cursor: pointer;">{{$index->firstitem()+$key}}</td> 
                            <td onclick="window.location='{{url('izin-detail')}}/{{$izin->id}}'" style="cursor: pointer;">{{$izin->izin_id}}</td>
                            <td onclick="window.location='{{url('izin-detail')}}/{{$izin->id}}'" style="cursor: pointer;">
                                    @if ('Lainnya ' == Str::substr($izin->izin_informasi->perusahaan_pemohon, 0,8))
                                        {{Str::substr($izin->izin_informasi->perusahaan_pemohon, 8,1000)}}
                                    @else
                                        {{$izin->izin_informasi->perusahaan_pemohon}}
                                    @endif

                            </td>
                            <td onclick="window.location='{{url('izin-detail')}}/{{$izin->id}}'" style="cursor: pointer;">{{$izin->izin_informasi->pemohon}}</td>
                            <td onclick="window.location='{{url('izin-detail')}}/{{$izin->id}}'" style="cursor: pointer;">{{Carbon\Carbon::parse($izin->created_at)->isoFormat('DD/MM/YYYY HH:mm:ss')}}</td>
                            <td onclick="window.location='{{url('izin-detail')}}/{{$izin->id}}'" style="cursor: pointer; text-align: center;">
                                @if($izin->risiko == "Sangat Rendah")
                                <font style="color: limegreen; font-weight: bold;">{{$izin->risiko}}</font>
                                @elseif($izin->risiko == "Rendah")
                                <font style="color: yellow; font-weight: bold; text-shadow: 1px 1px 3px #000000;">{{$izin->risiko}}</font>
                                @elseif($izin->risiko == "Sedang")
                                <font style="color: darkorange; font-weight: bold;">{{$izin->risiko}}</font>
                                @elseif($izin->risiko == "Tinggi")
                                <font style="color: red; font-weight: bold;">{{$izin->risiko}}</font>
                                @elseif($izin->risiko == "Sangat Tinggi")
                                <font style="color: darkred; font-weight: bold;">{{$izin->risiko}}</font>
                                @endif
                            </td>
                            {{-- <td onclick="window.location='{{url('izin-detail')}}/{{$izin->id}}'" style="cursor: pointer;">
                                    @if ($izin->izin_validasi->mulai_granted != null)
                                    {{__('Izin Diberikan')}}
                                @elseif ($izin->izin_validasi->mulai_denied != null)
                                    {{__('Izin Dibatalkan')}}
                                @else 
                                    {{__('Izin Belum Diberikan')}}
                                @endif
                            </td> --}}
                            <td align="center">
                                @if($izin->status == "Open")
                                <button class="btn btn-sm p-1 align-middle btn-danger">{{$izin->status}}</button>
                                @elseif($izin->status == "Waiting")
                                <button class="btn btn-sm p-1 align-middle btn-danger">{{$izin->status}}</button>
                                @elseif($izin->status == "On Progress")
                                <button class="btn btn-sm p-1 align-middle btn-success" style="text-wrap: nowrap;">{{$izin->status}}</button>
                                @elseif($izin->status == "Expired")
                                <button class="btn btn-sm p-1 align-middle btn-warning">{{$izin->status}}</button>
                                @elseif($izin->status == "Done")
                                <button class="btn btn-sm p-1 align-middle btn-primary">{{$izin->status}}</button>
                                @elseif($izin->status == "Canceled")
                                <button class="btn btn-sm p-1 align-middle btn-cancel">{{$izin->status}}</button>
                                @elseif($izin->status == "Continued")
                                <button class="btn btn-sm p-1 align-middle btn-info">{{$izin->status}}</button>
                                @endif
                            </td> 
                        @if(Auth::user()->unit_kerja == "Health, Safety, & Environment" || Auth::user()->unit_kerja == "Security Monitoring Center" || Auth::user()->role == "admin")
                            <td>
                        <div class="d-flex justify-content-sm-around" style="vertical-align: middle;">

                                <a href="{{url('izin-edit')}}/{{$izin->id}}" hidden>
                                <button id="{{$index->firstitem() + $key}}" title="Edit Data "></button>
                                </a>
                                <label for="{{$index->firstitem() + $key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn-sm align-self-center py-1" style="cursor: pointer; z-index: 0;"></label> 

                                &nbsp;
                            {{-- <span class="btn btn-sm btn-primary py-1 align-self-center" onclick="window.location='{{url('izin-validasi')}}/{{$izin->izin_id}}'" style="cursor: pointer; z-index: 0;">Validasi</span> --}}


                                <form action="hapus-izin/{{ $izin->izin_id }}" method="post" class="align-self-center" style="z-index: 0;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button id="del{{$index->firstitem() + $key}}" type="submit" title="Hapus Data {{$izin->izin_id}}" hidden></button>
                                <label for="del{{$index->firstitem() + $key}}" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn-sm align-self-center py-1" style="cursor: pointer;"></label>
                                </form>
                        </div>
                        
                            </td>
        <script>
            $('#del{{$index->firstitem() + $key}}').click(function(event){
                var form =  $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                          title: "Hapus Laporan {{$izin->izin_id}} ?",
                          text: "Data terhapus tidak dapat dikembalikan !",
                          icon: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#3085d6",
                          cancelButtonColor: "#d33",
                          cancelButtonText: "Batal",
                          confirmButtonText: "Hapus"
                        }).then((result) => {
                          if (result.isConfirmed) {
                            form.submit();
                          }
                        });
            });
        </script>
                        @endif
                        </tr>  
                    @endforeach
                </table>
            </div>
            {{$index->onEachSide(1)->links('pagination::bootstrap-5')}}
        {{-- {{Carbon\Carbon::today()->format('d/m/Y');}} --}}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
     $("#reset").click(function() {
        $("#cari").val(null);
        $("#start").val(null);
        $("#end").val(null);
        $("#carii").submit();
     });
</script>

@endsection
{{-- @foreach (explode(',',$izin->izin_perlengkapan->alat) as $item) {{$item}}<br> @endforeach --}}