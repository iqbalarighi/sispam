@extends('layouts.side')

@section('content')
<div class="container mw-100 p-0">
    <div class="row justify-content-center">
        <div class="col mw-100">
                <!-- Notifikasi -->
        @if ($message = Session::get('sukses'))
            <div align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
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
            <div class="card">
                <div class="card-header text-uppercase font-weight-bold ">{{ __('Buat Laporan Tukar Jaga') }}
                    <a href="{{route('tukarjaga')}}"><span class="btn btn-primary float-right btn-sm">Kembali</span></a>
                </div>

                <div class="card-body overflow p-1 m-0" style="overflow-x: auto;">

{{-- #################################################################################### --}}

        <form action="{{ route('simpan_tukar') }}" method="POST">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
            <table border="0" class=" mx-auto" style="width: 70%; ">
                <tr>
                    <td colspan="2">Shift :                         
                        <select class="form-select pb-0 pt-0 text-capitalize" id="shift" name="shift" required>
                                <option value="" disabled selected>Pilih Shift</option>
                                <option value="Shift Pagi 07.00 - 19.00 WIB">Shift Pagi</option>
                                <option value="Shift Malam 19.00 - 07.00 WIB">Shift Malam</option>
                        </select> </td>
                </tr>
                <tr>
                    <td colspan="2">Tanggal : <input type="date" name="tgl" value="{{date('Y-m-d')}}" class="form-control" /> </td>
                </tr>
                <tr>
                    <td>Lokasi Gedung : 
                        <select class="form-select pb-0 pt-0 text-capitalize" id="lokasi" name="lokasi" required>
                                <option value="" disabled selected>Pilih Gedung</option>
                                @foreach($site as $item)
                                <option value="{{$item->id}}">{{$item->nama_gd}}</option>
                                @endforeach
                        </select>
                    </td>
                </tr>
            </table>
            <p></p>
            <table class="table table-striped table-hover mx-auto" style="width: 100%; " id="dynamicAddRemove">
                <tr>
                    <th colspan="2">A. Shift Lama </th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="shiftlama[]" placeholder="Shift Lama" class="form-control" required />
                    </td>
                </tr>
            </table>
               <button type="button" name="add" id="dynamic-ar" class="btn btn-primary btn-sm float-right">Tambah Kolom</button>
               <br>
               <br>
            <table class="table table-striped table-hover mx-auto" style="width: 100%; " id="dynamicAddRemove1">
                <tr>
                    <th colspan="2">B. Shift Baru </th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="shiftbaru[]" placeholder="Shift Baru" class="form-control" required />
                    </td>
                </tr>
            </table>
            <button type="button" name="add" id="dynamic-ar1" class="btn btn-primary btn-sm float-right">Tambah Kolom</button>
               <br>
               <br>
                <table class="table table-striped table-hover mx-auto" style="width: 100%; " id="dynamicAddRemove2">
                <tr>
                    <th colspan="5">C. Barang Inventaris </th>
                </tr>
                <tr align="center">
                    <td >Nama Barang</td>
                    <td >Jumlah</td>
                    <td >Keterangan</td>
                </tr>
                <tr>
                    <td width="30%">
                        <input type="text" name="nabar[]" placeholder="Nama Barang" class="form-control m-0" required/>
                    </td>
                    <td>
                        <input type="text" name="jumlah[]" onkeypress="return angka(event)" placeholder="Jumlah Barang" class="form-control m-0" required/>
                    </td width="30%">
                    <td>
                        <input type="text" name="ket[]" placeholder="Keterangan" class="form-control m-0" required/>
                    </td width="30%">
                </tr>
            </table>

            <button type="button" name="add" id="dynamic-ar2" class="btn btn-primary btn-sm float-right">Tambah Kolom</button>
{{--                 <table class="table table-striped table-hover mx-auto" style="width: 100%; " id="dynamicAddRemove3">
                <tr>
                    <th colspan="5">Kunci Ruangan</th>
                </tr>
                <tr align="center">
                    <td >Kunci</td>
                    <td >Lantai</td>
                    <td >Jumlah</td>
                    <td >kondisi</td>
                    <td >Keterangan</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="kunci[]" placeholder="Kunci" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="lantai[]" placeholder="Lantai" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="jum[]" placeholder="Jumlah Kunci" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="kondisi[]" placeholder="Kondisi Kunci" class="form-control" />
                    </td>
                    <td>
                        <input type="text" name="ket[]" placeholder="Keterangan" class="form-control" />
                    </td>
                    <td>
                        <button type="button" name="add" id="dynamic-ar3" class="btn btn-primary">Tambah</button>
                    </td>
                </tr>
            </table> --}}
             <table class="table table-striped table-hover mx-auto" style="width: 100%; " id="dynamicAddRemove4">
                <tr>
                    <th colspan="5">D. Daftar Kejadian/Kegiatan</th>
                </tr>
                <tr align="center">
                    <td >Jam</td>
                    <td >Uraian Kejadian/Kegiatan</td>
                </tr>
                <tr>
                    <td width="25%">
                        <input type="text" name="jam[]" placeholder="Jam" class="form-control" required/>
                    </td>
                    <td>
                        <textarea type="text" rows="1" name="uraian[]" placeholder="Uraian Kegiatan/Kejadian" class="form-control" required></textarea>
                    </td>
                </tr>
            </table>
            <button type="button" name="add" id="dynamic-ar4" class="btn btn-primary btn-sm float-right">Tambah Kolom</button>
            <br>
            <br>
                    
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
