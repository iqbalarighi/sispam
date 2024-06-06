<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Useronline extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        $users = User::orderBy('last_seen', 'DESC')

        ->paginate(15);

        return view('livewire.useronline', compact('users'));
    }
}
