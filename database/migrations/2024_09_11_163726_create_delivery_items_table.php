<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delivery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_id')->constrained('deliveries'); // Terkait dengan penerimaan
            $table->foreignId('material_id')->constrained('materials'); // Material yang diterima
            $table->foreignId('supplier_id')->constrained('suppliers'); // Supplier yang memberikan barang
            $table->integer('quantity'); // Jumlah material yang diterima
            $table->enum('condition', ['good', 'bad']); // Kondisi barang
            $table->string('unique_code')->unique(); // Nomor unik atau barcode
            $table->string('storage_location'); // Lokasi penyimpanan di gudang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_items');
    }
};
