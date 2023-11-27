<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This migration includes the following changes:
     * - Add `sale_channel_slug` column to `sale_channel_items` table as foreign key
     * - Remove `sale_channel_id` column from `sale_channel_items` table
     */
    public function up(): void
    {
        Schema::table('sale_channel_items', function (Blueprint $table) {
            $table->string('sale_channel_slug')->nullable()->after('id');
            $table->foreign('sale_channel_slug')->references('slug')->on('sale_channels')->onDelete('cascade');

            $table->dropForeign(['sale_channel_id']);
            $table->dropColumn('sale_channel_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('sale_channel_items', function (Blueprint $table) {
            $table->dropForeign(['sale_channel_slug']);
            $table->dropColumn('sale_channel_slug');

            $table->foreignId('sale_channel_id')->constrained()->default(1)->after('id');
        });

    }
};
