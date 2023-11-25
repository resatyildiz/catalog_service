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
        // This update includes added price and quantity columns
        Schema::table("order_items", function (Blueprint $table) {
            $table->decimal("price", 10, 2)->required();
            $table->integer("quantity")->required();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table("order_items", function (Blueprint $table) {
            $table->dropColumn("price");
            $table->dropColumn("quantity");
        });
    }
};
