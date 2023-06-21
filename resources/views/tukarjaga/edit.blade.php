@extends('layouts.side')

@section('content')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
                <!-- Notifikasi -->
        @if ($message = Session::get('sukses'))
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
            <p/>
        @endif
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold ">{{ __('Edit Laporan Tukar Jaga') }}
                    <a href="{{url('trj-detil')}}/{{$edit->no_trj}}/{{$edit->id}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a>
                    {{-- <a href="{{route('tukarjaga')}}"><span class="btn btn-primary float-right btn-sm mx-2">Kembali</span></a> --}}
                </div>

                <div class="card-body overflow " style="overflow-x: auto;">

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
                            vertical-align: middle;
                        }
                        label {
                            margin: 0em;
                        }
                        pre {
                                white-space: pre-wrap;       /* Since CSS 2.1 */
                                white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
                                white-space: -pre-wrap;      /* Opera 4-6 */
                                white-space: -o-pre-wrap;    /* Opera 7 */
                                word-wrap: break-word;       /* Internet Explorer 5.5+ */
                            }

                        a {color:black;}
                       a:hover { color:rgb(0, 138, 0);}
                       label:hover { color:rgb(0, 138, 0);}
                    </style>

                    {{-- ubah shift --}}
                    <div class="mb-3">
                        <span>{{$edit->shift}}</span>

                        <span
                        data-toggle="modal"
                        data-target="#sip"
                        style="font-size: 10pt;" class="btn btn-sm btn-primary"> Ubah Shift
                    </span>
                  
                    <!-- Modal -->
                    <div class="modal fade"
                        id="sip"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    <form action="{{url('edt-shift')}}/{{$edit->no_trj}}/{{$edit->id}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                <table class="table table-striped table-hover mx-auto" style="width: 100%; ">
                                    <tr>
                                        <th colspan="2"><center>Ubah Jadwal Shift</center></th>
                                    </tr>
                                    <tr>
                                        <td>
                        <select class="form-select pb-0 pt-0" id="shift" name="shift" required>
                                <option value="{{$edit->shift}}">{{$edit->shift}}</option>
                            @if ($edit->shift == "Shift Pagi 07.00 - 19.00 WIB")
                                <option value="Shift Malam 19.00 - 07.00 WIB">Shift Malam 19.00 - 07.00 WIB</option>
                            @else
                                <option value="Shift Pagi 07.00 - 19.00 WIB" >Shift Pagi 07.00 - 19.00 WIB</option>
                            @endif
                        </select>
                                        </td>
                                    </tr>
                                </table>
                                <center> <button type="submit" class="btn btn-primary btn-sm">Simpan</button></center>
                            </form>
                                </div>
                 
                                <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-secondary"
                                        data-dismiss="modal">
                                        Close
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    {{-- end of ubah shift --}}

                    {{-- Tukar Shift --}}
                    <table class=" table-striped table-hover text-center table-responsive" width="100%">
                        <tr>
                            <td colspan="2">
                               <strong>Serah Terima Jaga</strong>
                            </td>
                        </tr>
                    <tr class="font-weight-normal xx ">
                        {{-- <th style="max-width:50px; min-width:30px;">No</th> --}}
                        <th style="padding-left:20px; padding-Right:20px;">Shift Lama &nbsp; 

                    <span
                        data-toggle="modal"
                        data-target="#lama"
                        style="color: blue; font-size: 16pt;" class="bi bi-plus-circle-fill">
                    </span>
                  
                    <!-- Modal -->
                    <div class="modal fade"
                        id="lama"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    <form action="{{url('add-shiftl')}}/{{$edit->no_trj}}/{{$editshift[0]->id}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                <table class="table table-striped table-hover mx-auto" style="width: 100%; ">
                                    <tr>
                                        <th colspan="2">Tambah Personil Shift Lama </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="shiftlama" placeholder="Shift Lama" class="form-control" required />
                                        </td>
                                    </tr>
                                </table>
                                <center> <button type="submit" class="btn btn-primary btn-sm">Tambah</button></center>
                            </form>
                                </div>
                 
                                <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-secondary"
                                        data-dismiss="modal">
                                        Close
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                        </th>

                        <th style="padding-left:20px; padding-Right:20px;">Shift Baru &nbsp; 
                    <span
                        data-toggle="modal"
                        data-target="#baru"
                        style="color: blue; font-size: 16pt;" class="bi bi-plus-circle-fill">
                    </span>
                  
                    <!-- Modal -->
                    <div class="modal fade"
                        id="baru"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    <form action="{{url('add-shiftb')}}/{{$edit->no_trj}}/{{$editshift[0]->id}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                <table class="table table-striped table-hover mx-auto " style="width: 100%; ">
                                    <tr align="center">
                                        <th colspan="2">Tambah Personil Shift Baru </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="shiftbaru" placeholder="Shift Baru" class="form-control" required />
                                        </td>
                                    </tr>
                                </table>
                                <center> <button type="submit" class="btn btn-primary btn-sm">Tambah</button></center>
                            </form>
                                </div>
                 
                                <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-secondary"
                                        data-dismiss="modal">
                                        Close
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                        </th>
                       {{-- <th style="width:72px; ">Option</th> --}}
                    </tr>

                    @foreach ($editshift as $key => $item)
                    <tr style="user-select: none;">
                        {{-- <td>{{$key+1}}</td> --}}
                        <td>@foreach (explode('|',$item->shift_lama) as $til)
                            {{$til}} &nbsp; <a href="/hapus-shiftlama/{{$til}}/{{$editshift[$key]->no_trj}}" title="Hapus Personil {{$til}}" onclick="return confirm('Hapus Personil {{$til}}?')"><i class="bi bi-trash3"></i></a><br>
                            @endforeach
                        </td>
                        <td>@foreach (explode('|',$item->shift_baru) as $tils)
                            {{$tils}} &nbsp; <a href="/hapus-shiftbaru/{{$tils}}/{{$editshift[$key]->no_trj}}" title="Hapus Personil {{$tils}}" onclick="return confirm('Hapus Personil {{$tils}}?')"><i class="bi bi-trash3"></i> </a><br>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                    </table>
                    {{--End of Tukar Shift --}}
                    <br>
                    <br>
                    {{-- Barang Inventaris --}}

                    
                    <table class=" table-striped table-hover text-center table-responsive" width="100%">
                    <tr> 
                        <td colspan="5">
                    <button
                        data-toggle="modal"
                        data-target="#barang"
                        style="font-size: 11pt;" class="btn btn-sm btn-primary bi bi-plus-circle-fill float-right mb-1">
                        Tambah
                    </button>
<strong>Barang Inventaris </strong> 
                    <!-- Modal -->
                    <div class="modal fade "
                        id="barang"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    <form action="{{url('add-inv')}}/{{$edit->no_trj}}" method="POST">
                                        @csrf
                                <table class="table table-striped table-hover mx-auto" style="width: 100%; ">
                                    <tr align="center">
                                        <th colspan="3">Tambah Barang Inventaris</th>
                                    </tr>
                <tr>
                    <td width="30%">
                        <input type="text" name="nabar" placeholder="Nama Barang" class="form-control m-0" required/>
                    </td>
                    <td>
                        <input type="text" name="jumlah" onkeypress="return angka(event)" placeholder="Jumlah Barang" class="form-control m-0" required/>
                    </td width="30%">
                    <td>
                        <input type="text" name="ket" placeholder="Keterangan" class="form-control m-0" required/>
                    </td width="30%">

                </tr>
                                </table>
                                <center> <button type="submit" class="btn btn-primary btn-sm">Tambah</button></center>
                            </form>
                                </div>
                 
                                <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-secondary"
                                        data-dismiss="modal">
                                        Close
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                            </td>
                        </tr>
                    <tr class="font-weight-normal xx ">
                        <th style="max-width:50px; min-width:30px;">No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                       <th style="width:72px; ">Option </th>
                    </tr>

                    @foreach ($editbar as $key => $ite)
                    <tr style="user-select: none;">
                        <td>{{$key + 1}}</td>
                        <td>
                            {{$ite->nabar}}
                        </td>
                        <td>
                            {{$ite->jumlah}}
                        </td>
                        <td>
                            {{$ite->ket}}
                        </td>
                        <td class="d-flex align-items-md-center" >
                        {{-- <a href="{{url('edit-tukarbarang')}}/{{$edit->no_trj}}/{{$editbar[$key]->id}}" hidden>
                            <button id="{{$key}}" type="submit" title="Edit {{$editbar[$key]->nabar}}" onclick="return confirm('Edit {{$editbar[$key]->nabar}}?')"> 
                            </button>
                        </a>
                        <label for="{{$key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn-sm">

                        </label> --}}
                    <span
                        data-toggle="modal"
                        data-target="#inv{{$key}}"
                        style="color: blue; font-size: 10pt;" class="bi bi-pencil-fill bg-warning btn-sm align-self-center">
                    </span>
                  
                    <!-- Modal -->
                    <div class="modal fade"
                        id="inv{{$key}}"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    <form action="{{url('update-inv')}}/{{$ite->no_trj}}/{{$editbar[$key]->id}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                <table class="table table-striped table-hover mx-auto" style="width: 100%; ">
                                    <tr align="center">
                                        <th colspan="4">Edit Barang Inventaris</th>
                                    </tr>
                    <tr class="font-weight-normal xx ">
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                    <tr style="user-select: none;">
                        <td>
                           <input type="text" name="nabar" value="{{$ite->nabar}}" class="form-control m-0" required> 
                        </td>
                        <td>
                           <input type="text" name="jumlah" onkeypress="return angka(event)" value="{{$ite->jumlah}}" class="form-control m-0" required> 
                        </td>
                        <td>
                           <input type="text" name="ket" value="{{$ite->ket}}" class="form-control m-0" required> 
                        </td>
                    </tr>
                                </table>
                                <center> <button type="submit" class="btn btn-primary btn-sm">update</button></center>
                            </form>
                                </div>
                 
                                <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-secondary"
                                        data-dismiss="modal">
                                        Close
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>

                            &nbsp;
                        <form action="{{url('hapus-tukarbarang')}}/{{$edit->no_trj}}/{{$editbar[$key]->id}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button id="del{{$key}}" onclick="return confirm('Hapus item ?')" type="submit" title="Hapus {{$editbar[$key]->nabar}}" hidden>
                                </button>
                                <label for="del{{$key}}" title="klik untuk hapus barang" class="bi bi-trash-fill bg-danger btn-sm align-self-center">

                                </label>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                    </table>
                    {{--End of Barang Inventaris --}}
                    <br>
                    <br>
                    {{-- Kegiatan --}}

                    <table class="table table-striped table-hover text-center table-responsive" width="100%">
                        <tr>
                            <td colspan="5">
                                <button
                        data-toggle="modal"
                        data-target="#giat"
                        style="font-size: 11pt;" class="btn btn-sm btn-primary bi bi-plus-circle-fill float-right">
                        Tambah
                    </button>
<strong>Laporan Kejadian/Kegiatan </strong> 
                    <!-- Modal -->
                    <div class="modal fade "
                        id="giat"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    <form action="{{url('add-giat')}}/{{$edit->no_trj}}" method="POST">
                                        @csrf
                                <table class="table table-striped table-hover mx-auto" style="width: 100%; ">
                                    <tr align="center">
                                        <th colspan="3">Tambah Laporan Kejadian/Kegiatan</th>
                                    </tr>
                <tr>
                    <td width="25%">
                        <input type="text" name="jam" placeholder="Jam" class="form-control" required/>
                    </td>
                    <td>
                        <textarea type="text" rows="3" name="uraian" placeholder="Uraian Kegiatan/Kejadian" class="form-control" required></textarea>
                    </td>
                </tr>
                                </table>
                                <center> <button type="submit" class="btn btn-primary btn-sm">Tambah</button></center>
                            </form>
                                </div>
                 
                                <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-secondary"
                                        data-dismiss="modal">
                                        Close
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                            </td>
                        </tr>
                    <tr class="font-weight-normal xx ">
                        <th style="max-width:50px; min-width:30px;">No</th>
                        <th>Jam</th>
                        <th>Uraian Kejadian/Kegiatan</th>
                       <th style="width:72px; ">Option</th>
                    </tr>

                    @foreach ($editgiat as $key => $it)
                    <tr style="user-select: none;">
                        <td>{{$key+1}}</td>
                        <td>
                            {{$it->jam}}
                        </td>
                        <td>
                            <pre style="word-wrap: break-word;">{{$it->uraian}}</pre>
                        </td>
                        <td class="d-flex align-items-md-center" >
                        {{-- <a href="{{url('edit-tukarbarang')}}/{{$edit->no_trj}}/{{$editbar[$key]->id}}" hidden>
                            <button id="{{$key}}" type="submit" title="Edit {{$editbar[$key]->nabar}}" onclick="return confirm('Edit {{$editbar[$key]->nabar}}?')"> 
                            </button>
                        </a>
                        <label for="{{$key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn-sm">

                        </label> --}}
                    <span
                        data-toggle="modal"
                        data-target="#giat{{$key}}"
                        style="color: blue; font-size: 10pt;" class="bi bi-pencil-fill bg-warning btn-sm align-self-center">
                    </span>
                  
                    <!-- Modal -->
                    <div class="modal fade"
                        id="giat{{$key}}"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    <form action="{{url('update-giat')}}/{{$it->no_trj}}/{{$it->id}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                <table class="table table-striped table-hover mx-auto" style="width: 100%; ">
                                    <tr align="center">
                                        <th colspan="4">Edit Barang Inventaris</th>
                                    </tr>
                    <tr class="font-weight-normal xx ">
                        <th>Jam</th>
                        <th>Keterangan</th>
                    </tr>
                    <tr style="user-select: none;">
                    <td width="25%">
                        <input type="text" name="jam" placeholder="Jam" maxlength="10" class="form-control" value="{{$it->jam}}" required/>
                    </td>
                    <td>
                        <textarea type="text" rows="3" name="uraian" placeholder="Uraian Kegiatan/Kejadian" class="form-control" required>{{$it->uraian}}</textarea>
                    </td>
                    </tr>
                                </table>
                                <center> <button type="submit" class="btn btn-primary btn-sm">update</button></center>
                            </form>
                                </div>
                 
                                <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-secondary"
                                        data-dismiss="modal">
                                        Close
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>

                            &nbsp;
                        <form action="{{url('hapus-tukargiat')}}/{{$edit->no_trj}}/{{$editgiat[$key]->id}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button id="delt{{$key}}" onclick="return confirm('Hapus item ?')" type="submit" title="Hapus Laporan ?" hidden>
                                </button>
                                <label for="delt{{$key}}" title="klik untuk hapus barang" class="bi bi-trash-fill bg-danger btn-sm align-self-center">

                                </label>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                    </table>
                    {{--End of Kegiatan --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection