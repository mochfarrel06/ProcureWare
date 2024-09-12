<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'delivery_id',
        'supplier_id',
        'arrival_date',
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

    // Relationship to Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
