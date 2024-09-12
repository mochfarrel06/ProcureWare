<?php

namespace App\Exports;

use App\Models\Purchase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DetailedReportExport implements FromCollection, WithHeadings
{
    protected $purchases;

    public function __construct($purchases)
    {
        $this->purchases = $purchases;
    }

    public function collection()
    {
        return $this->purchases;
    }

    public function headings(): array
    {
        return [
            'Purchase ID',
            'Material Name',
            'Supplier',
            'Quantity',
            'Price Per Unit',
            'Total Price',
            'Status',
            'Purchase Date'
        ];
    }
}
