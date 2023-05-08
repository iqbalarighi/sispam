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
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('B1')->getFont()->setBold(true);
        $sheet->getStyle('C1')->getFont()->setBold(true);
        $sheet->getStyle('D1')->getFont()->setBold(true);
        $sheet->getStyle('E1')->getFont()->setBold(true);
        $sheet->getStyle('F1')->getFont()->setBold(true);
        $sheet->getStyle('G1')->getFont()->setBold(true);
    }

    public function view(): View
    {
        $user = Auth::user()->role;

                $giats = kegiatanModel::with('site')
                    ->whereBetween('tanggal', [$this->start, $this->end])
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);

    return view('kegiatan.saveexcel', ['giats' => $giats]);
    }
}