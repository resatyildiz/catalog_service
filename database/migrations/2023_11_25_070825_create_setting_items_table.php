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
        Schema::create('setting_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable()->default(null);
            $table->string('value')->nullable()->default(null);
            $table->boolean('status')->default(true);
            $table->foreignId('setting_id')->constrained('settings');
            $table->boolean('is_required')->default(false);
            $table->foreignId('media_id')->nullable()->constrained('media');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_items');
    }
};
