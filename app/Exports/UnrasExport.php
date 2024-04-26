<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use App\Models\UnrasModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class UnrasExport implements FromView, ShouldAutoSize, WithStyles, WithDrawings
{

    public function __construct($start , $end, $count, $cariin)
    {
        $this->start = $start;
        $this->end = $end;
        $this->count = $count;
        $this->cariin = $cariin;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('OJK');
        $drawing->setDescription('Otoritas Jasa Keuangan');
        $drawing->setPath(public_path('storage/img/logo-ojk.png'));
        $drawing->setWidth(133);
        $drawing->setCoordinates('B2');

        return $drawing;
    }

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
       $cariin = $this->cariin;

            if ($cariin != null){

                $unras = UnrasModel::where('tempat_kegiatan','LIKE', '%'.$cariin.'%')
                    ->whereBetween('tanggal', [$start, $end])
                    ->orwhere(function ($query) use ($cariin,$start,$end) {
                        $query->where('pelaksana','LIKE', '%'.$cariin.'%')
                            ->whereBetween('tanggal', [$start, $end]);
                    })
                    ->orderBy('tanggal', 'ASC')
                    ->orderBy('waktu', 'ASC')
                    ->paginate(100000)
                    ->appends(request()->input());
                    
                } else { 
                
                    $cariin = '';
                $unras = UnrasModel::whereBetween('tanggal', [$start, $end])
                    ->orderBy('tanggal', 'ASC')
                    ->orderBy('waktu', 'ASC')
                    ->paginate(100000)
                    ->appends(request()->input());
            }

         return view('unras.saveexcel', compact('unras','start','end','cariin'));       
    }
}

