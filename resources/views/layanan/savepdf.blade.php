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
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </head>
                <body>
            <div class="mb-5">
                    <img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 0px; width: 150px; position: fixed;">
                        <center class="text-uppercase mt-3 xxxx"> <b>{{ __('FORM LAYANAN KELOGISTIKAN ') }}</b></center>
             </div>

             <div class="pl-4 xxxx">
             <div class="mt-2">
                <b>Nomor Layanan </b>: {{$show->layanan_id}}
             </div>
            <div class="mt-2">
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
            <div class="mt-2">
                <b>Lokasi</b>
                <div>
                    {{$show->lokasi}}
                </div>
                <div>
                    {{$show->lantai}}
                </div>
            </div>
                <div class="mt-2">
                     <b>Uraian</b>
                    <table width="75%" class="ml-3">
                        <tr>
                            <td style="width: 130px;">Tanggal</td>
                            <td style="width: 10px;">:</td>
                            <td>{{Carbon\Carbon::parse($show->tanggal)->isoFormat('DD MMMM YYYY')}}
                        Pukul {{Carbon\Carbon::parse($show->tanggal)->isoFormat('HH:mm:ss')}}</td>
                        </tr>
                        <tr>
                            <td style="width: 130px;">Nama Pemohon</td>
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
                <div class="mt-2">
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


            </div>
                
                <div class="px-0 mt-3" style="page-break-before: auto; page-break-inside:avoid;">
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
<style type="text/css">
    .div2 {
  width: 450px;
  height: auto;  
  padding: 5px;
  border: 1px solid black;
  font-size: 11pt;
}
.note {
    width: auto;
  height: auto;  
  border: 1px solid black;
  font-size: 11pt;
}
</style>
<div class="note mt-4 px-1">
   <b>Catatan  {{$otor->jabatan}}:</b> <br>
    {{$show->note}}
</div>

<div class="row" style="page-break-before: always;">
    <div class="mt-2">
                <b>Nomor Layanan </b>: {{$show->layanan_id}}
             </div>
    <center><font class="fw-bold">Kuesioner</font></center>
    <div class="div2 col mt-1" style="display:inline-block; vertical-align: top;">
        <div class="">
            <center>
            <div class="fw-bold">Waktu Respon</div>
            
            <div>
                <table style="text-align: center;" width="100%">
                    <tr>
                        <td width="10px"><label for="1">Tidak Puas</label></td>
                        <td width="10px"><label for="2">Kurang Puas</label></td>
                        <td width="10px"><label for="3">Puas </label></td>
                        <td width="10px"><label for="4">Cukup Puas</label></td>
                        <td width="10px"><label for="5">Sangat Puas</label></td>
                    </tr>
                    <tr>
                        <td class="px-1"><input type="radio" name="cepat" id="1" value="Tidak Puas" title="Tidak Puas" required></td>
                        <td class="px-1"><input type="radio" name="cepat" id="2" value="Kurang Puas" title="Kurang Puas" required></td>
                        <td class="px-1"><input type="radio" name="cepat" id="3" value="Puas" title="Puas" required></td>
                        <td class="px-1"><input type="radio" name="cepat" id="4" value="Cukup Puas" title="Cukup Puas" required></td>
                        <td class="px-1"><input type="radio" name="cepat" id="5" value="Sangat Puas" title="Sangat Puas" required></td>
                    </tr>
                </table>
            </div>
            </center>
        </div>
        <div class="mt-2">
            <center>
            <div class="fw-bold">Hasil Pekerjaan</div>
            <div>
                <table style="text-align: center;" width="100%">
                    <tr>
                        <td width="10px"><label for="a">Tidak Puas</label></td>
                        <td width="10px"><label for="b">Kurang Puas</label></td>
                        <td width="10px"><label for="c">Puas </label></td>
                        <td width="10px"><label for="d">Cukup Puas</label></td>
                        <td width="10px"><label for="e">Sangat Puas</label></td>
                    </tr>
                    <tr>
                        <td class="px-1"><input type="radio" name="perilaku" id="a" value="Tidak Puas" title="Tidak Puas" required></td>
                        <td class="px-1"><input type="radio" name="perilaku" id="b" value="Kurang Puas" title="Kurang Puas" required></td>
                        <td class="px-1"><input type="radio" name="perilaku" id="c" value="Puas" title="Puas" required></td>
                        <td class="px-1"><input type="radio" name="perilaku" id="d" value="Cukup Puas" title="Cukup Puas" required></td>
                        <td class="px-1"><input type="radio" name="perilaku" id="e" value="Sangat Puas" title="Sangat Puas" required></td>
                    </tr>
                </table>
            </div>
            </center>
        </div>
    </div>
    <div class="col text-center float-end" style="width:auto; display:inline-block; vertical-align: bottom; ">
        <div class="ml-5" style="text-align: right;">
        
        ...........................<br>
        NIP. ..................
        <br>
        <br>
    </div>
    </div>
</div>


                    @if($show->foto != null) 
                    <div class="mt-2" style="page-break-before: always;">
                        <div class="mt-2">
                <b>Nomor Layanan </b>: {{$show->layanan_id}}
             </div>
                        <div class="mb-2">
                        <b>Dokumen Pendukung</b> 
                        </div>
                        @foreach(explode('|', $show->foto) as $foto)
                        <img src="{{public_path('storage/layanan/'.$show->layanan_id.'/'.$foto)}}" width="200px">
                        @endforeach
                    </div>
                    @endif


            </body>
    </html>