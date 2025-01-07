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
        Schema::table('tshirts', function (Blueprint $table) {
            $table->string('price');
            $table->string('cost_price')->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tshirts', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('cost_price');
        });
    }
};
