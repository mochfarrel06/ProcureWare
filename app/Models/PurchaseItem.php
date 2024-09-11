<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_id', 'material_id', 'quantity', 'price_per_unit'];

    // Relasi dengan tabel Purchase
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    // Relasi dengan tabel Material
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
