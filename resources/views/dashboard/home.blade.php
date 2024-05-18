@extends('layouts.side')

@section('content')
{{-- @if ( Auth::user()->role === 'admin') --}}
@if(Auth::user()->unit_kerja == 'Teknisi')
 <script type="text/javascript">
     window.location.href = '{{route('izin_kerja')}}';
 </script>
@endif
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Dashboard') }}
                </div>

        @if ($message = Session::get('berhasil'))
                        <script>
                    Swal.fire({
                      title: "Login Sukses",
                      // imageUrl: "{{asset('storage/img/puasa.png')}}",
                      imageWidth: 400,
                      allowOutsideClick: false,
                      html: `{{$message}} <br> 
                            <b>{{Auth::user()->name}}</b>`,
                      // icon: "success",
                            
                    }).then((result) => {
                          /* Read more about isConfirmed, isDenied below */
                          if ("{{Auth::user()->level}}" === "danru") {
                              Swal.fire({
                              icon: "warning",
                              html: `
                                    Petugas dihimbau untuk membuat laporan <strong>sebelum</strong> atau <strong>paling lambat</strong> pukul 7 pagi dan pukul 7 malam sesuai shift.<br>
                                    <br>
                                    Laporan yang masuk akan dirangkum dan diserahkan kepada KABAG Pengamanan setiap 12 jam.<br>
                                    <br>
                                    - Terima Kasih -
                                    <br>
                                    <br>
                                  `,
                              showConfirmButton: false,
                              allowOutsideClick: false,
                              timer: 10000,
                              timerProgressBar: true,
                              didOpen: () => {
                                    Swal.showLoading();
                                    const timer = Swal.getPopup().querySelector("b");
                                    timerInterval = setInterval(() => {
                                      // timer.textContent = `${Swal.getTimerLeft()/1000}`;
                                    }, 100);
                                  },
                                  willClose: () => {
                                    clearInterval(timerInterval);
                                  }
                            });  
                            }
                        });

            </script>
        @endif

        @if ($message = Session::get('forbidden'))
            <script type="text/javascript">
                Swal.fire({
                      icon: "error",
                      title: "Oops... ",
                      text: "{{$message}}",
                      
                    });
            </script>
        @endif

                    <style>
                        tr, td {
                            padding-left: 0.1rem;
                            padding-right: 0.1rem;
                        }
                        .xx {
                            font-size: 10pt;
                            text-align: center;
                        }
                        .table tr td {
                            padding:0.3rem;
                            vertical-align: middle;
                            max-width:100%;
                            white-space: normal;

                        }
                        .table th {
                            padding:0.3rem;
                            white-space: normal;
                        }
                        th {
                            padding:0.3rem !important;
                        }
                        label {
                            margin: 0em;
                        }
                        a {
                           color: black;
                           text-decoration: ;
                        }
                        a:hover {
                            text-decoration: none;
                            color: black;
                        }

                        /*table, tr, td{
                            border: 1px black solid;
                        }*/
                    </style>

    <livewire:grafik-unras></livewire:grafik-unras>
<div class="card-body overflow px-3 pt-1" style="overflow-x: auto;">

<div class="row">

<div class="col col-sm-7 px-1">
    <div class="mt-2 ">
    <div class="card" style="background-color:rgba(241, 214, 147, 0.5);">
      <div class="card-body">
        <h5 class="card-title">Grafik UNRAS</h5>
        {{-- <p class="card-text">Data Grafik UNRAS</p> --}}
            <div id="charBox">
                <canvas  id="myChart"></canvas>
            </div>
      </div>
    </div>
  </div>  
</div>


<div class="col col-sm-5 px-1">

    <div class="mt-2">
    <div class="card" style="background-color:rgba(0, 230, 64, 0.5);">
      <div class="card-body overflow py-2 px-3" style="overflow-x: auto;">
        <h5 class="card-title">Data Izin Pekerjaan</h5>
        <div class="row ">
                @livewire('pekerjaan')
        </div>
      </div>
    </div>
  </div>


  <div class="mt-2">
    <div class="card" style="background-color:rgba(255, 240, 0, 0.5);">
        <div class="card-body overflow py-2 px-3" style="overflow-x: auto;">
        <h5 class="card-title">Data Laporan Kejadian</h5>
            <div class="row">
                @livewire('kejadian')
            </div>
        </div>
    </div>
  </div>

 <div class="mt-2">
    <div class="card" style="background-color:rgba(207, 0, 15, 0.5);">
        <div class="card-body overflow py-2 px-3" style="overflow-x: auto;">
        <h5 class="card-title">Data Laporan Kegawatdaruratan</h5>
            <div class="row">
                @livewire('gawatdarurat')
            </div>
      </div>
    </div>
  </div>

</div>

  
{{--   <div class="col-sm-6 mt-2">
    <div class="card" style="background-color:rgba(153, 255, 255, 0.5);">
      <div class="card-body">
        <h5 class="card-title">Data Terakhir Laporan Serah Terima Jaga</h5>
            <div class="row">
                <table class="col">
                    <tr>
                        <th>Dibuat Oleh</th>
                    </tr>
                    <tr id="data-jaga"></tr>
                </table>
                <table class="col">
                    <tr>
                        <th>Terakhir Di Buat</th>
                    </tr>
                    <tr id="data-timej"></tr>
                </table>
            </div>
      </div>
    </div>
  </div> --}}

</div>


                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        // Set the interval to 3600000 milliseconds (1 hour)
        setInterval(function() {
            // window.location.reload();
            location.href = location.href.split('?')[0] + '?' + new Date().getTime();
        }, 3600000); // 3600000ms = 1 hour
    </script>
@endsection
