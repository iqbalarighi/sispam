@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Tambah Data Arsip') }}
                    <a href="{{route('arsip')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

                </div>

                <div class="card-body overflow " >
                        <style>
                            .table tr td {
                            word-wrap: break-word;
                            vertical-align: middle;
                            white-space: nowrap;
                            padding:1px !important;    
                            }
                        </style>
                        
    <!-- Error Handle -->
        @if ($errors->any())

                            @foreach ($errors->all() as $error)
                <script>
                    Swal.fire({
                      title: "Oops...",
                      text:  `{{$error}}`,
                      icon: "error",
                      showConfirmButton: true
                    });
            </script>
                    @endforeach

        @endif

    <!-- Notifikasi -->
        @if ($message = Session::get('status'))
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

            <!-- form input Site -->
                    <div class="table-responsive mt-2" style="overflow-x: auto;">
            <form action="{{route('simpan_arsip')}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
                    <table class="table mx-auto" style="width: 70%; ">
                    <tr>
                        <td>No Arsip</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="norsip" id="norsip" value="{{$gen}}" readonly></td> 
                    </tr>
                    <tr>
                        <td>Nama Arsip</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="nm_arsip" id="nm_arsip" ></td>
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" maxlength="4" onkeypress="return angka(event)" name="tahun" id="tahun" required></td>
                    </tr>
                    <tr>
                        <td>Uraian</td>
                        <td>:</td>
                        <td><textarea type="text" class="form-control pb-0 pt-0" name="uraian" id="uraian" required></textarea></td>
                    </tr>
                    <tr>
                        <td>Lokasi Fisik</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="losik" id="losik" ></td>
                    </tr>
                    <tr>
                        <td>Upload File</td>
                        <td>:</td>
                        <td><input type="file" accept=".pdf" name="arsip" id="arsip" ></td>
                    </tr>
                    </table>
                <center>
                    <button type="submit" class="btn btn-primary" style = "text-align:center">
                        {{ __('Simpan') }}
                    </button>
                </center>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection