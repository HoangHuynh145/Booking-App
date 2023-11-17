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
        Schema::create('payment_information', function (Blueprint $table) {
            $table->id();
            $table->string('cardNumber');
            $table->date('expDate');
            $table->string('CVC');
            $table->string('nameOnCard');
            $table->string('country');
            $table->string('userId')->references('id')->on('users');
            $table->boolean('deleteFlag')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_information');
    }
};
