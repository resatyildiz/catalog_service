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
        Schema::create('sale_channel_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_channel_id')->constrained()->default(1);
            $table->foreignId('sale_channel_item_group_id')->constrained()->default(1);
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_channel_items');
    }
};
