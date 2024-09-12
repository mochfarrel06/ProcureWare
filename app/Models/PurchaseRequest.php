<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;
    protected $table = 'purchase_requests';
    protected $fillable = [
        'user_id',
        'material_id',
        'supplier_id',
        'quantity',
        'status',
        'request_date',
    ];

    // Relasi ke staff (user) yang melakukan permintaan pembelian
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke material
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    // Relasi ke supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Scope untuk mengambil permintaan yang statusnya pending
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope untuk mengambil permintaan yang disetujui
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Scope untuk mengambil permintaan yang ditolak
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
