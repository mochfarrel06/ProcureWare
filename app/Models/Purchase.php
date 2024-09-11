<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'material_id',
        'supplier_id',
        'purchase_date',
        'quantity',
        'approval_status',
        'approved_date'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function warehouseItems()
    {
        return $this->hasMany(WarehouseItem::class);
    }
}
