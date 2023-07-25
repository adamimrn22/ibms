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
        Schema::create('ukw_inventory_images', function (Blueprint $table) {
            $table->unsignedBigInteger('inventories_id')->nullable();
            $table->string('parent_folder');
            $table->string('path');
            $table->timestamps();

            $table->foreign('inventories_id')
            ->references('id')
            ->on('ukw_inventories')
            ->onUpdate('cascade')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukw_inventory_images');
    }
};
