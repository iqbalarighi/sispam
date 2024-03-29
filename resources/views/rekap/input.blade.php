@extends('layouts.side')

@section('content')

<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Tambah Data Rekap Harian') }}
                    <a href="{{route('rekap')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

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
            <div id="timeout" class="alert alert-danger flex flex-col md:justify-between" style="width: 80%; margin: 0 auto;">
                <div class="col-md-auto">
                        <div style="float: right;">
                            <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close" align="right"></button>
                        </div>                
                    </div>
                            @foreach ($errors->all() as $error)
                <div class="row">
                    <div class="col">
                        <div class="card-text" align="center">
                            {{ $error }} 
                        </div>
                    </div>
                </div>
                    @endforeach
            </div>
        @endif

    <!-- Notifikasi -->
        @if ($message = Session::get('status'))
            <script>
                    Swal.fire({
                      title: "Berhasil",
                      text:  "Rekap Harian Berhasil Tersimpan !",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 1500
                    });

            setTimeout(function () {
                   window.location = "{{url('rekap')}}";
                }, 1700); 
                    
            </script>
        @endif

    {{-- @if ($message = Session::get('status'))
            <div id="timeout" align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
                <div class="row">
                    <div class="col">
        <div class="card-text" align="center">
                    {{ $message }}
        </div>
                    </div>
                    <div class="col-md-auto">
        <div style="float: right;">
        <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close" align="right"></button>
        </div>                
                    </div>
                </div>
            </div>
        @endif --}}

            <!-- form input Site -->
                    <div class="table-responsive mt-2" style="overflow-x: auto;">
            <form action="{{route('simpan_rekap')}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
                    <table class="mx-auto" style="width: 70%; ">
                    <tr>
                        <td>Tanggal File</td>
                        <td>:</td>
                        <td><input id="bulan" type="month" class="form-control pb-0 pt-0" onkeypress="return angka(event)" name="bulan" required></td>
                    </tr>
                    <tr>
                        <td>Upload File</td>
                        <td>:</td>
                        <td><input id="file" type="file" accept=".pdf" name="rekap[]" required multiple></td>
                    </tr>
                    </table>
                <center>
                    <input type="submit" onclick="test()" value="Simpan" class="btn btn-primary btn-sm" style = "text-align:center">
                        
                </center>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
    $("input[type='submit']").click(function(){
        var $fileUpload = $("input[type='file']");
        if (parseInt($fileUpload.get(0).files.length)>20){
         alert("You can only upload a maximum of 20 files");
        }
    });    
});
</script>
<script>
    function test() {

    if (document.getElementById('bulan').value == ""){
        document.getElementById('bulan').focus();
    } else if (document.getElementById("file").value == ""){
        document.getElementById("file").focus();
    } else {
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang Proses mas bro",
            showConfirmButton: false, 
            allowOutsideClick: false,
            backdrop: `
                rgb(13, 202, 240, 0.4)
              `,
              didOpen: () => {
                Swal.showLoading();
            }
            });  
    }
}
</script>
@endsection