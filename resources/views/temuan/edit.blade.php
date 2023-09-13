@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Detail Laporan Temuan Patroli') }}

                        <a href="{{url('temuan-detil')}}/{{$edit->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>

                </div>
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
            <style>
                .table tr td {
                word-wrap: break-word;
                vertical-align: middle;
                white-space: nowrap;
                padding:1px !important;    
                }
                .fixed {
                  position: absolute;
                  top: 0;
                  right: 0;
                }
            </style>
<style>
.containerx {
  position: relative;
  width: 25%;
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
</style>
                <center>
        @if ($message = Session::get('berhasil'))
            <div id="timeout" align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between mx-1 fixed" style="width: 50%; margin: 0 auto;" role="alert">
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
        <div id="timeout" align="center" class="alert alert-warning alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between mx-1 fixed" style="width: 50%; margin: 0 auto;" role="alert">
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
</center>
        <div class="card-body overflow " style="overflow-x: auto;">

                    <form action="{{url('/update-temuan')}}/{{$edit->id}}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                    <table class="table mx-auto" style="width: 70%; ">
                    <tr>
                        <td><b>Tanggal</b></td>
                        <td>:</td>
                        <td>
                            <input type="date" class="form-control pb-0 pt-0" max="{{date('Y-m-d')}}" value="{{$edit->tanggal}}" name="tanggal" required>
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Jam</b></td>
                        <td>:</td>
                        <td>
                            <input type="time" class="form-control pb-0 pt-0"  name="jam" value="{{$edit->jam}}" required>
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Gedung</b></td>
                        <td>:</td>
                        <td>
                            <select class="form-select pb-0 pt-0 text-capitalize" id="lokasi_kejadian" name="lokasi_kejadian" required>
                                <option value="{{$id[0]->id}}">{{$edit->site->nama_gd}}</option>
                                @foreach($site as $item)
                                <option value="{{$item->id}}">{{$item->nama_gd}}</option>
                                @endforeach
                            </select>
                        </td> 
                    </tr>
                    <tr>
                        <td><b>Area</b></td>
                        <td>:</td>
                        <td colspan="3">
                        <input type="text" name="area" class="form-control pb-0 pt-0 text-capitalize" value="{{$edit->area}}" required>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Jenis Bahaya</b></td>
                        <td>:</td>
                        <td colspan="3">
                            <input type="text" name="jenis_bahaya" class="form-control pb-0 pt-0 text-capitalize" value="{{$edit->jenis_bahaya}}" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Potensi Bahaya : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="4" name="potensi_bahaya" id="giat" required>{{$edit->potensi_bahaya}}</textarea></pre></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Pengendalian : </b><pre class="mb-0"><textarea class="form-control pb-0 pt-0" rows="4" name="pengendalian" id="ket" required>{{$edit->pengendalian}}</textarea></pre></td>
                    </tr>
                    <tr>
                        <td><b>Foto Dokumentasi</b></td>

                        <td>
                @if ($edit->foto == null)
                    <div>
                            Upload Foto
                            <input type="file" name="images[]"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" 
                                    accept=".jpg, .jpeg, .png" 
                                    multiple/>

                    </div>
                    @else
                    <div>
                        <td colspan="3">
                        <div class="row">
                            @foreach(explode('|',$edit->foto) as $item)

                            <div class="containerx">
                                
                               <img class="image" src="{{asset('storage/temuan')}}/{{$edit->no_lap}}/{{$item}}" style="width: 100%; margin-bottom: 5pt"> &nbsp;
                            <div class="middle">
                            <div class="text"><a href="/temuan/hapus-foto/{{$item}}/{{$edit->id}}" title="Hapus Foto" onclick="return confirm('Yakin foto dokumentasi mau di hapus ?')"><i class="bi bi-trash3"></i></a></div>
                          </div>
                            </div>

                            @endforeach
                        </div>
                        
                    </div>
                    <div>
                        <div class="form-group mb-2">
                            <label class="mb-0">Tambah Foto</label>
                            <input type="file" name="images[]"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" 
                                    accept=".jpg, .jpeg, .png" 
                                    multiple/>
                        </div> 
                    </div>
                </td>
                    @endif

                        </td>
                    </tr>
                    </table>
                <center>
                    <button type="submit" class="btn btn-primary" style = "text-align:center">
                        {{ __('Simpan') }}
                    </button>
                </center>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
