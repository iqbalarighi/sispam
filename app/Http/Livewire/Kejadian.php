<?php

namespace App\Http\Livewire;

use App\Models\KejadianModel;
use Livewire\Component;

class Kejadian extends Component
{
    public function render()
    {
        $jadi = KejadianModel::where('status','Open')->latest()->take(2)->get();
        $jadi2 = KejadianModel::where('status','Resolved')->latest()->take(2)->get();

        return view('livewire.kejadian', compact('jadi', 'jadi2'));
    }
}
