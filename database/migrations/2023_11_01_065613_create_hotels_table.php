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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description', 1000);
            $table->string('slug');
            $table->integer('level');
            $table->float('stars')->default(0);
            $table->integer('countRating')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('numberRoom');
            $table->integer('totalSold')->default(0);
            $table->boolean('deleteFlag')->default(false);
            $table->string('location');
            $table->boolean('isTop')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
