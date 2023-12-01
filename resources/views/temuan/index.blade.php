@extends('layouts.side')

@section('content')
                    <style>
                        .xx {
                            font-size: 10pt;
                            text-align: center;
                        }
                        .table tr td {
                            padding:0.1rem;
                            vertical-align: middle;
                            max-width:100%;
                            white-space:normal;
                        }
                        .table th {
                            padding:0.1rem;
                            white-space: normal;
                            vertical-align: middle;
                            /*background-color: seashell;*/
                        }
                        label {
                            margin: 0em;
                        }

                        .kanan {
                            float: right !important;
                        }
                    </style>
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Temuan Patroli') }}
                    
                    <a href="{{route('tambah-temuan')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
                    
                </div>

                
        @if ($message = Session::get('berhasil'))
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
            <div class="float-right mt-2 mb-0 ">
                    @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                    <form action="" method="GET" class="float-right mb-0 mr-3">
                        <span class="pl-3">Pilih Tanggal: &nbsp;</span>
                        <div class="kanan mt-1">
                        
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="start" > - 
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="end" >
                        <button class="submit bi bi-search"></button>
                    </div>
                    </form>
                    @else
                    <form action="" method="GET" class="float-right mb-0 mr-3">
                        <input type="date" class="" max="{{date('Y-m-d')}}" name="date">
                        <button class="submit bi bi-search"></button>
                    </form>
                    @endif
            </div>
                <div class="card-body overflow " style="overflow-x: auto;">
                {{-- conten disini --}}

                    <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm text-center ">
                    <tr class="font-weight-normal xx ">
                        <th scope="col" class="align-middle" style="max-width:50px; min-width:30px;">No</th>
                        <th scope="col" class="align-middle">No Laporan</th>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        <th scope="col" class="align-middle">User Pelapor</th>
                        @endif
                        <th scope="col" class="align-middle">Area</th>
                        {{-- <th scope="col" class="align-middle">Jenis Bahaya</th> --}}
                        {{-- <th scope="col" class="align-middle">Potensi Bahaya</th> --}}
                        {{-- <th scope="col" class="align-middle">Pengendalian</th> --}}
                        <th scope="col" class="align-middle">Dibuat</th>
                        <th scope="col" class="align-middle">Terakhir Diperbarui</th>
                        <th scope="col" class="align-middle">Status</th>
                        @if ($user == null)
                        <th class="align-middle" style="width:72px; ">Option</th>
                       @else
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator' || Auth::user()->name == $user->pelapor)
                       <th class="align-middle" style="width:72px; ">Option</th>
                       @endif

                       @endif
                    </tr>

                     @if ($temu->count() == null)
                    <tr>
                        <td colspan="8"> Data Tidak Ditemukan</td>
                    </tr>
                    @else

                    @foreach ($temu as $key => $item)
                    <tr style="cursor:pointer;" title="klik untuk lihat detail">
                        <td onclick="window.location='/temuan-detil/{{$item->id}}'" class="align-middle">{{$temu->firstItem() + $key}}</td>
                        <td onclick="window.location='/temuan-detil/{{$item->id}}'" class="align-middle">{{$item->no_lap}}</td>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator')
                        <td onclick="window.location='/temuan-detil/{{$item->id}}'" class="align-middle">{{$item->pelapor}}</td>
                         @endif
                        <td onclick="window.location='/temuan-detil/{{$item->id}}'" class="align-middle">{{$item->area}}</td>
                        {{-- <td onclick="window.location='/temuan-detil/{{$item->id}}'" class="align-middle">{{$item->jenis_bahaya}}</td> --}}
                        {{-- <td class="align-middle">{{$item->potensi_bahaya}}</td> --}}
                        {{-- <td class="align-middle">{{$item->pengendalian}}</td> --}}
                        <td onclick="window.location='/temuan-detil/{{$item->id}}'" class="align-middle">{{Carbon\Carbon::parse($item->created_at)->isoFormat('DD/MM/Y')}}</td>
                        <td onclick="window.location='/temuan-detil/{{$item->id}}'" class="align-middle">{{Carbon\Carbon::parse($item->updated_at)->isoFormat('DD/MM/Y')}}</td>
                        <td class="align-middle">
                        @if (Auth::user()->name == $item->pelapor || Auth::user()->role === 'admin')
                            <form action="temuan/status/{{$item->id}}" method="get"> @csrf 
                               <center> <button class="btn btn-sm {{ $item->status == 'Open' ? 'btn-danger' : 'btn-success' }}">{{$item->status}}</button></center>
                            </form>
                        @else 
                        <span style="cursor: not-allowed;" class="btn btn-sm {{ $item->status == 'Open' ? 'btn-danger' : 'btn-success' }}">{{$item->status}}</span>
                        @endif
                        </td>
                        @if (Auth::user()->role === 'admin' || Auth::user()->level === 'koordinator' || Auth::user()->name == $item->pelapor)
                        <td style="vertical-align: middle;">
                        <div class="d-flex align-content-center" >
                        <a href="{{url('temuan-edit')}}/{{$item->id}}" hidden>
                            <button id="{{$temu->firstitem() + $key}}" type="submit" title="Edit Data ">
                            </button>
                        </a>
                        <label style="cursor: pointer;" for="{{$temu->firstitem() + $key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn-sm align-self-center"></label>
                        <pre> </pre>
                        <form action="{{url('hapus-temuan')}}/{{$item->id}}" method="post" class="align-self-center m-auto">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        <button id="del{{$temu->firstitem() + $key}}" type="submit" title="Hapus Data" hidden>
                        </button>
                    <label style="cursor: pointer;" for="del{{$temu->firstitem() + $key}}" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn-sm align-self-center"></label>
                        </form>
                        </div>
                        </td>
<script>
    $('#del{{$temu->firstitem() + $key}}').click(function(event){
        var form =  $(this).closest("form");
        event.preventDefault();
        Swal.fire({
                  title: "Hapus Laporan ?",
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
                </div>
                {{$temu->onEachSide(1)->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>
@endsection