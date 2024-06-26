@extends('layouts.app')

@section('content')

@if(Auth::user())
 <meta content="0; url={{ route('dashboard') }}" http-equiv="refresh">
@endif
        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            
                            <script>
                                Swal.fire({
                                        title: "Oops . . .",
                                        text:  "{{$error}}",
                                        icon: "error",
                                        showConfirmButton: true,
                                    });
                            </script>
                        @endforeach
        @endif

<style>
    #target {
    transition: opacity 0.3s;
}
</style>

<div class="container">
    <div class="row justify-content-center" id="target">
        <div class="col-md-8">
            <div class="card"  >
                <!-- {{ __('Login') }} -->
                <div class="card-header "><img width="100%" src="{{asset('storage/img/satpam.jpg')}}" alt="" class="rounded mx-auto d-block" > </div>

                <div class="card-body ">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                {{-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }} </strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>
                        <p></p>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                {{-- @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>
                        <p></p>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <!-- <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> -->
                                        <input class="form-check-input" type="checkbox" id="lihat" onclick="cekPass();"> 
                                    <label class="form-check-label" for="lihat">
                                       {{ __('Lihat Password') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="form-group row" align="center">
                            <div class="col-md-auto mx-auto">
                                <button type="submit" onclick="load()" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                {{--  @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif  --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
    function load() {

    if (document.getElementById('email').value == ""){
        document.getElementById('email').focus();
    } else if (document.getElementById("password").value == ""){
        document.getElementById("password").focus();
    } else {
        const target = document.getElementById("target");
        Swal.fire({
            title: "Loading . . . ",
            text: "Sedang validasi data",
            showConfirmButton: false, 
            allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                target.style.opacity = '0'
            }
            });  
    }
}
</script>
@endsection
