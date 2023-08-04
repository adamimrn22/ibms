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
        Schema::create('ukw_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable();
            $table->integer('quantity');
            $table->integer('approved_quantity')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('inventory_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('inventory_id')
            ->references('id')
            ->on('ukw_inventories')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('status_id')
            ->references('id')
            ->on('booking_statuses')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukw_bookings');
    }
};
