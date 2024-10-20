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
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membership_subscription_id')
                  ->constrained('membership_subscriptions')
                  ->onDelete('cascade'); // Foreign key to membership subscriptions
            $table->decimal('amount', 10, 2)->default(0);
            $table->datetime('start_date');
            $table->datetime('next_pament_date');
            $table->timestamps();
            $table->softDeletes();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('subscription_payments');
    }
};
