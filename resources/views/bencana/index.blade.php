@extends('layouts.side')

@section('content')
@if (Auth::user()->role === 'user')
    <meta content="0; url={{ route('kegiatan') }}" http-equiv="refresh">
@endif
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
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
            <p/>
        @endif
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Laporan Bencana') }}
                    <a href="{{route('tambah-bencana')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
                </div>
                <div class="card-body p-1 overflow" >
{{-- Content disini --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
