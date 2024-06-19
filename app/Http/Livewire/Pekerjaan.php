<?php

namespace App\Http\Livewire;

use App\Models\IzinvendorModel;
use Livewire\Component;

class Pekerjaan extends Component
{
    public function render()
    {

        $kerja = IzinvendorModel::with('izin_informasi')->where('status', 'Open')->orwhere('status', 'Waiting')->latest()->take(2)->get();
        $kerja2 = IzinvendorModel::with('izin_informasi')->where('status', 'On Progress')->latest()->take(4)->get();
        $kerja3 = IzinvendorModel::with('izin_informasi')->where('status', 'Expired')->latest()->take(2)->get();

        return view('livewire.pekerjaan', compact('kerja', 'kerja2', 'kerja3'));
    }
}
