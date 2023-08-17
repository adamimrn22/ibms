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
        Schema::create('upsm_vehicle_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->date('dateGo');
            $table->date('dateReturn');
            $table->time('timeGo');
            $table->time('timeReturn');
            $table->text('destination');
            $table->text('objective');
            $table->text('remark')->nullable();
            $table->boolean('vehicle_type');
            $table->boolean('driver');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('car_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('car_id')->references('id')->on('upsm_inventories')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->foreign('status_id')->references('id')->on('booking_statuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });

        Schema::create('upsm_vehicle_bookings_user', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('upsm_vehicle_bookings')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upsm_vehicle_bookings_user');
        Schema::dropIfExists('upsm_vehicle_bookings');
    }
};
