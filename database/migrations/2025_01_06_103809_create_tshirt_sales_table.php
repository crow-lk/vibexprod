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
        Schema::create('tshirt_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tshirt_id'); // Unsigned for foreign key compatibility
            $table->integer('quantity')->unsigned(); // Ensure positive values for quantity
            $table->decimal('total_price', 10, 2); // Set precision for decimal values
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint
            $table->foreign('tshirt_id')
                ->references('id')
                ->on('tshirts')
                ->onDelete('cascade'); // Cascade delete to remove related sales if a supplement is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tshirt_sales');
    }
};
