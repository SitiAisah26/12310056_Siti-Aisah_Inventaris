<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ItemsExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    public function collection()
    {
        return Item::with('category')->get();
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
            $item->updated_at->format('M d, Y H:i'), // ✅ sudah pakai jam
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function($event) {
                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->setCellValue('A1', 'Data Items Inventaris');
                $event->sheet->mergeCells('A1:E1');

                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                    ],
                ]);
                
                $event->sheet->getStyle('A2:E2')->getFont()->setBold(true);
            },
        ];
    }
}