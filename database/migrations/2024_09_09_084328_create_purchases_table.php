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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_request_id');
            $table->unsignedBigInteger('user_id');

            $table->date('purchase_date')->nullable();
            $table->date('expected_delivery_date')->nullable();
            $table->decimal('price_per_unit', 20, 2);
            $table->decimal('total_price', 20, 2)->nullable();
            $table->enum('status', ['in_process', 'delivered', 'canceled'])->default('in_process');

            $table->timestamps();
            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
