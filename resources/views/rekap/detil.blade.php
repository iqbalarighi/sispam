@extends('layouts.side')

@section('content')
<div class="container mw-100" >
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Detail Laporan') }}
    @if(Auth::user()->role === "admin" || Auth::user()->level == "superadmin")
                        {{-- <a href="{{url('edit_smc')}}/{{$show->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Edit Laporan</span></a> --}}
                        <a href="{{route('rekap')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
    @else
                        <a href="{{ url()->previous() }}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
    @endif

                </div>


                    @if (session('status'))
                        <div id="timeout" class="alert alert-success" role="alert">
                          <center> {{ session('status') }} </center> 
                        </div>
                    @endif

{{--                     <iframe
                        src="{{asset('storage/rekap')}}/{{Carbon\Carbon::parse($show->tanggal)->isoFormat('YYYY')}}/{{Carbon\Carbon::parse($show->tanggal)->isoFormat('MMMM')}}/{{$show->file}}"
                        width="100%"
                        height="100%"
                        style="border:none"
                    ></iframe> --}}
    <div class="mt-2">
<center>
<object

    data="{{asset('storage/rekap')}}/{{Carbon\Carbon::parse($show->bulan)->isoFormat('YYYY')}}/{{Carbon\Carbon::parse($show->bulan)->isoFormat('MMMM')}}/{{$show->nama_file}}#toolbar=0"
    type="application/pdf"
    width="90%"
    height="700px"
>
    <iframe 
        src="{{asset('storage/rekap')}}/{{Carbon\Carbon::parse($show->bulan)->isoFormat('YYYY')}}/{{Carbon\Carbon::parse($show->bulan)->isoFormat('MMMM')}}/{{$show->nama_file}}#toolbar=0"
        width="90%"
        height="700px"
        style="border: none"
    >
        <p>
            Your browser does not support PDFs.
            <a href="{{asset('storage/rekap')}}/{{Carbon\Carbon::parse($show->bulan)->isoFormat('YYYY')}}/{{Carbon\Carbon::parse($show->bulan)->isoFormat('MMMM')}}/{{$show->nama_file}}">Download the PDF</a>
        </p>
    </iframe>
</object>
</center>
</div>
<p></p>
                @if(Auth::user()->role === "admin" || Auth::user()->level == "superadmin")
                <center><a href="{{asset('storage/rekap')}}/{{Carbon\Carbon::parse($show->bulan)->isoFormat('YYYY')}}/{{Carbon\Carbon::parse($show->bulan)->isoFormat('MMMM')}}/{{$show->nama_file}}" target="_blank"><span class="btn btn-primary btn-sm ml-2">Download Laporan</span></a></center>
                @endif 


            </div>
        </div>
    </div>
</div>

@endsection