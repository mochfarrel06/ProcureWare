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
            $table->unsignedBigInteger('delivery_id');
            $table->unsignedBigInteger('supplier_id');

            $table->date('arrival_date');
            $table->integer('quantity'); // Jumlah material yang diterima
            $table->enum('condition', ['good', 'bad']); // Kondisi barang
            $table->string('unique_code')->unique(); // Nomor unik atau barcode
            $table->string('storage_location'); // Lokasi penyimpanan di gudang

            $table->timestamps();
            $table->foreign('delivery_id')->references('id')->on('deliveries')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
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
