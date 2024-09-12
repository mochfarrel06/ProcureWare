<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_request_id',
        'processed_by',
        'purchase_date',
        'expected_delivery_date',
        'total_price',
        'status',
    ];

    // Relasi dengan PurchaseRequest
    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }

    // Relasi dengan User (untuk processed_by)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function delivery()
    {
        return $this->hasMany(Delivery::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
