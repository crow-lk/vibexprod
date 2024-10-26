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
        Schema::create('Supplements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
$table->string('price');
$table->string('available_qty');
$table->longText('image');
$table->string('description');
$table->timestamps();
$table->softDeletes();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('Supplements');
    }
};
