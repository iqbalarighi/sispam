@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header fw-bold text-uppercase">{{ __('Detail Layanan Kelogistikan') }}
                    <a href="{{ route('layanan') }}"><span class="btn btn-primary float-right btn-sm mx-2 py-1">Kembali</span></a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="col-md-6 justify-content-center" style="left: 15%;">
                    <div>
                        <b>Jenis Layanan</b>
                        <div>
                        @if ('Lain-lain' == Str::substr($show->layanan, 0,9))
                        {{Str::substr($show->layanan, 12,1000)}} 
                        @else
                            {{$show->layanan}} 
                        @endif
                    </div>
                    </div>
                    <div class="mt-2">
                        <b>Uraian</b>
                        <div>
                        Nama PIC : {{$show->pic}}
                        </div>
                        <div>
                        Detail Kebutuhan : {{$show->detail_kebutuhan}}
                        </div>
                        <div>
                        No Handphone : {{$show->kontak}}
                        </div>
                        <div>
                        Email : {{$show->email}}
                        </div>
                    </div>
                </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
