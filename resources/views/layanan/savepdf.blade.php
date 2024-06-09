 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'SISPAM') }}</title>
                            <style>
                        pre {
                            font-family : system-ui;
                        }
                        .potong {
                            white-space: pre-line;       /* Internet Explorer 5.5+ */
                        }
                    .narrow {
                              padding: 0px;
                              width: 200px;
                              margin: 0 auto;
                              font-size: 12pt;
                              font-family : system-ui;
                            }
                    .xxxx {
                        font-size: 12pt;
                        font-family : system-ui;
                    }
                    </style>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.x/dist/alpine.min.js" defer></script>
        {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </head>
                <body>
            <div class="mb-5">
                    <img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 0px; width: 150px; position: fixed;">
                        <center class="text-uppercase mt-3 xxxx"> <b>{{ __('FORM LAYANAN KELOGISTIKAN ') }}</b></center>
             </div>

             <div class="pl-4 xxxx">
             <div class="mt-3">
                <b>Nomor Layanan </b>: {{$show->layanan_id}}
             </div>
            <div class="mt-3">
                <b>Jenis Layanan</b>
                <div class="ml-1">
                    @foreach(explode(',',$show->layanan) as $item)
                        @if ('Lain-lain' == Str::substr($item, 0,9))
                        <li class="ml-4">{{Str::substr($item, 12,1000)}}</li>
                        @else
                            <li class="ml-4">{{$item}}</li>
                        @endif
                    @endforeach
                </div>
            </div>
                <div class="mt-3">
                     <b>Uraian</b>
                    <table width="75%" class="ml-3">
                        <tr>
                            <td style="width: 130px;">Tanggal</td>
                            <td style="width: 10px;">:</td>
                            <td>{{Carbon\Carbon::parse($show->tanggal)->isoFormat('DD MMMM YYYY')}}
                        Pukul {{Carbon\Carbon::parse($show->tanggal)->isoFormat('HH:mm:ss')}}</td>
                        </tr>
                        <tr>
                            <td style="width: 130px;">Nama PIC</td>
                            <td style="width: 10px;">:</td>
                            <td>{{$show->pic}}</td>
                        </tr>
                        <tr>
                            <td style="width: 130px;">Satker</td>
                            <td style="width: 10px;">:</td>
                            <td>{{$show->satker}}</td>
                        </tr>
                        <tr>
                            <td style="width: 130px;">Detail Kebutuhan</td>
                            <td style="width: 10px;">:</td>
                            <td>{{$show->detail_kebutuhan}}</td>
                        </tr>
                        <tr>
                            <td style="width: 130px;">No Handphone</td>
                            <td style="width: 10px;">:</td>
                            <td>{{$show->kontak}}</td>
                        </tr>
                        <tr>
                            <td style="width: 130px;">Email</td>
                            <td style="width: 10px;">:</td>
                            <td>{{$show->email}}</td>
                        </tr>
                    </table>
                </div>
                <div class="mt-3">
                    <table class="">
                    <tr>
                            <td style="width: 146px;"><b>Status</b></td>
                            <td style="width: 10px;">:</td>
                            <td>
                                @if($show->status == "Cancelled" || $show->status == "Cancelled by user")
                                    Permohonan Ditolak
                                @else 
                                    Permohonan Diproses
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                    @if($show->foto != null) 
                    <div class="mt-3">
                        <div>
                        <b>Dokumentasi</b> 
                        </div>
                        @foreach(explode('|', $show->foto) as $foto)
                        <img src="{{public_path('storage/layanan/'.$show->layanan_id.'/'.$foto)}}" width="200px">
                        @endforeach
                    </div>
                    @endif
            </div>
                
                <div class="px-0 mt-4" style="page-break-before: auto; page-break-inside:avoid;">
                    <table width="98%" border="0" style="vertical-align: middle; text-align: center;">
                        <tr>
                            <td width="30%"><pre class="narrow">
Mengetahui,
{{$otor->jabatan}}

<img src="data:image/png;base64, {!! $qrcode !!}" >
<b>{{$otor->nama}}</b>
<font style="font-size: 10pt;">NIP. {{$otor->nip}} </font></pre>
                        </td>
<td width="33%" style="vertical-align: top;" class="xxxx">Jakarta, {{Carbon\Carbon::parse($show->created_at)->isoFormat('D MMMM Y')}}</td>
                        <td width="33%" style="vertical-align: top;"><pre class="narrow">
Divalidasi Oleh,


<img src="data:image/png;base64, {!! $qrcode2 !!}" >
<b>{{Auth::user()->name}}</b>
<font style="font-size: 10pt;"><i>{{Auth::user()->unit_kerja}}</i></font></pre>
                        </td>
                        </tr>
                    </table>
</div>
            </body>
    </html>