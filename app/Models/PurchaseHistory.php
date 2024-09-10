<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'status',
        'note',
        'user_id',
    ];

    /**
     * Get the purchase that owns the PurchaseHistory.
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * Get the user that owns the PurchaseHistory.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
