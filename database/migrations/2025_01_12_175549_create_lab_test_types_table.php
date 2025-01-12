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
        Schema::create('lab_test_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Test type name (e.g., Blood Test)
            $table->json('parameters'); // Parameters (e.g., ["Hemoglobin", "Glucose"])
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_test_types');
    }
};
