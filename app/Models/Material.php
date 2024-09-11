<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'description'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
