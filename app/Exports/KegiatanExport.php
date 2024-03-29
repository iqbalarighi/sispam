<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use App\Models\KegiatanModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KegiatanExport implements FromView, ShouldAutoSize, WithStyles
{

    public function __construct($start , $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);

    }

    public function view(): View
    {  
        $level = Auth::user()->level;
        $gd = Auth::user()->lokasi_tugas;

       $start = $this->start;
       $end = $this->end;

        if ($level == 'koordinator'){
            if ($gd == '2') {
            $giats = KegiatanModel::with('site')
                    ->whereBetween('tanggal', [$start, $end])
                    ->where('gedung','=', $gd)
                    ->orwhere(function ($query) use ($start , $end){
                        $query->where('gedung', '=', '16')
                        ->where('danru','=', 'Andri Triana')
                        ->whereBetween('tanggal', [$start, $end]);
                    })
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);
            } elseif ($gd == '11') {
            $giats = KegiatanModel::with('site')
                    ->whereBetween('tanggal', [$start, $end])
                    ->where('gedung','=', $gd)
                    ->orwhere(function ($query) use ($start , $end){
                        $query->where('gedung', '=', '16')
                        ->where('danru','=', 'Rizal Kurnia')
                        ->whereBetween('tanggal', [$start, $end]);
                    })
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);
            } elseif ($gd == '13') {
             $giats = KegiatanModel::with('site')
            ->whereBetween('tanggal', [$start, $end])
            ->where('gedung','=', $gd)
            ->orwhere(function ($query) use ($start , $end){
                $query->whereIn('gedung', ['14','15'])
                    ->whereBetween('tanggal', [$start, $end]);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(100000);   
        } else {
            $giats = KegiatanModel::with('site')
            ->whereBetween('tanggal', [$start, $end])
            ->where('gedung','=', $gd)
            ->orderBy('created_at', 'DESC')
            ->paginate(100000);
        }
            
        } else {
            $giats = KegiatanModel::with('site')
                    ->whereBetween('tanggal', [$this->start, $this->end])
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);
        }
                

    return view('kegiatan.saveexcel', ['giats' => $giats]);
    }
}