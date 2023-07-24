<?php

namespace App\Http\Livewire;

use App\Models\UnrasModel;
use Livewire\Component;
use DB;

class GrafikUnras extends Component
{
    protected $listeners = ['ubahData' => 'changeData'];
    public $unras;
    public function mount()
    {

        $bulan = UnrasModel::select(DB::raw("MONTHNAME(tanggal) as bulan"))
                    ->GroupBy(DB::raw("MONTHNAME(tanggal)"))
                    ->latest()
                    ->distinct()
                    ->limit(12)
                    ->pluck('bulan');

        $bul = UnrasModel::select(DB::raw("MONTH(tanggal) as bul"))
                    ->GroupBy(DB::raw("MONTH(tanggal)"))
                    ->latest()
                    ->distinct()
                    ->limit(12)
                    ->pluck('bul');

         foreach ($bulan as $value) {
             $bulans[] = $value;
         }

            foreach ($bul as $key => $totals) {
            $total [] = UnrasModel::whereMonth('tanggal','=', $totals )
                    ->latest()
                    ->count();
            }

        foreach ($bul as $key => $ojks) {
            $ojk [] = UnrasModel::whereMonth('tanggal','=', $ojks)
                    ->where('tempat_kegiatan','LIKE', '%'.'ojk'.'%')
                    ->latest()
                    ->count();
            }

$data = ['bulan' => $bulans,
            'total' => $total,
            'ojk' => $ojk,
        ];


$this->unras = json_encode($data);
// dd($this->unras);

    }   

    public function render()
    {
        return view('unras.grafik')->extends('layouts.side')->section('content');
    }



public function changeData($value='')
{

        $bulan = UnrasModel::select(DB::raw("MONTHNAME(tanggal) as bulan"))
                    ->GroupBy(DB::raw("MONTHNAME(tanggal)"))
                    ->latest()
                    ->distinct()
                    ->limit(12)
                    ->pluck('bulan');

        $bul = UnrasModel::select(DB::raw("MONTH(tanggal) as bul"))
                    ->GroupBy(DB::raw("MONTH(tanggal)"))
                    ->latest()
                    ->distinct()
                    ->limit(12)
                    ->pluck('bul');

         foreach ($bulan as $value) {
             $bulans[] = $value;
         }

            foreach ($bul as $key => $totals) {
            $total [] = UnrasModel::whereMonth('tanggal','=', $totals )
                    ->latest()
                    ->count();
            }

        foreach ($bul as $key => $ojks) {
            $ojk [] = UnrasModel::whereMonth('tanggal','=', $ojks)
                    ->where('tempat_kegiatan','LIKE', '%'.'ojk'.'%')
                    ->latest()
                    ->count();
            }

$data = ['bulan' => $bulans,
            'total' => $total,
            'ojk' => $ojk,
        ];


$this->unras = json_encode($data);
$this->emit('berhasilUpdate', ['data' => $this->unras]);
}


}
