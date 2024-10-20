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
        Schema::create('membership_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('subscription_id')->constrained('subscription')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('amount', 8, 2)->default(0);
            $table->enum('payment_status', ['pending', 'paid','not_paid'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('membership_subscriptions');
    }
};
