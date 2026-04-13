<?php
namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet;

class ItemsExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithCustomStartCell
{
    public function collection()
    {
        return Item::with('category')->get();
    }

    // Tabel dimulai dari baris ke-4 (karena baris 1 & 2 untuk judul)
    public function startCell(): string
    {
        return 'A4';
    }

    public function headings(): array
    {
        return [
            'Category',
            'Name Item',
            'Total',
            'Repair Total',
            'Last Updated',
        ];
    }

    public function map($item): array
    {
        return [
            $item->category->name,
            $item->name,
            $item->total,
            $item->repair == 0 ? '-' : $item->repair,
            $item->updated_at->format('M d, Y'),
        ];
    }

    // Bagian untuk membuat Judul di baris paling atas
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Judul Utama (Baris 1)
                $event->sheet->mergeCells('A1:E1');
                $event->sheet->setCellValue('A1', 'DAFTAR ITEMS INVENTARIS');
                
                // Tanggal Cetak (Baris 2)
                $event->sheet->mergeCells('A2:E2');
                $event->sheet->setCellValue('A2', 'Dicetak pada: ' . now()->format('d F Y H:i:s'));

                // Style Judul agar Bold dan Tengah
                $styleHeader = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                ];

                $event->sheet->getStyle('A1')->applyFromArray($styleHeader);
                $event->sheet->getStyle('A2')->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Style untuk Header Tabel (Baris 4)
                $event->sheet->getStyle('A4:E4')->getFont()->setBold(true);
            },
        ];
    }
}