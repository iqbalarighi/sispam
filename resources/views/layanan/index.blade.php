@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<style type="text/css">
    td {
        vertical-align: middle !important;
    }
</style>
                    

        <div class="card-body overflow pt-0 pb-0" style="overflow-x: auto;">
            <table class="table table-striped table-hover text-center ">
            <tr class="font-weight-normal xx ">
                <th class="align-middle" style="max-width:50px; min-width:30px;">No</th>
                <th class="align-middle">ID Layanan</th>
                <th class="align-middle">Waktu</th>
                <th class="align-middle">Detail Kebutuhan</th>
                <th class="align-middle">Nama PIC</th>
                <th class="align-middle">Kontak</th>
                <th class="align-middle">Email</th>
                <th class="align-middle">Status</th>
                @if (Auth::user()->role === 'admin')
               <th class="align-middle" style="width:72px; ">Option</th>
               @endif
            </tr>
            @foreach($layan as $key => $layanan)
            <tr>
                <td>{{$layan->firstitem()+$key}}</td>
                <td>{{$layanan->layanan_id}}</td>
                <td>{{$layanan->tanggal}}</td>
                <td>{{$layanan->detail_kebutuhan}}</td>
                <td>{{$layanan->pic}}</td>
                <td>{{$layanan->kontak}}</td>
                <td>{{$layanan->email}}</td>
                <td>{{$layanan->status}}</td>
            </tr>
            @endforeach
            </table>
        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection