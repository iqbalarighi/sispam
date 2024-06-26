@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Tambah Data User') }}
                    <a href="{{route('users')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

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
        {{-- Password Error --}}
                @error('password')
            <div id="timeout" class="alert alert-danger flex flex-col md:justify-between" style="width: 80%; margin: 0 auto;">
                <div class="col-md-auto">
                        <div style="float: right;">
                            <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close" align="right"></button>
                        </div>                
                    </div>
                    <strong>{{ $message }}</strong>
            </div>
        @enderror

    <!-- Notifikasi -->
        @if ($message = Session::get('sukses'))
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
        @endif


            <!-- form input Site -->
                    <div class="table-responsive mt-2" style="overflow-x: auto;">
            <form action="{{route('simpan_user')}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
                    <table class="table mx-auto" style="width: 70%; ">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="name" id="name" placeholder="Nama" required></td> 
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="text" class="form-control pb-0 pt-0" name="email" id="email" placeholder="Email" required></td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td>:</td>
                        <td>
                            <select class="form-select" name="role" id="role" required>
                                <option value="" disabled selected>Pilih Role Akses</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td>:</td>
                        <td>
                            <select class="form-select" name="level" id="level">
                                <option value="" disabled selected>Pilih Level Akses</option>
                                <option value="koordinator">Koordinator</option>
                                <option value="danru">Danru</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Lokasi Tugas</td>
                        <td>:</td>
                        <td>
                        <select class="form-select pb-0 pt-0 text-capitalize" id="lokasi" name="lokasi" >
                                <option value="" disabled selected>Pilih Lokasi</option>
                                @foreach($site as $item)
                                <option value="{{$item->id}}">{{$item->nama_gd}}</option>
                                @endforeach
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

                    </tr>
                    <tr>
                        <td>Ulangi<br/>Password</td>
                        <td>:</td>
                        <td><input id="password-confirm" type="password" class="form-control passwordx" name="password_confirmation" placeholder="Konfirmasi Password" required autocomplete="new-password" disabled>
                        <div style="margin-top: 0px;" id="CheckPasswordMatch"></div>
                        <div style="margin-top: 0px;" id="CheckPasswordMatchz"></div>
                    </td>
                    </tr>
                    </table>
                    <center>
                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="lihat" onclick="cekPass()"> 
                                    <label class="form-check-label" for="lihat">
                                       {{ __('Lihat Password') }}
                                    </label>
                    </div>
                
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
<script>
$(document).ready(function () {
   $("#password-confirm").on('keyup', function(){
    var password = $("#password").val();
    var confirmPassword = $("#password-confirm").val();
    if (confirmPassword == password){
        $("#CheckPasswordMatch").html("Password Sama !").css("color","green");
    }
    else
    {
        $("#CheckPasswordMatch").html("Password Tidak Sama !").css("color","red");
    }
   
});


$("#password").on('keyup', function(){
     if (!$('#password').val().length) {
    $("#CheckPasswordMatch").html("").css("color","");
    $("#password-confirm").val("");
  }
});

$("#password").on('keyup', function(){
   if ($("#password").val().length === 0){
        $("#CheckPasswordMatch").html("").css("color","");
        $("#password-confirm").val("");
        $("#password-confirm").prop("disabled", true);
    } else if ( 5 >= $("#password").val().length){
        $("#CheckPasswordMatch").html("Password kurang dari 6 karakter !").css("color","red");
        $("#password-confirm").prop("disabled", true);
        $("#password-confirm").prop("required", false);
    } else  {
        $("#CheckPasswordMatch").html("").css("color","");
        $("#password-confirm").prop("disabled", false);
        $("#password-confirm").prop("required", true);

    }
});

});
</script>

<script>

    function cekPass() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
      } else {
    x.type = "password";
  }
}

$(document).ready(function () {
    $("#lihat").on('click', function(){
      if ($(".passwordx").attr("type") === "password") {
        $(".passwordx").attr("type", "text");
      } else {
        $(".passwordx").attr("type", "password");
      }
});
});
</script>
@endsection

