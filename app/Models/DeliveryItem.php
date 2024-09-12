<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'delivery_id',
        'material_id',
        'supplier_id',
        'quantity',
        'condition',
        'unique_code',
        'storage_location',
    ];

    // Relationship to Delivery
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    // Relationship to Material
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    // Relationship to Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
