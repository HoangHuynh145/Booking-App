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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->references('id')->on('users');
            $table->string('hotel')->references('id')->on('hotels');
            $table->bigInteger('price');
            $table->bigInteger('tax');
            $table->bigInteger('totalPayment');
            $table->boolean('deleteFlag')->default(false);
            $table->datetime('checkInTime');
            $table->datetime('checkOutTime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
