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
        Schema::create('upsm_ruang_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->date('date_book_start');
            $table->date('date_book_end');
            $table->time('time_start');
            $table->time('time_end');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('upsm_inventories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

                $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('status_id')->references('id')->on('booking_statuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upsm_ruang_bookings');
    }
};
