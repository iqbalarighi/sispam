@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
                <!-- Notifikasi -->
        @if ($message = Session::get('sukses'))
            <script>
                    Swal.fire({
                      title: "Berhasil",
                      text:  "{{ $message }}",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 1000
                    });
            </script>
        @endif
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Kegiatan') }}
                    <a href="{{route('tambah-giat')}}"><span class="btn btn-primary float-right btn-sm">Buat Laporan</span></a>
                </div>             

                
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
                        }
                        .table th {
                            padding:0.3rem;
                            white-space:nowrap;
                            vertical-align: middle;
                        }
                        label {
                            margin: 0em;
                        }
                    </style>
                    <style>
                        a {color:black;}
                       a:hover { color:rgb(0, 138, 0);}
                       label:hover { color:rgb(0, 138, 0);}
                    </style>

                <div class="card-body overflow pt-1 pb-1" style="overflow-x: auto;">
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        @if ($start == null)

                        @else
                        <a href="kegiatan/export/{{$start}}/{{$end}}"><span class="btn btn-primary btn-sm">Export Excel</span></a>
                        @endif
                    <form action="" method="GET" style="text-align: right !important;" class="float-right mb-2 mt-2 mr-2">Pilih Tanggal: 
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="start"> - 
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="end" >
                        <button class="submit bi bi-search"></button>
                    </form>
                    @else
                    <form action="" method="GET" class="float-right mb-2">
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="date">
                        <button class="submit bi bi-search"></button>
                    </form>
                       @endif
                    
                    <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm text-center ">
                    <tr class="font-weight-normal xx ">
                        <th style="max-width:50px; min-width:30px;">No</th>
                        <th>No. Laporan</th>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                       <th style="width:72px; ">Danru</th>
                       @endif
                        <th>Shift</th>
                        <th>Hari/Tanggal</th>
                        <th>Jam</th>
                        <th>Lokasi</th>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        
                       <th style="width:72px; ">Option</th>
                       @endif
                    </tr>

                    @if ($giats->count() == 0)
                    <tr>
                        <td colspan="8"> Data Tidak Ditemukan</td>
                    </tr>
                    @else
{{-- {{dd($gg)}} --}}
                    @foreach($giats as $key => $giat)
                    <tr style="cursor: pointer; user-select: none;" class="bg-{{in_array($giat->no_lap, $gg )? 'info' : '' }}"  > 
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'" title="klik untuk lihat detail">{{$giats->firstitem() + $key}}</td>
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'" title="klik untuk lihat detail">{{$giat->no_lap}}</td>
                         @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'" title="klik untuk lihat detail" style="text-align: left;">{{$giat->danru}}</td>
                       @endif
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'"  title="klik untuk lihat detail" style="text-align: left;">
                    
                    @if ( Carbon\Carbon::parse($giat->created_at)->isoFormat('HHmmss') >= 200000)
                        Shift Malam 19.00 - 07.00 WIB
                    @elseif (Carbon\Carbon::parse($giat->created_at)->isoFormat('HHmmss') <= 80000)
                        Shift Malam 19.00 - 07.00 WIB
                    @else
                        Shift Pagi 07.00 - 19.00 WIB
                    @endif

                        </td>
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'" title="klik untuk lihat detail">{{Carbon\Carbon::parse($giat->tanggal)->isoFormat('dddd, D MMMM Y')}}</td>
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'" title="klik untuk lihat detail">{{Carbon\Carbon::parse($giat->updated_at)->isoFormat('HH:mm')}} WIB</td>
                        <td onclick="window.location='/giat-detil/{{$giat->id}}'" title="klik untuk lihat detail" style="text-align: left;">{{$giat->site->nama_gd}}</td>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        
                        <td class="d-flex p-0" >
                        <a href="{{url('edit-giat')}}/{{$giat->id}}" hidden>
                            <button id="{{$giats->firstitem() + $key}}" type="submit" title="Edit Data {{$giat->no_lap}}">
                            </button>
                        </a>
                        <label for="{{$giats->firstitem() + $key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn-sm align-self-center">

                        </label>
                            <pre> </pre>
                        <form action="hapus-giat/{{ $giat->id }}" method="post" class="align-self-center">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button id="del{{$giats->firstitem() + $key}}" type="submit" title="Hapus Data {{$giat->no_lap}}" hidden>
                                </button>
                                <label for="del{{$giats->firstitem() + $key}}" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn-sm align-self-center">

                                </label>
                        </form>
                        </td>
<script>
    $('#del{{$giats->firstitem() + $key}}').click(function(event){
        var form =  $(this).closest("form");
        event.preventDefault();
        Swal.fire({
                  title: "Hapus Laporan {{$giat->no_lap}} ?",
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

                    @endif
                    </table>
                </div>
                {{$giats->onEachSide(1)->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection