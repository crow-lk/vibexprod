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
        Schema::create('supplement_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplement_id');
            $table->foreign('supplement_id')->references('id')->on('supplements')->onDelete('cascade');
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
    public function down()
    {
        Schema::dropIfExists('supplement_stocks');
    }
};
