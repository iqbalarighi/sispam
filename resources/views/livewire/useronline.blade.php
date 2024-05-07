<div >
    {{-- Care about people's approval and you will be their prisoner. --}}
<div class="card-body"  style="overflow-x: auto;" wire:poll>
    <center>
                    <table class="table-striped table-hover table-sm text-center mt-3" width="100%">

                            <tr class="bg-secondary text-white">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Terakhir Terlihat</th>
                                <th>Status</th>
                            </tr>


                            @foreach($users as $key => $user)
                            <tr>
                                <td>{{$users->firstitem() + $key}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>@if($user->isOnline())
                                    Sekarang
                                    @elseif($user->last_seen == null)
                                    Tidak Pernah
                                    @else
                                    {{Carbon\Carbon::parse($user->last_seen)->diffForHumans()}}
                                    @endif
                                    
                                </td>
                                <td>
                                       <span class="bg-{{$user->isOnline() == true ? 'success' : 'danger'}} text-white rounded fw-bold py-1 px-2">{{$user->isOnline() == true ? 'Online' : 'Offline'}}</span>
                                </td>
                            </tr>
                            @endforeach

                    </table>
                </center>
                </div>
               <div class="px-4 mt-2 float-end ">{{$users->links()}}</div>
</div>
