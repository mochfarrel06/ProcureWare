<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WarehouseExport implements FromCollection, WithHeadings
{
    protected $deliveryItems;

    public function __construct($deliveryItems)
    {
        $this->deliveryItems = $deliveryItems;
    }

    public function collection()
    {
        return $this->deliveryItems->map(function ($deliveryItem, $index) {
            return [
                'No' => $index + 1,
                'nama_material' => $deliveryItem->delivery->purchase->purchaseRequest->material->name,
                'kode_material' => $deliveryItem->delivery->purchase->purchaseRequest->material->code,
                'tgl_kedatangan' => \Carbon\Carbon::parse($deliveryItem->arrival_date)->locale('id')->isoFormat('D MMMM YYYY'), // Mengambil nama barang dari relasi item_type
                'nama_supplier' => $deliveryItem->delivery->purchase->purchaseRequest->supplier->name,
                'jumlah' => $deliveryItem->quantity,
                'lokasi_penyimpanan' => $deliveryItem->storage_location
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Material',
            'Kode Material',
            'Tanggal Kedatangan',
            'Nama Supplier',
            'Jumlah',
            'Lokasi Penyimpanan'
        ];
    }
}
