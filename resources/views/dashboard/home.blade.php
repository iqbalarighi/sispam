@extends('layouts.side')

@section('content')
@if ( Auth::user()->role === 'admin')
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
                        .xx {
                            font-size: 10pt;
                            text-align: center;
                        }
                        .table tr td {
                            padding:0.3rem;
                            vertical-align: middle;
                            max-width:100%;
                            white-space:nowrap;
                        }
                        .table th {
                            padding:0.3rem;
                            white-space:nowrap;
                        }
                        label {
                            margin: 0em;
                        }
                    </style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                // Append the updated data to the container
                data.giats.data.forEach(function (item) {
                    dataContainer.append('<tr> <td>' + item.no_lap + '</td></tr>'); // Replace 'name' with the property you want to display
                });
            },
            error: function (xhr, status, error) {
                console.error('Ajax request error:', error);
            }
        });
    }

    // Call the function initially to load the data
    updateGiat();

    // Set an interval to update the data every 5 seconds (or any other interval you prefer)
    setInterval(updateGiat, 3000); // 5000 milliseconds = 5 seconds
</script>
<script>
    function updateJadi() {
        $.ajax({
            url: '{{ route('dashboard') }}',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Update the view with the new data
                var dataContainer = $('#data-jadi');
                dataContainer.empty(); // Clear existing data (if any)

                // Append the updated data to the container
                data.jadi.data.forEach(function (item) {
                    dataContainer.append('<tr> <td>' + item.no_lap + '</td></tr>'); // Replace 'name' with the property you want to display
                });
            },
            error: function (xhr, status, error) {
                console.error('Ajax request error:', error);
            }
        });
    }

    // Call the function initially to load the data
    updateJadi();

    // Set an interval to update the data every 5 seconds (or any other interval you prefer)
    setInterval(updateJadi, 3000); // 5000 milliseconds = 5 seconds
</script>
                    <div class="card-body overflow " style="overflow-x: auto;">

                    <div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Laporan Kegiatan</h5>
        <p class="card-text">Data Terbaru Laporan Kegiatan</p>
<table id="data-giat">

</table>

      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
<table id="data-jadi">

</table>
      </div>
    </div>
  </div>
</div>

                </div>
            </div>
        </div>
    </div>
</div>
@elseif (Auth::user()->role === 'user')
    <meta content="0; url={{ route('kegiatan') }}" http-equiv="refresh">
@endif
@endsection
