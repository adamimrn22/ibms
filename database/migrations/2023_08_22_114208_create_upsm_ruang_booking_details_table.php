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
        Schema::create('upsm_ruang_booking_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->string('objective');
            $table->boolean('laptop');
            $table->boolean('lcd');
            $table->boolean('food');
            $table->enum('food_time', ['PAGI', 'TENGAH HARI', 'PETANG'])->nullable();

            $table->foreign('booking_id')->references('id')->on('upsm_ruang_bookings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upsm_ruang_booking_details');
    }
};
