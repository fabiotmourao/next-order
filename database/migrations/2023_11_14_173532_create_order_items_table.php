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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->integer('index');
            $table->uuid('item_id_external');
            $table->uuid('uniqueId');
            $table->string('name');
            $table->string('unit');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('options_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
