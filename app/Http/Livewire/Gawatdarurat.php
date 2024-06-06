<?php

namespace App\Http\Livewire;

use App\Models\BencanaModel;
use Livewire\Component;

class Gawatdarurat extends Component
{
    public function render()
    {
        $gawat = BencanaModel::where('status','Open')->latest()->take(3)->get();
        $gawat2 = BencanaModel::where('status','Resolved')->latest()->take(3)->get();

        return view('livewire.gawatdarurat', compact('gawat', 'gawat2'));
    }
}
