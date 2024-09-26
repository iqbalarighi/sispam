<?php

namespace App\Exports;

use App\Models\LayananModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LayananExport implements FromView, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

     public function __construct($start, $end, $count)
    {
        $this->start = $start;
        $this->end = $end;
        $this->count = $count;
    }

public function styles(Worksheet $sheet)
    {
        $count = $this->count+1;
        $sheet->setAutoFilter('B1:I'.$count);
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A1:I'.$count)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1:A'.$count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E2:E'.$count)->getAlignment()->setWrapText(true); 
        $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('D3D3D3');
        $sheet->getStyle('A1:I'.$count)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }

public function view(): View
    {  
       $start = $this->start;
       $end = $this->end;

        $layan = LayananModel::whereBetween('tanggal', [$start, $end])
                    ->orderBy('created_at', 'ASC')
                    ->paginate(100000);

    return view('layanan.saveexcel', compact('layan'));
    }

}
