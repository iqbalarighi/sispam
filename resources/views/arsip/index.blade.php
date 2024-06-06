@extends('layouts.side')

@section('content')
@if (Auth::user()->role === 'user')
    {{-- <meta content="0; url={{ route('kegiatan') }}" http-equiv="refresh"> --}}
        {{abort(404)}}
@endif
<style>
                        .xx {
                            font-size: 11pt;
                            text-align: center;
                        }
                        .table tr td {
                            padding:0.2rem;
                            vertical-align: middle;
                            max-width:100%;
                            white-space: nowrap;
                            font-size: 11pt;
                        }
                        .table th {
                            padding:0.2rem;
                            white-space: nowrap;
                        }
                        label {
                            margin: 0em;
                        }
                    </style>

<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Arsip') }}
                    <a href="{{route('tambah-arsip')}}"><span class="btn btn-primary float-right btn-sm">Tambah Data</span></a>
                </div>

                
    <!-- Error Handle -->
        @if ($errors->any())
            <div id="timeout" class="alert alert-danger flex flex-col md:justify-between" style="width: 80%; margin: 0 auto;">
                <div class="col-md-auto">
                        <div style="float: right;">
                            <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close" align="right"></button>
                        </div>                
                    </div>
                            @foreach ($errors->all() as $error)
                <div class="row">
                    <div class="col">
                        <div class="card-text" align="center">
                            {{ $error }} 
                        </div>
                    </div>
                </div>
                    @endforeach
            </div>
        @endif

    <!-- Notifikasi -->
        @if ($message = Session::get('status'))
            <script>
                    Swal.fire({
                      title: "Berhasil",
                      text:  "{{ $message }}",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 1000
                    });
            </script>
        @endif
                <form action="" method="GET" class="m-1">
                    <input type="cari" name="cari" placeholder="Cari" autocomplete="off"> <button class="submit bi bi-search"></button>
                </form>
        <div class="card-body overflow " style="overflow-x: auto;">

                    <table class="table table-hover table-striped text-center ">
                    <tr class="font-weight-normal xx ">
                        <th class="align-middle" style="max-width:50px; min-width:30px;">No</th>
                        <th class="align-middle">No Arsip</th>
                        <th class="align-middle" style="">Nama Arsip</th>
                        <th class="align-middle">Tahun</th>
                        <th class="align-middle">Uraian</th>
                        <th class="align-middle">Lokasi Fisik</th>
                        <th class="align-middle">File</th>
                       <th class="align-middle" style="width:72px; ">Option</th>

                    </tr>
                    <style>
                        a {color:black;}
                       a:hover { color:rgb(0, 138, 0);}
                       label:hover { color:rgb(0, 138, 0);}
                    </style>
                    @foreach($arsip as $key => $arsp) 
                    <tr >
                        <td>{{$arsip->firstitem() + $key}}</td>
                        <td>{{$arsp->no_arsip}}</td> 
                        <td style="white-space: normal; text-align: left;">{{$arsp->nm_arsip}}</td> 
                        <td>{{$arsp->tahun}}</a></td>
                        <td style="white-space: normal; text-align: left;">{{$arsp->uraian}}</td>
                        <td>{{$arsp->lokasi_fisik}}</td>
                        <td style="white-space: normal; font-size: 16pt">

                            @if ($arsp->file == null)
                            <i class="bi bi-file-earmark-excel"></i>
                            @else
                            <a href="{{ asset('storage/arsip/').'/'.$arsp->tahun.'/'.$arsp->file }}" target="_blank" rel="noopener noreferrer" title="{{$arsp->nm_arsip}}">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                            </a>
                            @endif
                        
                        </td>
                        <td style="vertical-align: middle;"> 
                            <div class="d-flex justify-content-between">
                            <a href="/edit-arsip/{{$arsp->id}}" hidden>
                                <button id="dit{{$arsip->firstitem() + $key}}" type="submit" title="Edit Data ">
                                </button>
                            </a>
                            <label for="dit{{$arsip->firstitem() + $key}}" class="bi bi-pencil-fill bg-warning btn-sm align-self-center">

                            </label>
                                &nbsp;
                            <form action="hapus-arsip/{{$arsp->id}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button id="del{{$arsip->firstitem() + $key}}" type="submit" title="Hapus Data " hidden>
                                    </button>
                                    <label for="del{{$arsip->firstitem() + $key}}" class="bi bi-trash-fill bg-danger btn-sm align-self-center">

                                    </label>
                            </form>
                        </div>
                            </td>
                    </tr>
<script>
    $('#del{{$arsip->firstitem() + $key}}').click(function(event){
        var form =  $(this).closest("form");
        event.preventDefault();
        Swal.fire({
                  title: "Hapus Arsip {{$arsp->no_arsip}} ?",
                  text: "Data terhapus tidak dapat dikembalikan !",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  cancelButtonText: "Batal",
                  confirmButtonText: "Hapus"
                }).then((result) => {
                  if (result.isConfirmed) {
                    form.submit();
                  }
                });
    });
</script>
                    @endforeach
                    
                    </table>
                </div>
                <br/>
                {{$arsip->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>
@endsection
