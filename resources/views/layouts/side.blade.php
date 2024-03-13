<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>{{ config('app.name', 'SISPAM') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.x/dist/alpine.min.js" defer></script>
        {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}

<script src={{asset("/storage/bootstrap3-typeahead.js")}}></script>

{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- select2 --}}

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

            <!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    @livewireScripts
    @stack('js')
    @stack('styles')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <script>
        jQuery(document).ready(function($){
            $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
            });
        })
        </script>
        <style>
            body {
        overflow-x: hidden;
        }
        #sidebar-wrapper {
        min-height: 100vh;
        margin-left: -15rem;
        -webkit-transition: margin .25s ease-out;
        -moz-transition: margin .25s ease-out;
        -o-transition: margin .25s ease-out;
        transition: margin .25s ease-out;
        }
        #sidebar-wrapper .sidebar-heading {
        padding: 0.875rem 1.25rem;
        font-size: 1.2rem;
        }
        #sidebar-wrapper .list-group {
        width: 15rem;
        }
        #page-content-wrapper {
        min-width: 100vw;
        }
        #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
        }
        @media (min-width: 768px) {
        #sidebar-wrapper {
            margin-left: 0;
        }
        #page-content-wrapper {
            min-width: 0;
            width: 100%;
        }
        #wrapper.toggled #sidebar-wrapper {
            margin-left: -15rem;
        }
        }

       .list-group-item.active {
        color: #000 !important;
        font-weight: bold !important;
        border-color: #d9dadb !important;
       } 


        </style>    
    </head>
    <body>
    @if ( Auth::user()->role === 'admin')
        <div class="d-flex " id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right " id="sidebar-wrapper">
        <div class="list-group list-group-flush sticky-top">
        <div class="sidebar-heading " style="background-color: #0dcaf0;"><b>SISPAM</b></div>
{{-- user level 1 --}}
    @if ( Auth::user()->level === 'superadmin')
        <a onclick="cekDowns()" class="list-group-item list-group-item-action bg-light {{ Route::is('users')||Route::is('otorisasi')||Route::is('filemanager') ? 'active' : '' }}" data-bs-toggle="collapse"  href="#collapseExamples" role="button" aria-expanded="false" aria-controls="collapseExamples">

                Superadmin Area 
                        <i id="rubah" class="bi bi-caret-right-fill"></i>
              </a>
                <div class="collapse {{ Route::is('users')||Route::is('otorisasi')||Route::is('filemanager') ? 'show' : '' }}" id="collapseExamples">
                    <div class="card card-body">
                        <div class="list-group list-group-flush" style="width: 100%;">
                            <a href="{{route('users')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('users') ? 'active' : '' }}">Manage User</a>
                            <a href="{{route('otorisasi')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('otorisasi') ? 'active' : '' }}">Otorisasi</a>
                            <a href="{{route('filemanager')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('filemanager') ? 'active' : '' }}">File Manager</a>
                        </div> 
                    </div>
                </div>
    @endif 
{{-- user level 1 --}}

{{-- user level 2 --}}
            <a href="{{route('dashboard')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{route('personil')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('personil') ? 'active' : '' }}">Personil</a>
            <a href="{{route('peralatan')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('peralatan') ? 'active' : '' }}">Inventaris</a>
            <a href="{{route('site')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('site') ? 'active' : '' }}">Site</a>
            <a href="{{route('posjaga')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('posjaga') ? 'active' : '' }}">Pos Jaga</a>
            <a href="{{route('parkir')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('parkir') ? 'active' : '' }}">Lot Parkir</a>
            <a href="{{route('arsip')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('arsip') ? 'active' : '' }}">Arsip</a>
            <a href="{{route('layanan')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('layanan') ? 'active' : '' }}">Layanan</a>

            <a onclick="cekDown()" class="list-group-item list-group-item-action bg-light {{ Route::is('kegiatan')||Route::is('tukarjaga')||Route::is('temuan') ? 'active' : '' }}" data-bs-toggle="collapse"  href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">

                Laporan PAM
                        <i id="ubah" class="bi bi-caret-right-fill"></i>
              </a>
                <div class="collapse {{ Route::is('kegiatan')||Route::is('tukarjaga')||Route::is('temuan') ? 'show' : '' }}" id="collapseExample">
                    <div class="card card-body">
                        <div class="list-group list-group-flush" style="width: 100%;">
                            <a href="{{route('kegiatan')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('kegiatan') ? 'active' : '' }}">Kegiatan</a>
                            <a href="{{route('tukarjaga')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('tukarjaga') ? 'active' : '' }}">Serah Terima Jaga</a>
                            <a href="{{route('temuan')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('temuan') ? 'active' : '' }}">Temuan Patroli</a>
                        </div> 
                    </div>
                </div>
            <a onclick="cekHse()" class="list-group-item list-group-item-action bg-light {{ Route::is('kejadian') ? 'active' : '' }}" data-bs-toggle="collapse"  href="#hse" role="button" aria-expanded="false" aria-controls="collapseExample">
                Laporan HSE
                        <i id="changeHSE" class="bi bi-caret-right-fill"></i>
              </a>
                <div id="hse" class="collapse {{ Route::is('kejadian')||Route::is('izin_kerja') ? 'show' : '' }}" >
                    <div class="card card-body">
                        <div class="list-group list-group-flush" style="width: 100%;">
                            <a href="{{route('kejadian')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('kejadian') ? 'active' : '' }}">Insiden/Kejadian</a>
                            <a href="{{route('izin_kerja')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('izin_kerja') ? 'active' : '' }}">Izin Kerja</a>
                        </div> 
                    </div>
                </div>
            <a onclick="cekSmc()" class="list-group-item list-group-item-action bg-light {{ Route::is('laporan_smc')||Route::is('bencana')||Route::is('atensi')||Route::is('rekap') ? 'active' : '' }}" data-bs-toggle="collapse"  href="#smc" role="button" aria-expanded="false" aria-controls="collapseExample">
                Laporan SMC
                        <i id="changeSmc" class="bi bi-caret-right-fill"></i>
              </a>
                <div class="collapse {{ Route::is('bencana')||Route::is('laporan_smc')||Route::is('atensi')||Route::is('rekap') ? 'show' : '' }}" id="smc">
                    <div class="card card-body">
                        <div class="list-group list-group-flush" style="width: 100%;">
                            <a href="{{route('laporan_smc')}}"  class="list-group-item list-group-item-action bg-light {{ Route::is('laporan_smc') ? 'active' : '' }}">Kegiatan</a>
                            <a href="{{route('bencana')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('bencana') ? 'active' : '' }}">Kegawatdaruratan</a>
                            <a href="{{route('atensi')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('atensi') ? 'active' : '' }}">Atensi</a>
                            <a href="{{route('rekap')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('rekap') ? 'active' : '' }}">Rekap Harian</a>

                            {{-- <a href="#" style="cursor: not-allowed; " class="list-group-item list-group-item-action bg-light">Unras</a> --}}
                        </div> 
                    </div>
                </div>
            <a href="{{route('unras')}}"  class="list-group-item list-group-item-action bg-light {{ Route::is('unras') ? 'active' : '' }}">Unras</a>
             {{-- <a href="{{route('grafik')}}"  class="list-group-item list-group-item-action bg-light {{ Route::is('grafik') ? 'active' : '' }}">Grafik Unras</a> --}}
<!--             <a href="#" class="list-group-item list-group-item-action bg-light">Akun Anggaran</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Realisasi Anggaran</a> -->
        </div>
        </div>
{{-- user level 2 --}}

{{-- user level 3 --}}
    @elseif (Auth::user()->level === 'danru' || Auth::user()->level === 'koordinator')
            <div class="d-flex " id="wrapper">
        <!-- Sidebar -->
        
        <div class="bg-light border-right " id="sidebar-wrapper">
        <div class="list-group list-group-flush sticky-top">
        <div class="sidebar-heading ">SISPAM</div>
{{--     @if (Auth::user()->level === 'koordinator')
            <a href="{{route('posjaga')}}" class="list-group-item list-group-item-action bg-light">Pos Jaga</a>
    @endif --}}
            <a href="{{route('dashboard')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{route('posjaga')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('posjaga') ? 'active' : '' }}">Pos Jaga</a>
            <a href="{{route('parkir')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('parkir') ? 'active' : '' }}">Lot Parkir</a>
            <a onclick="cekDown()" class="list-group-item list-group-item-action bg-light {{ Route::is('kegiatan')||Route::is('tukarjaga')||Route::is('temuan') ? 'active' : '' }}"  data-bs-toggle="collapse"  href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Laporan PAM
                        <i id="ubah" class="bi bi-caret-right-fill"></i>
              </a>
                <div class="collapse {{ Route::is('kegiatan')||Route::is('tukarjaga')||Route::is('temuan') ? 'show' : '' }}" id="collapseExample">
                    <div class="card card-body">
                        <div class="list-group list-group-flush" style="width: 100%;">
                            <a href="{{route('kegiatan')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('kegiatan') ? 'active' : '' }}">Kegiatan</a>
                            <a href="{{route('tukarjaga')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('tukarjaga') ? 'active' : '' }}">Serah Terima Jaga</a>
                            <a href="{{route('temuan')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('temuan') ? 'active' : '' }}">Temuan Patroli</a>
                        </div> 
                    </div>
                </div>

            <a onclick="cekHse()" class="list-group-item list-group-item-action bg-light {{ Route::is('kejadian') || Route::is('izin_kerja') ? 'active' : '' }}" data-bs-toggle="collapse"  href="#hse" role="button" aria-expanded="false" aria-controls="collapseExample">
                Laporan HSE
                        <i id="changeHSE" class="bi bi-caret-right-fill"></i>
              </a>
                <div class="collapse {{ Route::is('kejadian') || Route::is('izin_kerja') ? 'show' : '' }}" id="hse">
                    <div class="card card-body">
                        <div class="list-group list-group-flush" style="width: 100%;">
                            <a href="{{route('kejadian')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('kejadian') ? 'active' : '' }}">Insiden/Kejadian</a>
                            {{-- @if("Rizal Kurnia" == Auth::user()->name || "Andri Triana" == Auth::user()->name) --}}
                            <a href="{{route('izin_kerja')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('izin_kerja') ? 'active' : '' }}">Izin Kerja</a>
                            {{-- @endif --}}
                        </div> 
                    </div>
                </div>

            <a onclick="cekSmc()" class="list-group-item list-group-item-action bg-light {{ Route::is('laporan_smc')||Route::is('bencana')||Route::is('atensi')||Route::is('rekap') ? 'active' : '' }}" data-bs-toggle="collapse"  href="#smc" role="button" aria-expanded="false" aria-controls="collapseExample">
                Laporan SMC
                        <i id="changeSmc" class="bi bi-caret-right-fill"></i>
              </a>
                <div class="collapse {{ Route::is('bencana')||Route::is('laporan_smc')||Route::is('atensi')||Route::is('rekap') ? 'show' : '' }}" id="smc">
                    <div class="card card-body">
                        <div class="list-group list-group-flush" style="width: 100%;">
                            <a href="{{route('laporan_smc')}}"  class="list-group-item list-group-item-action bg-light {{ Route::is('laporan_smc') ? 'active' : '' }}">Kegiatan</a>
                            <a href="{{route('bencana')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('bencana') ? 'active' : '' }}">Kegawatdaruratan</a>
                            <a href="{{route('atensi')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('atensi') ? 'active' : '' }}">Atensi</a>
                            <a href="{{route('rekap')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('rekap') ? 'active' : '' }}">Rekap Harian</a>

                            {{-- <a href="#" style="cursor: not-allowed; " class="list-group-item list-group-item-action bg-light">Unras</a> --}}
                        </div> 
                    </div>
                </div>
            <a href="{{route('unras')}}" class="list-group-item list-group-item-action bg-light {{ Route::is('unras') ? 'active' : '' }}">Unras</a>
            <!-- <a href="#" class="list-group-item list-group-item-action bg-light">Laporan</a> -->
<!--             <a href="#" class="list-group-item list-group-item-action bg-light">Akun Anggaran</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Realisasi Anggaran</a> -->
        </div>
        </div>
        <!-- /#sidebar-wrapper -->

    @endif
{{-- user level 3 --}}

        <!-- Page Content -->
        <div id="page-content-wrapper" class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-info border-bottom sticky-top">
            <button class="btn btn-light ms-2" id="menu-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill-rule="evenodd" d="M4 7a1 1 0 100-2 1 1 0 000 2zm4.75-1.5a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zM5 12a1 1 0 11-2 0 1 1 0 012 0zm-1 7a1 1 0 100-2 1 1 0 000 2z">
                    </path>
                </svg>
            </button>
            <button class="navbar-toggler me-3" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-2" id="navbarSupportedContent">
            
                        <!-- Authentication Links -->
                        
            <div class="nav-link me-5 pe-5 ml-auto">
            <div class="dropdown">
              <a class="nav-link dropdown-toggle text-white font-weight-bold" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
              </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li>
                    <a class="dropdown-item font-weight-bold ps-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                {{-- <li><a href="#" class="dropdown-item font-weight-bold ps-2"> </a></li> --}}
              </ul>
            </div>
            </div>
            </div>
        </nav>
        <main class="py-1">
            @yield('content')
        </main>
            <footer class="mt-auto">
                  <center>Copyright &copy; {{Carbon\Carbon::today()->isoFormat('Y');}} www.sispam.id. All Rights Reserved </center>  
            </footer>
        </div>
    </div>
</div>
</body>

        <!-- /#page-content-wrapper -->
         
        <!-- /#wrapper -->
    <!-- Adding scripts to use bootstrap -->
{{--     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity=
"sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous">
    </script> --}}
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity=
"sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous">
    </script>
{{--     <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity=
"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous">
    </script>  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

<script>
    $('#timepicker').timepicker({ 
      minuteStep: 60,  
      showMeridian: false,
      defaultTime: '00:00' 
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
</script>
<script>
$(document).ready(function () {
    $('#checkBtn').click(function() {
        checked = $("input[type=checkbox]:checked").length;

        if(checked == 0) {
            alert("Peringatan ! \nMohon checklist Penyebab Dasar \nChecklist Penyebab Langsung (Tindakan Tidak Aman) \nDan checklist Penyebab Langsung (Kondisi Tidak Aman)");
            return false;
        }

         if(checked == 1) {
            alert("Peringatan ! \nMohon checklist Penyebab Dasar \nMohon Isi Penyebab Langsung (Tindakan Tidak Aman) \nDan Isi Penyebab Langsung (Kondisi Tidak Aman)");
            return false;
        }

        if(checked == 2) {
            alert("Peringatan ! \nMohon checklist Penyebab Dasar \nMohon Isi Penyebab Langsung (Tindakan Tidak Aman) \nDan Isi Penyebab Langsung (Kondisi Tidak Aman)");
            return false;
        }
    });
});
</script>

<script type="text/javascript">
  function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
    preview.style.display = "block";
    preview.style.width = "100px";
    preview.hidden = false;
  }
}

function myFunction() {
  var xx = document.getElementById("myDIV");
    xx.style.display = "none";
}
</script> 

<script type="text/javascript">
  function showPreview1(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview1 = document.getElementById("file-ip-1-preview1");
    preview1.src = src;
    preview1.style.display = "block";
    preview1.style.width = "150px";
    preview1.hidden = false;
  }
}

function myFunction1() {
  var x = document.getElementById("myDIV1");
    x.style.display = "none";
  
}
</script>
<script type="text/javascript">
  function showPreview2(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview2 = document.getElementById("file-ip-1-preview2");
    preview2.src = src;
    preview2.style.display = "block";
    preview2.style.width = "150px";
    preview2.hidden = false;
  }
}

function myFunction2() {
  var x = document.getElementById("myDIV2");
    x.style.display = "none";
  
}
</script>
<script type="text/javascript">
  function showPreview3(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview3 = document.getElementById("file-ip-1-preview3");
    preview3.src = src;
    preview3.style.display = "block";
    preview3.style.width = "150px";
    preview3.hidden = false;
  }
}

function myFunction3() {
  var x = document.getElementById("myDIV3");
    x.style.display = "none";
  
}
</script>
<script type="text/javascript">
    function angka(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script> 

<!-- JavaScript -->

{{-- pergantian shift --}}
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {

        $("#dynamicAddRemove").append('<tr><td><input type="text" name="shiftlama[]" placeholder="Shift Lama" class="form-control" required/></td><td><span class="bi bi-trash-fill bg-danger btn-sm align-self-center remove-input-field"></span></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar1").click(function () {

        $("#dynamicAddRemove1").append('<tr><td><input type="text" name="shiftbaru[]" placeholder="Shift Baru" class="form-control"  required/></td><td><button type="button" class="bi bi-trash-fill bg-danger btn-sm align-self-center remove-input-field"></button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
{{-- pergantian shift --}}

{{-- inventaris barang --}}
{{-- <script type="text/javascript">
    var i = 0;
    $("#dynamic-ar2").click(function () {
        ++i;
        $("#dynamicAddRemove2").append('<tr><td><input type="text" name="nabar[]" placeholder="Nama Barang" class="typeahead form-control" required/></td><td><input type="text" name="jumlah[]" placeholder="Jumlah Barang" class="form-control" multiple required/></td><td><input type="text" name="ket[]" placeholder="Keterangan" class="form-control" required/></td><td><button type="button" class="bi bi-trash-fill bg-danger btn-sm align-self-center remove-input-field"></button></td></tr>' 
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script> --}}

{{-- inventaris barang --}}

{{-- kunci ruangan --}}
{{-- <script type="text/javascript">
    var i = 0;
    $("#dynamic-ar3").click(function () {
        ++i;
        $("#dynamicAddRemove3").append('<tr><td><input type="text" name="kunci[]" placeholder="Kunci" class="form-control" /></td><td><input type="text" name="lantai[]" placeholder="Lantai" class="form-control" /></td><td><input type="text" name="jum[]" placeholder="Jumlah Kunci" class="form-control" /></td><td><input type="text" name="kondisi[]" placeholder="Kondisi Kunci" class="form-control" /></td><td><input type="text" name="ket[]" placeholder="Keterangan" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-input-field">Hapus</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script> --}}
{{-- kunci ruangan --}}

{{-- uraian kegiatan --}}
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar4").click(function () {
        ++i;
        $("#dynamicAddRemove4").append('<tr><td width="20%"><input type="text" name="jam[]" placeholder="Jam" class="form-control" required/></td><td><textarea type="text" rows="1" name="uraian[]" placeholder="Uraian Kegiatan/Kejadian" class="form-control" required></textarea></td><td><button type="button" class="bi bi-trash-fill bg-danger btn-sm align-self-center remove-input-field"></button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
{{-- uraian kegiatan --}}

{{-- flash timeout --}}
<script type="text/javascript">
    setTimeout(function(){
     $("#timeout").fadeTo(2000, 300).slideUp(300, function() {
      $("#timeout").slideUp(300);
    });
    }, 500 ); // 5 secs
</script>
{{-- flash timeout --}}
@if ( Auth::user()->level === 'superadmin')
<script>
    var z = document.getElementById("rubah");
    var y = document.getElementById("collapseExamples");
    if (y.className === "collapse show"){
    z.className = "bi bi-caret-down-fill";
    }

    function cekDowns() {
  var x = document.getElementById("rubah");
   if (x.className === "bi bi-caret-right-fill") {
    x.className = "bi bi-caret-down-fill";
  } else {
    x.className = "bi bi-caret-right-fill";
  }
}
</script>
@endif
<script>
    var z = document.getElementById("ubah");
    var y = document.getElementById("collapseExample");
    if (y.className === "collapse show"){
    z.className = "bi bi-caret-down-fill";
    }

    function cekDown() {
  var x = document.getElementById("ubah");
   if (x.className === "bi bi-caret-right-fill") {
    x.className = "bi bi-caret-down-fill";
  } else {
    x.className = "bi bi-caret-right-fill";
  }
}
</script>
<script>
    var d = document.getElementById("changeSmc");
    var a = document.getElementById("smc");
    if (a.className === "collapse show"){
    d.className = "bi bi-caret-down-fill";
    }

    function cekSmc() {
  var g = document.getElementById("changeSmc");
   if (g.className === "bi bi-caret-right-fill") {
    g.className = "bi bi-caret-down-fill";
  } else {
    g.className = "bi bi-caret-right-fill";
  }
}
</script>
<script>
    var d = document.getElementById("changeHSE");
    var a = document.getElementById("hse");
    if (a.className === "collapse show"){
    d.className = "bi bi-caret-down-fill";
    }

    function cekHse() {
  var g = document.getElementById("changeHSE");
   if (g.className === "bi bi-caret-right-fill") {
    g.className = "bi bi-caret-down-fill";
  } else {
    g.className = "bi bi-caret-right-fill";
  }
}
</script>
</html>