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
        Schema::create('additional_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('number')->nullable();
            $table->string('amount');
            $table->decimal('note')->nullable();;
            $table->date('date')->default(now());
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_expenses');
    }
};
