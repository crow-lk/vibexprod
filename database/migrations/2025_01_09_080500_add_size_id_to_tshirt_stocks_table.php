<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSizeIdToTshirtStocksTable extends Migration
{
    public function up()
    {
        Schema::table('tshirt_stocks', function (Blueprint $table) {
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade'); // Add size_id foreign key
            $table->dropColumn('size'); // Remove the old size column
        });
    }

    public function down()
    {
        Schema::table('tshirt_stocks', function (Blueprint $table) {
            $table->dropForeign(['size_id']); // Drop foreign key
            $table->string('size'); // Re-add the old size column
        });
    }
}
