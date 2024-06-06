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

        <title>{{ config('app.name', 'SISPAM') }}</title>
        <style type="text/css">
@page { margin: 15px; }
body { 
    margin-left: 20px; 
    margin-right: 20px; 
    margin-top: 25px; 
    margin-bottom: 5px; 
    font-size: 11pt;
}
    table, th, tr, td {
        padding-left: 10px;
        padding-right: 10px;
        font-size: 10.5pt;
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, {
        vertical-align: middle;
        text-align: center;
    }
    .td {
        white-space: nowrap;
    }
pre {
        font-family : system-ui;
    }
.narrow {
          padding: 0px;
          width: 200px;
          margin: 0 auto;
          font-size: 12pt;
          font-family : system-ui;
        }
tr td:last-child {
    height: 1%;
}
    </style>
    </head>
<body>
    <div class="mb-5">
        <img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 20px; margin-left: 20px; width: 150px; position: fixed;">
            @if($cari&&$start)
            <center class="text-uppercase fw-bold mt-3">
                {{ __('Rekap pekerjaan ').$cari }} <br/>
                {{Carbon\Carbon::parse($start)->isoFormat('DD MMMM YYYY').' - '.Carbon\Carbon::parse($end)->isoFormat('DD MMMM YYYY')}}
            </center>
            @elseif($start)
            <center class="text-uppercase fw-bold mt-3"> {{ __('Rekap pekerjaan ').Carbon\Carbon::parse($start)->isoFormat('DD MMMM YYYY').' - '.Carbon\Carbon::parse($end)->isoFormat('DD MMMM YYYY') }} </center>
            @elseif($cari)
            <center class="text-uppercase fw-bold mt-3"> {{ __('Rekap pekerjaan ').$cari }} </center>
            @endif
    </div>
<table style="width: 100%; display: table; table-layout: auto;" border="1">
    <tr>
        <th style="width: 20px;">No.</th>
        <th style="width: 100px;">No. Dokumen</th>
        <th style="width: 65px;">Tanggal<br/>Pengerjaan</th>
        <th style="width: 100px;">Pemohon</th>
        <th>Foto Dokumentasi</th>
        <th style="width: 200px;">Keterangan</th>
    </tr>
@foreach($index as $key => $item)
    <tr>
        <td style="text-align: center;">{{$index->firstitem() + $key}}</td>
        <td>{{$item->izin_id}}</td>
        <td>{{$item->izin_validasi->tgl_pmhn_granted}}</td>
        <td>{{$item->izin_informasi->pemohon}}</td>
        <td style="text-align: center;">
        @if ($item->foto!= null)
        @foreach(explode('|',$item->foto) as $putih)
            @if($loop->count == 1)
                <img src="{{ public_path('storage/izin_kerja')}}/{{$item->izin_id}}/{{$putih}}" style="width:200px; margin-bottom: 5px; margin-top: 5px;">
            @elseif($loop->count == 2)
                <img src="{{ public_path('storage/izin_kerja')}}/{{$item->izin_id}}/{{$putih}}" style="width:200px; margin-bottom: -13px; margin-top: 18px;">
            @endif
        @endforeach
        @else 

        @endif
        </td>
        <td style="text-wrap: pretty; text-align: justify; text-justify: inter-word;">{{$item->ket}}</td>
    </tr>
@endforeach
</table>
</body>
</html>
