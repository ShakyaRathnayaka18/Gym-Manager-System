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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('registration_number')->unique();
            $table->string('rfid_code')->nullable();
            $table->string('email')->unique();
            $table->date('date_of_birth');
            $table->date('date_of_register')->default(DB::raw('CURRENT_DATE'));
            $table->string('contact');
            $table->string('gender');
            $table->unsignedBigInteger('plan_id'); // Foreign key column
            $table->string('other_services')->nullable();
            $table->string('height');
            $table->string('status');
            $table->timestamps();
        
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
