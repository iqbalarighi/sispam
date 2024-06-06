<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SISPAM') }}</title>
<!-- Scripts -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css"> --}}
    <!-- Styles -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>


<script src='{{asset("/storage/alpine.min.js")}}'></script>
<script src="{{asset("/storage/bootstrap3-typeahead.js")}}"></script>
<script src="{{asset("/storage/sweetalert2@11.js")}}"></script>
<link rel="stylesheet" type="text/css" href='{{asset("/storage/select2.min.css")}}'>
<script src="{{asset("/storage/select2.min.js")}}"></script>
<script src="{{asset("/storage/bootstrap.bundle.min.js")}}"></script>
<link rel="stylesheet" type="text/css" href='{{asset("/storage/bootstrap.min.css")}}'>

@vite(['resources/sass/app.scss'])


{{-- select2 --}}
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

{{-- typeahead --}} 
<script src={{asset("/storage/bootstrap3-typeahead.js")}}></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                {{ __('SISPAM') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"  data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto ">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('login') || Request::is('/') ? 'active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                    <li>
                            <div class="dropdown ">
                              <a class="nav-link dropdown-toggle {{ Request::is('form-izin') || Request::is('form-layanan') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Form Permintaan
                              </a>

                              <ul class="dropdown-menu py-1 m-0">
                                <li class="ps-3"><a class="nav-link p-1 {{ Request::is('form-izin') ? 'fw-bold' : '' }}" href="{{ url('form-izin') }}" style="color: black;">{{ __('Izin Kerja') }}</a></li>
                                <li class="ps-3"><a class="nav-link p-1 {{ Request::is('form-layanan') ? 'fw-bold' : '' }}" href="{{ url('form-layanan') }}" style="color: black;">{{ __('Layanan Kelogistikan') }}</a></li>
                                </ul>
                            </div>
                    </li>
                    <li>
                            <div class="dropdown ">
                              <a class="nav-link dropdown-toggle {{ Request::is('update_pekerjaan') || Request::is('layanan/status') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Update Status
                              </a>

                              <ul class="dropdown-menu py-1 m-0">
                                <li class="ps-3"><a class="nav-link p-1 {{ Request::is('update_pekerjaan') ? 'fw-bold' : '' }}" href="{{ url('update_pekerjaan') }}" style="color: black;">{{ __('Izin Kerja') }}</a></li>
                                <li class="ps-3"><a class="nav-link p-1 {{ Request::is('layanan/status') ? 'fw-bold' : '' }}" href="{{ url('layanan/status') }}" style="color: black;">{{ __('Layanan Kelogistikan') }}</a></li>
                                </ul>
                            </div>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-1">
            @yield('content')
        </main>

    </div>
    <footer class="mt-auto">
      <center>Copyright &copy; {{Carbon\Carbon::today()->isoFormat('Y');}} www.sispam.id. All Rights Reserved </center>  
</footer>

</body>    
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

</html>
