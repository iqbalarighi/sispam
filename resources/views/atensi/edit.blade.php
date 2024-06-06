@extends('layouts.side')

@section('content')
@if (Auth::user()->name == $edit->creator || Auth::user()->level === 'superadmin')

<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Edit Laporan Kegiatan') }}
                    <a href="{{url('/atensi_detil')}}/{{$edit->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

                </div>

                <div class="card-body overflow pl-0 pr-0" >
                        <style>
                            .table tr td {
                            word-wrap: break-word;
                            vertical-align: middle;
                            white-space: nowrap;
                            padding:1px !important;    
                            }
                        </style>
                        
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
        @if ($message = Session::get('success'))
            <div id="timeout" align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
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
        <div align="center" class="alert alert-warning alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
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
    .textarea {
  width: 300px;
  height: 150px;
}
</style>

{{-- ini style buat gambar --}}
<style>
.containerx {
  position: relative;
  width: 50%;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.containerx:hover .image {
  opacity: 0.3;
}

.containerx:hover .middle {
  opacity: 1;
}

.text {
  color: black;
  font-size: 24px;
  padding: auto;
}

pre {font-family: "Times New Roman";}
</style>
            <!-- form input Site -->
                    <div class="table-responsive mt-2" style="overflow-x: auto;">
            <form action="{{url('update_atensi')}}/{{$edit->id}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                    <table class="mx-auto" style="width: 70%; ">

                    <tr>
                        <td colspan="3"><b>Yth : </b><pre class="mb-0"><textarea rows="4" class="form-control pb-0 pt-0" name="yth" required>{{$edit->yth}}</textarea></pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Rencana Kegiatan : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="2" name="rencana" required>{{$edit->rencana}}</textarea></pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Uraian Rencana Kegiatan : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="10" name="uraian" >{{$edit->uraian}}</textarea></pre></td>
                    </tr>


                    </table>
                <center>
                    <button type="submit" class="btn btn-primary mt-2" style = "text-align:center">
                        {{ __('Update') }}
                    </button>
                </center>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else 
{{abort(403)}}
@endif
@endsection