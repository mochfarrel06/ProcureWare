<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'material_name',
        'material_code',
        'arrival_date',
        'supplier_id',
        'quantity',
        'storage_location',
        'condition',
        'unique_number',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
