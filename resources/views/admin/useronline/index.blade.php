@extends('layouts.side')

@section('content')
@if(Auth::user()->level != 'superadmin')
{{abort(401)}}
@endif

<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header fw-bold text-uppercase">{{ __('User Online Activity') }}</div>

                @livewire('useronline')
                
            </div>
        </div>
    </div>
</div>
@endsection