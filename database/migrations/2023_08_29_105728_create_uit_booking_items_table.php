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
        Schema::create('uit_booking_items', function (Blueprint $table) {
            $table->id();
            $table->text('objective');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

        });

        Schema::create('uit_booking_items_inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('inventory_id');

            $table->foreign('booking_id')
                ->references('id')
                ->on('uit_booking_items')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('inventory_id')
                ->references('id')
                ->on('uit_inventories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uit_booking_items');
    }
};
