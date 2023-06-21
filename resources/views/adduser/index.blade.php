@extends('layouts.side')

@section('content')
@if ( Auth::user()->role === 'admin')
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card ">
                <div class="card-header text-uppercase font-weight-bold">{{ __('Manage User') }}
                    <a href="{{route('adduser')}}"><span class="btn btn-primary float-right btn-sm">Tambah User</span></a>
                </div>

                <div class="card-body overflow " style="overflow-x: auto;">
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
        {{-- Password Error --}}
                @error('password')
            <div id="timeout" class="alert alert-danger flex flex-col md:justify-between" style="width: 80%; margin: 0 auto;">
                <div class="col-md-auto">
                        <div style="float: right;">
                            <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close" align="right"></button>
                        </div>                
                    </div>
                    <strong>{{ $message }}</strong>
            </div>
        @enderror

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
                    <div class="table-responsive mt-2">
                    <table class="table table-striped table-hover table-sm text-center ">
                    <tr class="font-weight-normal xx ">
                        <th scope="col" class="align-middle" style="max-width:50px; min-width:30px;">#ID</th>
                        <th scope="col" class="align-middle">Nama</th>
                        <th scope="col" class="align-middle">Email</th>
                        <th scope="col" class="align-middle">Role</th>
                        <th scope="col" class="align-middle">Level</th>
                        <th scope="col" class="align-middle">Lokasi</th>
                       <th class="align-middle" style="width:72px">Option</th>

                    </tr>
                    <style>
                         a {color:black;}
                        a:hover { color:rgb(0, 138, 0);}
                        label:hover { color:rgb(0, 138, 0);}
                    </style>
                    @foreach ($user as $key => $users)
                    <tr>
                        <td>{{$user->firstitem()+$key}}</td>
                        <td>{{$users->name}}</td>
                        <td>{{$users->email}}</td>
                        <td>{{$users->role}}</td>
                        <td>{{$users->level}}</td>
                        <td>{{$users->site->nama_gd ?? ''}}</td>
                        <td class="d-flex align-content-center" align="center"> 

                        <button
                        data-toggle="modal"
                        data-target="#user{{$user->firstitem()+$key}}"
                        style="font-size: 11pt;" class="btn btn-sm bi bi-pencil-fill bg-warning float-right mb-1" >
                        
                    </button>
                    <!-- Modal -->
                    <div class="modal fade "
                        id="user{{$user->firstitem()+$key}}"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                         
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- Add image inside the body of modal -->
                                <div align="center" class="modal-body center">
                                    <form action="{{url('update-user')}}/{{$users->id}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                <table class="table table-striped table-hover mx-auto" style="width: 100%; ">
                                    <tr align="center">
                                        <th colspan="3">Edit User</th>
                                    </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" name="name" placeholder="Nama User" value="{{$users->name}}" class="form-control m-0" required/>
                    </td>
                    </tr>
                     <tr>
                    <td colspan="2">
                        <input type="text" name="email" placeholder="Email" value="{{$users->email}}" class="form-control m-0" required/>
                    </td width="">
                     </tr>
                     <tr>
                    <td colspan="2">
                        <select class="form-select" name="role" id="role" required>
                                <option value="{{$users->role}}" >{{ucfirst(trans($users->role))}}</option>
                            @if ($users->role == 'admin')
                                <option value="user">User</option>
                            @else
                                <option value="admin">Admin</option>
                            @endif

                            </select>
                    </td >
                    </tr>
                     <tr>
                    <td colspan="2">
                        <select class="form-select" name="level" id="level">
                                <option value="{{$users->level}}" >{{$users->level}}</option>
                            @if ($users->level == '')
                            <option value="koordinator">Koordinator</option>
                                <option value="danru">Danru</option>
                            @elseif ($users->level == 'koordinator')
                                <option value="danru">Danru</option>
                            @else
                                <option value="koordinator">Koordinator</option>
                            @endif
                            </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select class="form-select pb-0 pt-0 text-capitalize" id="lokasi" name="lokasi">
                                <option value="{{$users->lokasi_tugas}}" selected>{{$users->site->nama_gd ?? '::Isi Lokasi::'}}</option>
                                @foreach($site as $item)
                                <option value="{{$item->id}}">{{$item->nama_gd}}</option>
                                @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                        <td colspan="2"><input id="password" type="password" placeholder="Password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    </tr>
                    <tr>
                        <td colspan="2"><input id="password-confirm" type="password" placeholder="Konfirmasi Password"  class="form-control" name="password_confirmation" required autocomplete="new-password"></td>
                    </tr>

                                </table>
                                <center> <button type="submit" class="btn btn-primary btn-sm">Update</button></center>
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

                            <form action="hapus-user/{{$users->id}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button id="del{{$user->firstitem() + $key}}" onclick="return confirm('Yakin nih {{$users->name}} mau di hapus ?')" type="submit" title="Hapus Data " hidden>
                                    </button>
                                    <label for="del{{$user->firstitem() + $key}}" class="bi bi-trash-fill bg-danger btn-sm align-self-center"></label>
                            </form>
                            </td>
                    </tr>
                    @endforeach
                    </table>
                     {{$user->links('pagination::bootstrap-5')}}
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
