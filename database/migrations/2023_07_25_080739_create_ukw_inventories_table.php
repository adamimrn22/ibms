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
        Schema::create('ukw_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('current_quantity');
            $table->integer('stock');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->timestamps();

            $table->foreign('subcategory_id')
            ->references('id')
            ->on('subcategory')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('status_id')
            ->references('id')
            ->on('statuses')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukw_inventories');
    }
};
