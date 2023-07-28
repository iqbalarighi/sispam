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
            <div id="timeout" align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between mx-1" style="width: 80%; margin: 0 auto;" role="alert">
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
                            padding-left: 1rem;
                            padding-right: 1rem;
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
            url: '{{ route('grafik') }}',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Update the view with the new data
                var dataContainer = $('#data-giat');
                dataContainer.empty(); // Clear existing data (if any)

                // Append the updated data to the container
                const nolap = data.datas.giats;
                
                nolap.forEach(function (item) {
                    var urel = "/giat-detil/";
                    urls = urel.replace(/\/?(\?|#|$)/, '/$1');
                   dataContainer.append('<tr><td><a href="'+urel + item.id +'">' + item.danru + '</a></td></tr>'); // Replace 'name' with the property you want to display
                              });

            },
            error: function (xhr, status, error) {
                console.error('Ajax request error:', error);
            }
        });
    }

    // Call the function initially to load the data
    updateGiat();

    function updateTime() {
    $.ajax({
            url: '{{ route('grafik') }}',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Update the view with the new data
                var dataContainer = $('#data-time');
                dataContainer.empty(); // Clear existing data (if any)

                data.datas.time.forEach(function (tes) {
                   dataContainer.append('<tr><td>' + tes + '</td></tr>'); // Replace 'name' with the property you want to display
                });
            },
            error: function (xhr, status, error) {
                console.error('Ajax request error:', error);
            }
        });
    }

    // Call the function initially to load the data
    updateTime();

    function updateJadi() {
        $.ajax({
            url: '{{ route('grafik') }}',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Update the view with the new data
                var dataContainer = $('#data-jadi');
                dataContainer.empty(); // Clear existing data (if any)

                // Append the updated data to the container
                const nolap = data.datax.jadi;
            // console.log(nolap);
                nolap.forEach(function (item) {
                    var urel = "/kejadian-detil/" + item.no_lap;
                    urls = urel.replace(/\/?(\?|#|$)/, '/$1');

                    function pad(s) { return (s < 10) ? '0' + s : s; }
                      var d = new Date(item.waktu_kejadian);
                      var e = new Date(item.updated_at);
                      
if (item.jenis_kejadian.includes('Lain-lain')){
                    if (item.status == 'Open'){
                        dataContainer.append('<tr> <td><a href="'+ urel +'">' + item.user_pelapor +'</a></td><td>' + item.jenis_kejadian.slice(12, 1000) +'</td><td>' + [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('-') +'</td><td>' + [pad(e.getDate()), pad(e.getMonth()+1), e.getFullYear()].join('-') +'</td><td><span style="color: red;"><b>' + item.status +'</b></span></td></tr>');
                    } else {
                        dataContainer.append('<tr> <td><a href="'+ urel +'">' + item.user_pelapor +'</a></td><td>' + item.jenis_kejadian.slice(12, 1000) +'</td><td>' + [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('-') +'</td><td>' + [pad(e.getDate()), pad(e.getMonth()+1), e.getFullYear()].join('-') +'</td><td><span style="color: green;"><b>' + item.status +'</b></span></td></tr>');
                    }
} else {
                        if (item.status == 'Open'){
                        dataContainer.append('<tr> <td><a href="'+ urel +'">' + item.user_pelapor +'</a></td><td>' + item.jenis_kejadian +'</td><td>' + [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('-') +'</td><td>' + [pad(e.getDate()), pad(e.getMonth()+1), e.getFullYear()].join('-') +'</td><td><span style="color: red;"><b>' + item.status +'</b></span></td></tr>');
                    } else {
                        dataContainer.append('<tr> <td><a href="'+ urel +'">' + item.user_pelapor +'</a></td><td>' + item.jenis_kejadian +'</td><td>' + [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('-') +'</td><td>' + [pad(e.getDate()), pad(e.getMonth()+1), e.getFullYear()].join('-') +'</td><td><span style="color: green;"><b>' + item.status +'</b></span></td></tr>');
                    }
}


                });
            },
            error: function (xhr, status, error) {
                console.error('Ajax request error:', error);
            }
        });
    }
    
    // Call the function initially to load the data
    updateJadi();

    function updateTimex() {
    $.ajax({
            url: '{{ route('grafik') }}',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Update the view with the new data
                var dataContainer = $('#data-timex');
                dataContainer.empty(); // Clear existing data (if any)

                data.datax.times.forEach(function (time) {
                   dataContainer.append('<tr><td width="100px">' + time + '</td></tr>'); // Replace 'name' with the property you want to display
                    
                });

            },
            error: function (xhr, status, error) {
                console.error('Ajax request error:', error);
            }
        });
    }

    // Call the function initially to load the data
    updateTimex();

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
                updateTime();
                updateJadi();
                // updateTimex();
                // updateJaga();
                // updateTimej();
        }, 31000);
</script>
@endpush
                    <div class="card-body overflow px-3 pt-1" style="overflow-x: auto;">

<div class="row">

  <div class="col-sm-6 mt-2">
    <div class="card" style="background-color:rgba(179, 255, 240, 0.5);">
      <div class="card-body">
        <h5 class="card-title">Data Terakhir Laporan Kegiatan</h5>
        <div class="row ">
                <table class="col">
                    <tr align="center">
                        <th >Dibuat Oleh</th>
                    </tr>
                    <tbody align="center" id="data-giat"></tbody>
                </table>
                <table  class="col">
                    <tr align="center">
                        <th>Terakhir Di Buat</th>
                    </tr>
                    <tbody align="center" id="data-time"></tbody>
                </table>
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

  <div class="col-sm-6 mt-2">
    <div class="card" style="background-color:rgba(179, 236, 255, 0.5);">
      <div class="card-body">
        <h5 class="card-title">Data Terakhir Laporan Kejadian</h5>
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


  <div class="col-sm-6 mt-2">
    <div class="card" style="background-color:rgba(179, 218, 255, 0.5);">
      <div class="card-body">
        <h5 class="card-title">Grafik UNRAS</h5>
        {{-- <p class="card-text">Data Grafik UNRAS</p> --}}
            @yield('grafik')
      </div>
    </div>
  </div>

</div>


                </div>
            </div>
        </div>
    </div>
</div>
{{-- @elseif (Auth::user()->role === 'user')
    <meta content="0; url={{ route('kegiatan') }}" http-equiv="refresh">
@endif --}}

<script>

</script>
@endsection
