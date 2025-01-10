<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSizeIdToTshirtSalesTable extends Migration
{
    public function up()
    {
        Schema::table('tshirt_sales', function (Blueprint $table) {
            $table->unsignedBigInteger('size_id')->nullable();// Add foreign key
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
            $table->dropColumn('size'); // Remove the old size column
        });
    }

    public function down()
    {
        Schema::table('tshirt_sales', function (Blueprint $table) {
            $table->dropForeign(['size_id']); // Drop foreign key
            $table->string('size'); // Re-add the old size column
        });
    }
}
