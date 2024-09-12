<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchaseOrderExport implements FromCollection, WithHeadings
{
    protected $purchases;

    public function __construct($purchases)
    {
        $this->purchases = $purchases;
    }

    public function collection()
    {
        return $this->purchases->map(function ($purchase, $index) {
            return [
                'No' => $index + 1,
                'nama_material' => $purchase->purchaseRequest->material->name,
                'kode_material' => $purchase->purchaseRequest->material->code,
                'supplier' => $purchase->purchaseRequest->supplier->name,
                'tgl_pembelian' => \Carbon\Carbon::parse($purchase->purchase_date)->locale('id')->isoFormat('D MMMM YYYY'), // Mengambil nama barang dari relasi item_type
                'tgl_batas_diterima' => \Carbon\Carbon::parse($purchase->expected_delivery_date)->locale('id')->isoFormat('D MMMM YYYY'), // Mengambil nama barang dari relasi item_type
                'harga_satuan' => $purchase->price_per_unit,
                'harga_total' => $purchase->total_price,
                'jumlah' => $purchase->purchaseRequest->quantity
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Material',
            'Kode Material',
            'Supplier',
            'Tanggal Pembelian',
            'Tanggal Batas Diterima',
            'Harga Satuan',
            'Harga Total',
            'Jumlah'
        ];
    }
}
