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
        Schema::create('tshirt_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tshirt_id');
            $table->foreign('tshirt_id')->references('id')->on('tshirts')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('cost');
            $table->datetime('stocked_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tshirt_stocks');
    }
};
