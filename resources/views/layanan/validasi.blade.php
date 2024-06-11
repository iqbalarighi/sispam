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
                <div class="card-header fw-bold text-uppercase">{{ __('Halaman Validasi') }}
                    <a href="{{ route('layanan') }}/detail/{{$validasi->layanan_id}}"><span class="btn btn-primary float-right btn-sm mx-2 py-1">Kembali</span></a>
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
                window.location = "{{url('layanan/detail/'.$validasi->layanan_id)}}";
                }, 2000);
            
        </script>
@endif
                <div class="card-body">
                    <form action="{{url('layanan/valid')}}/{{$validasi->id}}" class="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex justify-content-center">
                    <div class="col-md-5" >
                        <div class="form-floating">
                            <select class="form-select form-select-sm" name="izin" id="izin" required>
                                <option></option>
                                <option value="On Progress">Permohonan diproses</option>
                                <option value="Cancelled">Permohonan ditolak</option>
                            </select>
                            <label for="izin">Status Permohonan</label>
                        </div>
                        <div class="form-floating" >
                            <div class="fw-bold">Jenis Layanan </div>
                                @foreach(explode(',',$validasi->layanan) as $item)
                                <li>{{$item}}</li>
                                @endforeach
                        </div>
                        <div class="form-floating">
                            <input type="datetime-local" name="waktu" id="waktu" class="form-control form-control-sm" value="{{Carbon\Carbon::parse($validasi->tanggal)->isoFormat('YYYY-MM-DD HH:mm:ss')}}" required>
                            <label for="waktu">Waktu</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" name="pic" id="pic" value="{{$validasi->pic}}" class="form-control form-control-sm" disabled readonly>
                            <label for="pic">PIC</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="satker" placeholder="Leave a comment here" name="satker" value="{{$validasi->satker}}" disabled readonly>
                            <label for="satker">Satker</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" name="periksa" id="periksa" value="{{Auth::user()->name}}" placeholder="Leave a comment here" class="form-control" disabled readonly>
                            <label for="periksa">Pemeriksa</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="ket" style="height: 75px;" name="ket">{{$validasi->ket}}</textarea>
                            <label for="ket">Keterangan</label>
                        </div>
                    <div class="d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-sm btn-primary">Validasi</button>
                    </div>
                    </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection