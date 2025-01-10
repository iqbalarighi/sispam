@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Detail Laporan Insiden / Kejadian') }}
    @if($detil->user_pelapor == Auth::user()->name || Auth::user()->role == "admin")
        <a href="{{route('kejadian')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
        <a href="{{url('kejadian-edit')}}/{{$detil->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Edit Laporan</span></a>

        @if(Auth::user()->level == 'superadmin')
                <span class="btn btn-sm btn-primary align-self-center float-right mx-2 py-1" onclick="return sup()" style="cursor: pointer; z-index: 0; vertical-align: middle; margin-bottom: -1px; padding: 4px 3px 4px 3px;" onclick>Otorisasi</span>

                <span class="btn btn-sm btn-primary align-self-center float-right mx-2 py-1" onclick="return vali()" style="cursor: pointer; z-index: 0; vertical-align: middle; margin-bottom: -1px; padding: 4px 3px 4px 3px;">Validasi</span>

                <script type="text/javascript">
                async function vali(){

                const { value: val } = await Swal.fire({
                      title: "Validasi",
                      input: "select",
                      inputOptions: {
                        @foreach($validator as $item)
                        {{$item->id}}: "{{$item->name}}",
                        @endforeach
                      },
                      inputPlaceholder: "Validator",
                      cancelButtonText: "Batal",
                      confirmButtonText: "Validasi",
                      showCancelButton: true,
                      inputValidator: (result) => {
                        return !result && "Mohon pilih Validator terlebih dahulu !";
                      }
                    });
                    if (val) {
                      window.location="{{route('kejadian')}}/validasi/{{$detil->no_lap}}/"+val
                    }
                }
            </script>


            <script type="text/javascript">
                async function sup(){

                const { value: oto } = await Swal.fire({
                      title: "Otorisasi",
                      input: "select",
                      inputOptions: {
                        @foreach($otor as $item)
                        {{$item->id}}: "{{$item->nama}}",
                        @endforeach
                      },
                      inputPlaceholder: "Otorisator",
                      cancelButtonText: "Batal",
                      confirmButtonText: "Otorisasi",
                      showCancelButton: true,
                      inputValidator: (result) => {
                        return !result && "Mohon pilih otorisator terlebih dahulu !";
                      }
                    });
                    if (oto) {
                      window.location="{{url('/kejadian/otorisasi/'.$detil->no_lap)}}/"+oto
                    }
                }
            </script>
        @endif

                    @if(Auth::user()->unit_kerja == 'Fasilitas Kerja' || Auth::user()->role == 'admin')
                        @if($otorized == null) 
                            @if($detil->validatedby == null)
                                @if(Auth::user()->level != 'superadmin')
                            <span class="btn btn-sm btn-primary align-self-center float-right mx-2 py-1" onclick="window.location='{{route('kejadian')}}/validasi/{{$detil->no_lap}}'" style="cursor: pointer; z-index: 0; vertical-align: middle; margin-bottom: -1px; padding: 4px 3px 4px 3px;">Validasi</span>
                                @endif
                            @endif
                        @elseif($detil->otorizedby == null) 
                            <span class="btn btn-sm btn-primary align-self-center float-right mx-2 py-1" onclick="return oto()" style="cursor: pointer; z-index: 0; vertical-align: middle; margin-bottom: -1px; padding: 4px 3px 4px 3px;">Otorisasi</span>
                            
                            <script>
                                function oto() {                              
                                    Swal.fire({
                                          title: "Otorisasi Dokumen",
                                          icon: "warning",
                                          showCancelButton: true,
                                          confirmButtonColor: "#3085d6",
                                          cancelButtonColor: "#d33",
                                          confirmButtonText: "Otorisasi",
                                          cancelButtonText: "Batal"
                                        }).then((result) => {
                                          if (result.isConfirmed) {
                                            window.location="{{url('/kejadian/otorisasi/'.$detil->no_lap.'/'.$otorized->id)}}"
                                          }
                                        });
                                    }
                            </script>

                        @endif
                    @endif
    @else 
        <a href="{{ url()->previous() }}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
    @endif
                </div>

                <div class="card-body overflow " style="overflow-x: auto;">
        @if ($message = Session::get('berhasil'))
        <script type="text/javascript">

            Swal.fire({
              icon: "success",
              title: "{{ $message }}",
              showConfirmButton: false,
              timer: 1500
            });

        </script>
        @endif

        @if ($message = Session::get('warning'))
        <div id="timeout" align="center" class="alert alert-warning alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between mx-1" style="width: 80%; margin: 0 auto;" role="alert">
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
        @endif

    @if (session('abort'))
<script type="text/javascript">
    Swal.fire({
  icon: "error",
  title: "Oops...",
  allowOutsideClick: false,
  text: "{{session('abort')}}",
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    window.open('', '_self', ''); window.close();
  }
});
</script>
@endif
                    <style>
                        pre {
                            font-family : system-ui;
                            font-size: 12pt;
                            word-break: break-word;
                            white-space: pre-wrap;       /* Since CSS 2.1 */
                            white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
                            white-space: -pre-wrap;      /* Opera 4-6 */
                            white-space: -o-pre-wrap;    /* Opera 7 */
                            word-wrap: break-word;       /* Internet Explorer 5.5+ */
                        }
                        .xx {
                            font-size: 10pt;
                            text-align: center;
                        }
                        table tr td {
                        /*  padding:0rem !important;*/
                            vertical-align: middle;
                            white-space:nowrap;
                        }
                        .table th {
                            padding:0rem;
                            white-space:nowrap;
                            background-color: seashell;
                        }
                        label {
                            margin: 0em;
                        }

                    </style>

                    <div class="table-responsive">
                        <div class="pb-3">
                            <b><center>Laporan Kejadian/Insiden</center></b>
                            <b><center>{{$detil->site->nama_gd}}</center></b>
                            <b><center>{{Carbon\Carbon::parse($detil->created_at)->isoFormat('dddd, D MMMM Y')}} {{Carbon\Carbon::parse($detil->created_at)->isoFormat('HH:mm:ss')}} WIB</center></b>
                        </div>
                    <center>
                    <table class="" width="85%">
                    <tr>
                        <td>No Laporan Kejadian</td><td> : </td><td>&nbsp;{{$detil->no_lap}}</td>
                    </tr>
                    @if ('Lain-lain :' == Str::substr($detil->jenis_kejadian, 0,11))
                    <tr>
                        <td>Jenis Kejadian</td><td>:</td><td>&nbsp;{{Str::substr($detil->jenis_kejadian, 12,1000)}}</td>
                    </tr>
                    @else
                    <tr>
                        <td>Jenis Kejadian </td><td> :  </td><td>&nbsp;{{$detil->jenis_kejadian}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td>Lokasi Kejadian</td><td> : </td><td>&nbsp;{{$detil->site->nama_gd}}</td>
                    </tr>
                    <tr>
                        <td>Waktu Kejadian</td><td> : </td><td>&nbsp;{{Carbon\Carbon::parse($detil->waktu_kejadian)->isoFormat('dddd, D MMMM Y')}}</td>
                    </tr>
                    <tr>
                        <td>Jam kejadian</td><td> : </td><td>&nbsp;{{$detil->jam_kejadian}} WIB</td>
                    </tr>
                    <tr>
                        <td class="p-2"></td> 
                    </tr>
                    @if ('Lain-lain :' == Str::substr($detil->jenis_potensi, 0,11))
                    <tr>
                        <td>Jenis Potensi</td><td> : </td><td>&nbsp;{{Str::substr($detil->jenis_potensi, 12,1000)}}</td>
                    </tr>
                    @else
                    <tr>
                        <td>Jenis Potensi</td><td> : </td><td>&nbsp;{{$detil->jenis_potensi}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td>Penyebab</td><td> : </td><td>&nbsp;{{$detil->penyebab}}</td>
                    </tr>
                    <tr>
                        <td>Saksi Mata</td><td> : </td><td>&nbsp;{{$detil->saksi_mata}}</td>
                    </tr>
                    <tr>
                        <td>Korban</td><td> : </td><td>&nbsp;{{$detil->korban}}</td>
                    </tr>
                    <tr>
                        <td>Kerugian</td><td> : </td><td>&nbsp;{{$detil->kerugian}}</td>
                    </tr>
                    <tr>
                        <td class="p-2"></td> 
                    </tr>
                    <tr>
                        <td>Penyebab Dasar</td><td> : </td>
                        <td>@foreach (explode('|', $detil->sebab_dasar) as  $key => $item) 
                            @if ('Lain-lain :' == Str::substr($item, 0,11))
                            &nbsp;{{$key+1}}.{{Str::substr($item, 11,1000)}}
                            @else
                            &nbsp;{{$key+1}}. {{$item}}<br>
                            @endif
                            @endforeach
                    </td>
                    </tr>
                    <tr>
                        <td>Penyebab Langsung <br/>(Tindakan Tidak Aman)</td><td> : </td>
                        <td>@foreach (explode('|', $detil->sebab_tindakan) as  $key => $item) 
                            @if ('Lain-lain :' == Str::substr($item, 0,11))
                            &nbsp;{{$key+1}}.{{Str::substr($item, 11,1000)}}
                            @else
                            &nbsp;{{$key+1}}. {{$item}}<br>
                            @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Penyebab Langsung <br/>(Kondisi Tidak Aman)</td>
                        <td> :  </td>
                        <td>@foreach (explode('|', $detil->sebab_kondisi) as $key => $item) 
                            @if ('Lain-lain :' == Str::substr($item, 0,11))
                            &nbsp;{{$key+1}}.{{Str::substr($item, 11,1000)}}
                            @else
                            &nbsp;{{$key+1}}. {{$item}}<br>
                            @endif
                        @endforeach</td>
                    </tr>
                    <tr>
                        <td class="p-2"></td> 
                    </tr>
                    <tr>
                        <td>Uraian Singkat</td><td> : </td><td ><pre class="mb-0">&nbsp;{{$detil->uraian_singkat}}</pre></td>
                    </tr>
                    <tr>
                        <td>Perlu Tindakan Perbaikan</td><td> : </td><td>&nbsp;{{$detil->tindak_perbaikan}}</td>
                    </tr>
                    <tr>
                        <td>Rencana Perbaikan</td><td> : </td><td>&nbsp;{{$detil->rencana_perbaikan}}</td>
                    </tr>
                    <tr>
                        <td>Komentar Management <br/>Representative</td><td> :  </td><td>&nbsp;{{$detil->kom_mng_rep}}</td>
                    </tr>
                    <tr>
                        <td class="p-2"></td> 
                    </tr>
                    <tr>
                        <td>Nama Pelapor</td><td> : </td><td>&nbsp;{{$detil->nama_pelapor}}</td>
                    </tr>
                    <tr>
                        <td>Unit Kerja Pelapor</td><td> : </td><td>&nbsp;{{$detil->uker_pelapor}}</td>
                    </tr>
                    <tr>
                        <td colspan="3">Dokumentasi : <br/> 
                         <div>
                    @if ($detil->dokumentasi != null)
                    @foreach(explode('|',$detil->dokumentasi) as $item)
                    <img align="center" src="{{asset('storage/kejadian')}}/{{$detil->no_lap}}/{{$item}}" style="width:280px; margin-bottom: 5pt">&nbsp;
                    @endforeach
                        </div>
                        @else 
                        <b>Harap Upload Foto Dokumentasi</b>
                        @endif
                    </td>
                    </tr>
                    </table>
                </center>
                    </div>

                </div>

                <div>
                @if($detil->otorizedby != null && $detil->validatedby != null)
                    <div align="center" class="mt-4">
                        <a target="_blank" href="{{url('kejadianPDF')}}/{{$detil->id}}/{{$detil->otorizedby}}/{{$detil->validatedby}}"><button class="btn btn-primary btn-sm float-center ml-2">Download PDF</button></a>
                    </div>
                @endif

                @if($detil->validatedby != null && $detil->otorizedby == null)

                @if($otorized == true)
                    <div align="center" class="my-3">
                       <span class="bg-success text-white rounded fw-bold py-1 px-2">Dokumen telah di Validasi</span>
                    </div>
                @else
                    <div align="center" class="mb-2">
                       <a target="_blank" href="https://wa.me/62811163361?text=Assalamualaikum%20Pak%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20pada%20dokumen%20laporan%20kejadian%20dengan%20nomor%20{{$detil->no_lap}}.%20Terima%20Kasih.%0A%0Ahttps%3A%2F%2Fwww.sispam.id%2Fkejadian-detil%2F{{$detil->no_lap}}"><span class="bg-success text-white rounded fw-bold py-1 px-2">Nanang Arianto</span></a>
                       <a target="_blank" href="https://wa.me/628128051226?text=Assalamualaikum%20Pak%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20pada%20dokumen%20laporan%20kejadian%20dengan%20nomor%20{{$detil->no_lap}}.%20Terima%20Kasih.%0A%0Ahttps%3A%2F%2Fwww.sispam.id%2Fkejadian-detil%2F{{$detil->no_lap}}"><span class="bg-success text-white rounded fw-bold py-1 px-2">Tomi Hartono</span></a>
                       {{-- <a target="_blank" href="https://wa.me/6281253005354?text=Assalamualaikum%20Pak%2C%20mohon%20izin%20untuk%20memberikan%20persetujuan%20pada%20dokumen%20laporan%20kejadian%20dengan%20nomor%20{{$detil->izin_id}}.%20Terima%20Kasih.%0A%0Ahttps%3A%2F%2Fwww.sispam.id%2Fkejadian-detil%2F{{$detil->id}}"><span class="bg-success text-white rounded fw-bold py-1 px-2">Budi Murtopo</span></a> --}}
                    </div>
                @endif
                @endif

                @if($detil->otorizedby == null && $detil->validatedby == null)
                    <div align="center" class="my-2">
                        <span class="bg-danger text-white rounded fw-bold py-1 px-2">Dokumen belum di Otorisasi dan di Validasi</span>
                    </div>
                @endif
                </div>

{{--                 @if($detil->user_pelapor == Auth::user()->name || Auth::user()->role == "admin")

                <div align="center">
          

                    <select id="otorisasi"  required>
                        <option value="" selected>:: Pilih Otorisasi ::</option>
                        @foreach ($otor as $key => $oto)
                        <option value="{{$oto->id}}">{{$oto->nama}}</option>
                        @endforeach
                    </select>

                <a id="link" target="_blank"><button id="unduh" class="btn btn-primary btn-sm float-center ml-2" disabled>Download PDF</button></a>

                
                </div>
                @endif --}}
            </div>
        </div>
    </div>
</div>
{{-- <script>
 
    $("#otorisasi").change(function() {
        console.log($("#otorisasi option:selected").val());
        if ($("#otorisasi option:selected").val() == '') {
            $("#unduh").prop("disabled", true);
            $('#link').removeAttr("href");
        } else {
            $('#link').attr("href", "/kejadianPDF/{{$detil->id}}/"+this.value);
            $("#unduh").prop("disabled", false); 
        }

});
</script> --}}
@endsection
