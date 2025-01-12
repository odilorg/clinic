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
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['illness', 'surgery', 'allergy'])->index();
            $table->string('name');
            $table->date('date')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('hospital_name')->nullable();
            $table->text('notes')->nullable();
            $table->string('medications')->nullable();
            $table->enum('status', ['active', 'resolved'])->default('active');
            $table->enum('severity', ['mild', 'moderate', 'severe'])->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_histories');
    }
};
