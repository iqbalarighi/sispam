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
                <div class="card-header fw-bold text-uppercase">{{ __('Layanan Kelogistikan') }}</div>


@if (Session::get('sukses'))
<script type="text/javascript">
    Swal.fire({
  icon: "success",
  title: "{{Session::get('sukses')}}",
  showConfirmButton: false,
  timer: 1500,
});
</script>
@endif

<style type="text/css">
    td {
        vertical-align: middle !important;
    }
    .btn-cancel {
        background-color : #fd7e14;
    }
    .btn-cancel:hover {
        background-color : #ff851f;
    }
    .btn-closed {
        background-color : #8b0000;
        color: white;
    }
    .btn-closed:hover {
        background-color : #9b0101;
    }

</style>
                    

        <div class="card-body overflow pt-1 pb-0" style="overflow-x: auto;">
            <table class="table table-striped table-hover text-center ">
            <tr class="font-weight-normal xx ">
                <th class="align-middle" style="max-width:50px; min-width:30px;">No</th>
                <th class="align-middle">ID Layanan</th>
                <th class="align-middle">Waktu</th>
                <th class="align-middle">Layanan</th>
                <th class="align-middle">Lokasi</th>
                <th class="align-middle">Nama PIC</th>
                <th class="align-middle">Satker</th>
                {{-- <th class="align-middle">Email</th> --}}
                <th class="align-middle">Status</th>
                @if (Auth::user()->role === 'admin' || Auth::user()->unit_kerja === 'Fasilitas Kerja')
               <th class="align-middle" style="width:72px; ">Option</th>
               @endif
            </tr>
            @foreach($layan as $key => $layanan)
            <tr>
                <td onclick="window.location='{{route("layanan")}}/detail/{{$layanan->layanan_id}}'" style="cursor: pointer;">{{$layan->firstitem()+$key}}</td>
                <td onclick="window.location='{{route("layanan")}}/detail/{{$layanan->layanan_id}}'" style="cursor: pointer;">{{$layanan->layanan_id}}</td>
                <td onclick="window.location='{{route("layanan")}}/detail/{{$layanan->layanan_id}}'" style="cursor: pointer;">{{$layanan->tanggal}}</td>
                <td onclick="window.location='{{route("layanan")}}/detail/{{$layanan->layanan_id}}'" style="cursor: pointer; text-align: left !important;">
                    
                    @foreach(explode(',',$layanan->layanan) as $item)
                        @if ('Lain-lain' == Str::substr($item, 0,9))
                        <li>{{Str::substr($item, 12,1000)}}</li>
                        @else
                            <li>{{$item}}</li>
                        @endif
                    @endforeach
                </td>
                <td onclick="window.location='{{route("layanan")}}/detail/{{$layanan->layanan_id}}'" style="cursor: pointer;">{{$layanan->lokasi}}</td>
                <td onclick="window.location='{{route("layanan")}}/detail/{{$layanan->layanan_id}}'" style="cursor: pointer;">{{$layanan->pic}}</td>
                <td onclick="window.location='{{route("layanan")}}/detail/{{$layanan->layanan_id}}'" style="cursor: pointer;">{{$layanan->satker}}</td>
                {{-- <td>{{$layanan->email}}</td> --}}
                <td onclick="window.location='{{route("layanan")}}/detail/{{$layanan->layanan_id}}'" style="cursor: pointer;">
                    @if($layanan->status == "Open")
                        <button class="btn btn-sm p-1 align-middle btn-danger">{{$layanan->status}}</button>
                    @elseif($layanan->status == "Waiting")
                        <button class="btn btn-sm p-1 align-middle btn-danger">{{$layanan->status}}</button>
                    @elseif($layanan->status == "On Progress")
                        <button class="btn btn-sm p-1 align-middle btn-success">{{$layanan->status}}</button>
                    @elseif($layanan->status == "Done")
                        <button class="btn btn-sm p-1 align-middle btn-primary">{{$layanan->status}}</button>
                    @elseif($layanan->status == "Cancelled")
                        <button class="btn btn-sm p-1 align-middle btn-cancel">{{$layanan->status}}</button>
                    @elseif($layanan->status == "Cancelled by user")
                        <button class="btn btn-sm p-1 align-middle btn-cancel">Cancelled</button>
                    @elseif($layanan->status == "Closed")
                        <button class="btn btn-sm p-1 align-middle btn-closed">{{$layanan->status}}</button>
                    @endif
                </td>
                @if (Auth::user()->role === 'admin' || Auth::user()->unit_kerja === 'Fasilitas Kerja')
               <td class="p-0">

            <div class="d-flex justify-content-sm-around" style="height: 30px;">
                <a href="{{route('layanan')}}/edit/{{$layanan->layanan_id}}" hidden>
                <button id="{{$layan->firstitem() + $key}}" title="Edit Data "></button>
                </a>
                <label for="{{$layan->firstitem() + $key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn-sm align-self-center py-1" style="cursor: pointer; z-index: 0; margin-bottom: -1px;"></label> 
                &nbsp;
                <!-- <span class="btn btn-sm btn-primary align-self-center" onclick="window.location='{{route('layanan')}}/validasi/{{$layanan->layanan_id}}'" style="cursor: pointer; z-index: 0; vertical-align: middle; font-size: 12.5px; margin-bottom: -1px; padding: 4px 3px 4px 3px;">Validasi</span>
                &nbsp; -->
                <form action="{{route('layanan')}}/destroy/{{$layanan->layanan_id}}" method="post" class="align-self-center" style="z-index: 0;" onsubmit="return loding(this);">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button id="del{{$layan->firstitem() + $key}}" type="submit" title="Hapus Data {{$layanan->layanan_id}}" hidden></button>
                <label for="del{{$layan->firstitem() + $key}}" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn-sm align-self-center py-1" style="cursor: pointer; margin-bottom: -1px;"></label>
                </form>
            </div>

               </td>
               @endif
            </tr>
            @endforeach
            </table>
        </div>


            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
 function loding(form){
    Swal.fire({
          title: "Peringatan !",
          text: "Data yang dihapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Batal",
          confirmButtonText: "Hapus"
        }).then((result) => {
          if (result.isConfirmed) {
        form.submit();
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang menghapus data",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });  
          }
        });
    return false;
 }
</script>
@endsection