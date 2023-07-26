<?php

namespace App\Http\Livewire;

use App\Models\UnrasModel;
use Livewire\Component;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class GrafikUnras extends Component
{
    protected $listeners = ['ubahData' => 'changeData'];
    public $unras;
    public function mount()
    {

        $dasar =  DB::table('unras')
  ->selectRaw('EXTRACT(YEAR_MONTH FROM tanggal) as dasar')
  ->distinct()
  ->latest()
  ->pluck('dasar');

         foreach ($dasar as $value) {
            $bul[] = Str::substr($value, 4,2);
            $tah[] = Str::substr($value, 0,4);
         }

    foreach ($bul as $key => $bbb) {
                    $bulan []= UnrasModel::select(DB::raw("MONTHNAME(tanggal) as bulan"))
                    ->whereMonth('tanggal', $bbb)
                    ->latest()
                    ->distinct()
                    ->limit(12)
                    ->pluck('bulan');
    }

        foreach ($dasar as $but) {
            $vc = $but.'01';
     
            $bulantahun[] = Carbon::parse($vc)->format('F Y');
         }
  
            foreach ($bul as $key => $v) {
                $total []= DB::table('unras')
                                    ->whereMonth('tanggal', $v)
                                    ->count();
                    }

        foreach ($bul as $ojks) {
            $ojk [] = UnrasModel::whereMonth('tanggal','=', [$ojks])
                    ->where('tempat_kegiatan','LIKE', '%'.'ojk'.'%')
                    ->latest()
                    ->count();
            }

$data = [
    'total' => $total,
    'bulan' => $bulantahun,
    'ojk' => $ojk
    ];


$this->unras = json_encode($data);
// dd($this->unras);

    }   

    public function render()
    {
        return view('dashboard.grafik')->extends('dashboard.home')->section('grafik');
    }



public function changeData()
{
        $dasar =  DB::table('unras')
  ->selectRaw('EXTRACT(YEAR_MONTH FROM tanggal) as dasar')
  ->distinct()
  ->latest()
  ->pluck('dasar');
         foreach ($dasar as $value) {
            $b[] = Str::substr($value, 4,2);
            $t[] = Str::substr($value, 0,4);
         }

    foreach ($b as $key => $bbb) {
                    $bulan []= UnrasModel::select(DB::raw("MONTHNAME(tanggal) as bulan"))
                    ->whereMonth('tanggal', $bbb)
                    ->latest()
                    ->distinct()
                    ->limit(12)
                    ->pluck('bulan');
    }
        foreach ($dasar as $but) {
            $vc = $but.'01';
     
            $bulantahun[] = Carbon::parse($vc)->format('F Y');
         }
  
            foreach ($b as $key => $v) {
                $total []= DB::table('unras')
                                    ->whereMonth('tanggal', $v)
                                    ->count();
                    }

        foreach ($b as $ojks) {
            $ojk [] = UnrasModel::whereMonth('tanggal','=', [$ojks])
                    ->where('tempat_kegiatan','LIKE', '%'.'ojk'.'%')
                    ->latest()
                    ->count();
            }

$data = [
    'total' => $total,
    'bulan' => $bulantahun,
    'ojk' => $ojk
    ];


$this->unras = json_encode($data);
$this->emit('berhasilUpdate', ['data' => $this->unras]);
}


}
