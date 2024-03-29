@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
                <!-- Notifikasi -->
        @if ($message = Session::get('sukses'))
            <script type="text/javascript">
                    Swal.fire({
                          title: "Berhasil",
                          text:  "{{$message}}",
                          icon: "success",
                          showConfirmButton: false,
                          timer: 1000
                        });
            </script>
        @endif
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Serah Terima Jaga') }}
                    <a href="{{route('tukar-tambah')}}"><span class="btn btn-primary float-right btn-sm">Buat Laporan</span></a>
                </div>

                <div class="card-body overflow pt-1 pb-1" style="overflow-x: auto;">

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

                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        @if ($start == null)

                        @else
                        <a href="tukarjaga/export/{{$start}}/{{$end}}"><span class="btn btn-primary btn-sm">Export Excel</span></a>
                        @endif
                    <form action="" method="GET" class="float-right mb-2">Pilih Tanggal: 
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
                        <th>Hari/Tanggal</th>
                        <th>Shift</th>
                        <th>Jam</th>
                        <th>Lokasi</th>                        
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')

                       <th style="width:72px; ">Option</th>
                       @endif
                    </tr>

                    @if ($trjg->count() == 0)
                    <tr>
                        <td colspan="8"> Data Tidak Ditemukan</td>
                    </tr>
                    @else

                    @foreach ($trjg as $key => $item)
                    <tr style="user-select: none; cursor: pointer;">
                        <td>{{$trjg->firstitem() + $key}}</td>
                        <td onclick="window.location='trj-detil/{{$item->no_trj}}/{{$item->id}}'" title="klik untuk lihat detail">{{$item->no_trj}}</td>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        <td onclick="window.location='trj-detil/{{$item->no_trj}}/{{$item->id}}'" title="klik untuk lihat detail" style="text-align: left;">{{$item->danru}}</td>
                       @endif
                        <td onclick="window.location='trj-detil/{{$item->no_trj}}/{{$item->id}}'" title="klik untuk lihat detail">{{Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd, D MMMM Y')}}</td>
                        <td onclick="window.location='trj-detil/{{$item->no_trj}}/{{$item->id}}'" title="klik untuk lihat detail" style="text-align: left;">{{$item->shift}}</td>
                        <td onclick="window.location='trj-detil/{{$item->no_trj}}/{{$item->id}}'" title="klik untuk lihat detail">{{Carbon\Carbon::parse($item->created_at)->isoFormat('HH:mm')}} WIB</td>
                        <td onclick="window.location='trj-detil/{{$item->no_trj}}/{{$item->id}}'" title="klik untuk lihat detail" style="text-align: left;">{{$item->site->nama_gd}}</td>
                         @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        <td>
                            <form action="/hapus-jaga/{{ $item->id }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button id="del{{$trjg->firstitem() + $key}}" type="submit" title="Hapus Data {{$item->no_trj}}" hidden>
                                </button>
                                <label style="cursor: pointer;" for="del{{$trjg->firstitem() + $key}}" class="bi bi-trash-fill bg-danger btn-sm align-self-center" title="Hapus Laporan">

                                </label>
                        </form>
                        </td>
<script>
    $('#del{{$trjg->firstitem() + $key}}').click(function(event){
        var form =  $(this).closest("form");
        event.preventDefault();
        Swal.fire({
                  title: "Hapus Laporan {{$item->no_trj}} ?",
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
                     {{$trjg->onEachSide(1)->links('pagination::bootstrap-5')}}
                </div>

            </div>
        </div>
    </div>
</div>
{{-- <script type="text/javascript">
    setTimeout(function(){
   window.location.reload(1);
}, 5000);
</script> --}}
@endsection