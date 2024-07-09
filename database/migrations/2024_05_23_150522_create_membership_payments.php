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
        Schema::create('membership_payments', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('plan_name')->nullable();
            $table->string('additional_services')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->text('note')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamps();

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_payments');
    }
};
