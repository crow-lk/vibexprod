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
        Schema::table('members', function (Blueprint $table) {
            $table->string('nic')->after('name')->nullable(false); // Add 'nic' as a required field
            $table->string('email')->nullable()->change(); // Make 'email' nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('nic'); // Drop 'nic' column
            $table->string('email')->nullable(false)->change(); // Revert 'email' back to non-nullable
            //
        });
    }
};
