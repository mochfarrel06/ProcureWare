<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'contact',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function warehouseItems()
    {
        return $this->hasMany(WarehouseItem::class);
    }
}
