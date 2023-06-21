<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use App\Models\KejadianModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KejadianExport implements FromView, ShouldAutoSize, WithStyles
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
        $count = $this->count+1;
        $sheet->getStyle('P2:P'.$count)->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1:P1')->getFont()->setBold(true);
        $sheet->getStyle('A1:P1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('D3D3D3');
        $sheet->getStyle('A1:P'.$count)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }

    public function view(): View
    {  
       $start = $this->start;
       $end = $this->end;
       $gd = Auth::user()->lokasi_tugas;
       $user = Auth::user()->role;

        if (Auth::user()->level == 'koordinator') {
                if ($gd == '13') {
                $data = KejadianModel::with('site')
                    ->whereBetween('waktu_kejadian', [$start, $end])
                    ->where('lokasi_kejadian','=', $gd)
                    ->orwhere(function ($query) use ($start , $end){
                        $query->whereIn('lokasi_kejadian', ['14','15','1','3','4','5','6','7','8','9','10'])
                            ->whereBetween('waktu_kejadian', [$start, $end]);
                    })
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);

                    $data->appends(['start' => $start, 'end' => $end]);
                } elseif ($gd == '11') {
                        $data = KejadianModel::with('site')
                            ->whereBetween('waktu_kejadian', [$start, $end])
                            ->where('lokasi_kejadian','=', $gd)
                            ->orwhere(function ($query) use ($start , $end){
                                $query->where('lokasi_kejadian', '=', '16')
                                ->where('user_pelapor','=', 'Rizal Kurnia')
                                ->whereBetween('waktu_kejadian', [$start, $end]);
                            })
                            ->orderBy('created_at', 'DESC')
                            ->paginate(100000);

                    $data->appends(['start' => $start, 'end' => $end]);
                } elseif ($gd == '2') {
                        $data = KejadianModel::with('site')
                            ->whereBetween('waktu_kejadian', [$start, $end])
                            ->where('lokasi_kejadian','=', $gd)
                            ->orwhere(function ($query) use ($start , $end){
                                $query->where('lokasi_kejadian', '=', '16')
                                ->where('user_pelapor','=', 'Andri Triana')
                                ->whereBetween('waktu_kejadian', [$start, $end]);
                            })
                            ->orderBy('created_at', 'DESC')
                            ->paginate(100000);

                    $data->appends(['start' => $start, 'end' => $end]);
                } else {
                        $data = KejadianModel::with('site')
                            ->whereBetween('waktu_kejadian', [$start, $end])
                            ->where('lokasi_kejadian','=', $gd)
                            ->orderBy('created_at', 'DESC')
                            ->paginate(100000);

                    $data->appends(['start' => $start, 'end' => $end]);
                }
        } elseif ($user == 'admin') {
                $data = KejadianModel::with('site')
                    ->whereBetween('waktu_kejadian', [$start, $end])
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);
                    $data->appends(['start' => $start, 'end' => $end]);
        }
                
    return view('kejadian.saveexcel', ['data' => $data]);
    }
}

