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
        Schema::create('block_details', function (Blueprint $table) {
            $table->id();
            $table->string('blockId')->reference('id')->on('blocks');
            $table->string('hotelId')->reference('id')->on('hotels');
            $table->boolean('deleteFlag')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_details');
    }
};
