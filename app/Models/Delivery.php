<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'user_id',
        'delivery_date',
    ];

    /**
     * Get the purchase associated with the delivery.
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * Get the user who received the delivery.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the delivery items associated with the delivery.
     */
    public function deliveryItems()
    {
        return $this->hasMany(DeliveryItem::class);
    }
}
