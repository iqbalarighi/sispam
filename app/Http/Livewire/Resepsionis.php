<?php

namespace App\Http\Livewire;

use App\Models\ResepsionisModel;
use Livewire\Component;
use Carbon\Carbon;

class Resepsionis extends Component
{
    public function render()
    {
        $now = Carbon::now()->parse()->isoFormat('YYYY-MM-DD');
        // $now = '2023-11-13';

        $resepsionis = ResepsionisModel::where('created_at', 'LIKE','%'.$now.'%' )
        ->orderBy('created_at', 'DESC')
        ->latest()
        ->take(5)
        ->get();

$total = ResepsionisModel::where('created_at', 'LIKE','%'.$now.'%' )
        ->orderBy('created_at', 'DESC')
        ->latest()
        ->sum('jumlah_tamu');

        $count = ResepsionisModel::where('created_at', 'LIKE','%'.$now.'%' )
        ->Where('jam_pulang', null)
        ->orderBy('created_at', 'DESC')
        ->latest()
        ->sum('jumlah_tamu');

        $count2 = ResepsionisModel::where('created_at', 'LIKE','%'.$now.'%' )
        ->Where('jam_pulang', '!=', null)
        ->orderBy('created_at', 'DESC')
        ->latest()
        ->sum('jumlah_tamu');
        return view('livewire.resepsionis', compact('resepsionis', 'count', 'count2', 'total'));
    }
}
