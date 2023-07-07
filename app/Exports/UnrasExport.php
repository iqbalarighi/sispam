<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use App\Models\UnrasModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UnrasExport implements FromView, ShouldAutoSize, WithStyles
{

    public function __construct($start , $end, $count)
    {
        $this->start = $start;
        $this->end = $end;
        $this->count = $count;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function styles(Worksheet $sheet)
    {   
        $count = $this->count+5;
        $sheet->getStyle('A5:N'.$count)->getAlignment()->setWrapText(true);
        $sheet->getStyle('A2')->getFont()->setSize(16);
        $sheet->getStyle('A1:N5')->getFont()->setBold(true);
        $sheet->getStyle('A5:N5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('D3D3D3');
        $sheet->getStyle('A5:N'.$count)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }

    public function view(): View
    {  
       $start = $this->start;
       $end = $this->end;
       $user = Auth::user()->role;

                $unras = UnrasModel::whereBetween('tanggal', [$start, $end])
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);
                    $unras->appends(['start' => $start, 'end' => $end]);
                
    return view('unras.saveexcel', ['unras' => $unras,'start' => $start, 'end' => $end]);
    }
}

