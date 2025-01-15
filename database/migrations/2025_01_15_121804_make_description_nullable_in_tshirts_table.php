<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeDescriptionNullableInTshirtsTable extends Migration
{
    public function up()
    {
        Schema::table('tshirts', function (Blueprint $table) {
            $table->string('description')->nullable()->change(); // Make description nullable
        });
    }

    public function down()
    {
        Schema::table('tshirts', function (Blueprint $table) {
            $table->string('description')->nullable(false)->change(); // Revert to not nullable if needed
        });
    }
};
