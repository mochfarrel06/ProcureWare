<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'report_type',
        'report_date',
    ];

    // Relasi ke tabel purchases
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
