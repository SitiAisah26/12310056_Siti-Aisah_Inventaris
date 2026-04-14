<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CategoryExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Category::all()->map(function ($category, $index) {
            return [
                'No' => $index + 1,
                'Nama Kategori' => $category->name,
                // Tambahkan kolom lain jika perlu, contoh:
                'Tanggal Dibuat' => $category->created_at->format('d-m-Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            "No",
            "Nama Kategori",
            "Tanggal Dibuat"
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Menambahkan baris kosong di paling atas untuk Judul
                $event->sheet->insertNewRowBefore(1, 1);
                
                // Set teks judul di sel A1
                $event->sheet->setCellValue('A1', 'Data Kategori Barang Inventaris');

                // Merge cell dari A1 sampai C1 (sesuai jumlah kolom)
                $event->sheet->mergeCells('A1:C1');

                // Styling Judul
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                    ],
                ]);

                // Opsional: Menebalkan header kolom (baris ke-2 sekarang)
                $event->sheet->getStyle('A2:C2')->getFont()->setBold(true);
            },
        ];
    }
}