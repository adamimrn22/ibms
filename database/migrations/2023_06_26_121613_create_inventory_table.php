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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('attribute');
            $table->string('quantity');
            $table->string('stock');
            $table->string('location');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->timestamps();

            $table->foreign('subcategory_id')
            ->references('id')
            ->on('subcategory')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};