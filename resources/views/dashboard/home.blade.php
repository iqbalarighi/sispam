@extends('layouts.side')

@section('content')
{{-- @if ( Auth::user()->role === 'admin') --}}
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
                      html: `{{$message}} <br> 
                            <b>{{Auth::user()->name}}</b>`,
                      icon: "success",

                    });

            </script>
        @elseif ($message = Session::get('warning'))
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
@push('js')
<script>
    function updateGiat() {
        $.ajax({
            url: '{{ route('dashboard') }}',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Update the view with the new data
                var dataContainer = $('#data-giat');
                dataContainer.empty(); // Clear existing data (if any)

if (data.datas.giats.length == 0){
        dataContainer.append('<tr> <td colspan="2" align="center">  Tidak ada laporan </td></tr>');
    } else {
                // Append the updated data to the container

                data.datas.giats.forEach(function (item) {
                    var urel = "/giat-detil/";
                    urls = urel.replace(/\/?(\?|#|$)/, '/$1');
                   dataContainer.append('<tr><td><a href="'+urel + item.id +'">' + item.danru + '</a></td><td>' + item.time + '</td></tr>'); // Replace 'name' with the property you want to display


                              });

            }
        },
            error: function (xhr, status, error) {
                console.error('Ajax request error:', error);
            }
        });
    }

    // Call the function initially to load the data
    updateGiat();

    // function updateTime() {
    // $.ajax({
    //         url: '{{ route('grafik') }}',
    //         method: 'GET',
    //         dataType: 'json',
    //         success: function (data) {
    //             // Update the view with the new data
    //             var dataContainer = $('#data-time');
    //             dataContainer.empty(); // Clear existing data (if any)

    //             data.datas.time.forEach(function (tes) {
    //                dataContainer.append('<tr><td>' + tes + '</td></tr>'); // Replace 'name' with the property you want to display
    //             });
    //         },
    //         error: function (xhr, status, error) {
    //             console.error('Ajax request error:', error);
    //         }
    //     });
    // }

    // // Call the function initially to load the data
    // updateTime();

    function updateJadi() {
        $.ajax({
            url: '{{ route('dashboard') }}',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Update the view with the new data
                var dataContainer = $('#data-jadi');
                dataContainer.empty(); // Clear existing data (if any)

if (data.datax.jadi.length == 0){
        dataContainer.append('<tr> <td colspan="5" align="center"> Tidak ada laporan </td></tr>');
    } else {
                // Append the updated data to the container
                const nolap = data.datax.jadi;
            // 
                nolap.forEach(function (item) {
                    var urel = "/kejadian-detil/" + item.no_lap;
                    urls = urel.replace(/\/?(\?|#|$)/, '/$1');

            if (item.jenis_potensi.includes('Lain-lain')){
                    if (item.status == 'Open'){
                        dataContainer.append('<tr> <td><a href="'+ urel +'">' + item.user_pelapor +'</a></td><td>' + item.jenis_potensi.slice(12, 1000) +'</td><td>' + item.waktu_kejadian +'</td><td>' + item.updated_at +'</td><td><span style="color: red;"><b>' + item.status +'</b></span></td></tr>');
                    } else {
                        dataContainer.append('<tr> <td><a href="'+ urel +'">' + item.user_pelapor +'</a></td><td>' + item.jenis_potensi.slice(12, 1000) +'</td><td>' + item.waktu_kejadian +'</td><td>' + item.updated_at +'</td><td><span style="color: green;"><b>' + item.status +'</b></span></td></tr>');
                    }
            } else {
                        if (item.status == 'Open'){
                        dataContainer.append('<tr> <td><a href="'+ urel +'">' + item.user_pelapor +'</a></td><td>' + item.jenis_potensi +'</td><td>' + item.waktu_kejadian +'</td><td>' + item.updated_at +'</td><td><span style="color: red;"><b>' + item.status +'</b></span></td></tr>');
                    } else {
                        dataContainer.append('<tr> <td><a href="'+ urel +'">' + item.user_pelapor +'</a></td><td>' + item.jenis_potensi +'</td><td>' + item.waktu_kejadian +'</td><td>' + item.updated_at +'</td><td><span style="color: green;"><b>' + item.status +'</b></span></td></tr>');
                    }
            }


                });
            }
        },
            error: function (xhr, status, error) {
                console.error('Ajax request error:', error);
            }
        });
    }
    
    // Call the function initially to load the data
    updateJadi();


    function updateGawat() {
        $.ajax({
            url: '{{ route('dashboard') }}',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Update the view with the new data
                var dataContainer = $('#data-gawat');
                dataContainer.empty(); // Clear existing data (if any)


    if (data.datay.gawat.length == 0){
        dataContainer.append('<tr> <td colspan="5" >Tidak ada laporan </td></tr>');
    } else {
                // Append the updated data to the container
                const nolaps = data.datay.gawat;
            // console.log(nolaps);
                nolaps.forEach(function (item) {
                    var urel = "/bencana-detil/" + item.id;
                    urls = urel.replace(/\/?(\?|#|$)/, '/$1');

            if (item.jenis_bencana.includes('Man-made Hazard')){
                    if (item.status == 'Open'){
                        dataContainer.append('<tr> <td><a href="'+ urel +'">' + item.no_bencana +'</a></td><td>' + item.jenis_bencana.slice(18, 1000) +'</td><td>' + item.tanggal_kejadian +'</td><td>' + item.updated_at +'</td><td><span style="color: red;"><b>' + item.status +'</b></span></td></tr>');
                    } else {
                        dataContainer.append('<tr> <td><a href="'+ urel +'">' + item.no_bencana +'</a></td><td>' + item.jenis_bencana.slice(18, 1000) +'</td><td>' + item.tanggal_kejadian +'</td><td>' + item.updated_at +'</td><td><span style="color: green;"><b>' + item.status +'</b></span></td></tr>');
                    }
            } else {
                        if (item.status == 'Open'){
                        dataContainer.append('<tr> <td><a href="'+ urel +'">' + item.no_bencana +'</a></td><td>' + item.jenis_bencana +'</td><td>' + item.tanggal_kejadian +'</td><td>' + item.updated_at +'</td><td><span style="color: red;"><b>' + item.status +'</b></span></td></tr>');
                    } else {
                        dataContainer.append('<tr> <td><a href="'+ urel +'">' + item.no_bencana +'</a></td><td>' + item.jenis_bencana +'</td><td>' + item.tanggal_kejadian +'</td><td>' + item.updated_at +'</td><td><span style="color: green;"><b>' + item.status +'</b></span></td></tr>');
                    }
            }


                });

    }
            },
            error: function (xhr, status, error) {
                console.error('Ajax request error:', error);
            }
        });
    }
    
    // Call the function initially to load the data
    updateGawat();

    // function updateTimex() {
    // $.ajax({
    //         url: '{{ route('grafik') }}',
    //         method: 'GET',
    //         dataType: 'json',
    //         success: function (data) {
    //             // Update the view with the new data
    //             var dataContainer = $('#data-timex');
    //             dataContainer.empty(); // Clear existing data (if any)

    //             data.datax.times.forEach(function (time) {
    //                dataContainer.append('<tr><td width="100px">' + time + '</td></tr>'); // Replace 'name' with the property you want to display
                    
    //             });

    //         },
    //         error: function (xhr, status, error) {
    //             console.error('Ajax request error:', error);
    //         }
    //     });
    // }

    // // Call the function initially to load the data
    // updateTimex();

    // function updateJaga() {
    //     $.ajax({
    //         url: '{{ route('grafik') }}',
    //         method: 'GET',
    //         dataType: 'json',
    //         success: function (data) {
    //             // Update the view with the new data
    //             var dataContainer = $('#data-jaga');
    //             dataContainer.empty(); // Clear existing data (if any)

    //             // Append the updated data to the container
    //             const nolap = data.dataz.jaga;
                
    //             nolap.forEach(function (item) {
    //                 var urel = "/trj-detil/" + item.no_trj +'/'+ item.id;
    //                 urls = urel.replace(/\/?(\?|#|$)/, '/$1');
    //                 dataContainer.append('<tr> <td><a href="'+ urel +'">' + item.danru + '</a></td></tr>'); // Replace 'name' with the property you want to display
    //             });
    //         },
    //         error: function (xhr, status, error) {
    //             console.error('Ajax request error:', error);
    //         }
    //     });
    // }

    // // Call the function initially to load the data
    // updateJaga();

    // function updateTimej() {
    // $.ajax({
    //         url: '{{ route('grafik') }}',
    //         method: 'GET',
    //         dataType: 'json',
    //         success: function (data) {
    //             // Update the view with the new data
    //             var dataContainer = $('#data-timej');
    //             dataContainer.empty(); // Clear existing data (if any)

    //             data.dataz.timej.forEach(function (time) {
    //                dataContainer.append('<tr><td>' + time + '</td></tr>'); // Replace 'name' with the property you want to display
                    
    //             });

    //         },
    //         error: function (xhr, status, error) {
    //             console.error('Ajax request error:', error);
    //         }
    //     });
    // }

    // // Call the function initially to load the data
    // updateTimej();



    setInterval(function () {
                updateGiat();
                // updateTime();
                updateJadi();
                updateGawat();
                // updateJaga();
                // updateTimej();
        }, 31000);


</script>
    <livewire:grafik-unras/>
@endpush
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
      <div class="card-body">
        <h5 class="card-title">Data Laporan Kegiatan</h5>
        <div class="row ">
                <table class="col">
                    <tr align="center">
                        <th >Dibuat Oleh</th>
                        <th>Terakhir Dibuat</th>
                    </tr>
                    <tbody align="center" id="data-giat"></tbody>
                </table>
        </div>
      </div>
    </div>
  </div>


  <div class="mt-2">
    <div class="card" style="background-color:rgba(255, 240, 0, 0.5);">
      <div class="card-body">
        <h5 class="card-title">Data Laporan Kejadian</h5>
        <div class="card-body overflow" style="overflow-x: auto;">
            <div class="row">
                <table class="col">
                    <tr align="center">
                        <th>Dibuat Oleh</th>
                        <th>Jenis<br/>Potensi</th>
                        <th>Tanggal<br/>Kejadian</th>
                        <th>Terakhir<br/>Diperbarui</th>
                        <th>Status</th>
                    </tr>
                    <tbody align="center" id="data-jadi">
                        
                    </tbody>

                    {{-- <tbody align="center" id="data-timex"></tbody> --}}
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>

 <div class="mt-2">
    <div class="card" style="background-color:rgba(207, 0, 15, 0.5);">
      <div class="card-body">
        <h5 class="card-title">Data Laporan Kegawatdaruratan</h5>
        <div class="card-body overflow" style="overflow-x: auto;">
            <div class="row">
                <table class="col">
                    <tr align="center">
                        <th>Nomor<br/>Laporan</th>
                        <th>Jenis<br/>Kegawatdaruratan</th>
                        <th>Tanggal<br/>Kejadian</th>
                        <th>Terakhir<br/>Diperbarui</th>
                        <th>Status</th>
                    </tr>
                    <tbody align="center" id="data-gawat">
                        
                    </tbody>

                    {{-- <tbody align="center" id="data-timex"></tbody> --}}
                </table>
            </div>
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
{{-- @elseif (Auth::user()->role === 'user')
    <meta content="0; url={{ route('kegiatan') }}" http-equiv="refresh">
@endif --}}


@endsection
