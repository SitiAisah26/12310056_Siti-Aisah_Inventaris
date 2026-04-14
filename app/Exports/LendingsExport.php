<?php

namespace App\Exports;

use App\Models\Lending;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LendingsExport implements FromCollection, WithHeadings, WithEvents
{
    public function collection()
    {
        return Lending::with('item')->get()->map(function ($lending, $index) {
            return [
                'No' => $index + 1,
                'Nama Barang' => $lending->item->name ?? 'Barang Terhapus',
                'Peminjam' => $lending->name,

                // ✅ tanggal + jam pinjam
                'Tanggal Pinjam' => Carbon::parse($lending->date_time)->format('d-m-Y H:i'),

                // ✅ tanggal + jam kembali
                'Tanggal Kembali' => $lending->return_date
                    ? Carbon::parse($lending->return_date)->format('d-m-Y H:i')
                    : '-',

                'Status' => $lending->is_returned ? 'Sudah Kembali' : 'Belum Kembali',
            ];
        });
    }

    public function headings(): array
    {
        return [
            "No",
            "Nama Barang",
            "Peminjam",
            "Tanggal Pinjam",
            "Tanggal Kembali",
            "Status"
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->setCellValue('A1', 'Data Peminjaman Inventaris');

                $event->sheet->mergeCells('A1:F1');
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                    ],
                ]);
            },
        ];
    }
}