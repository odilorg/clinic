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
        Schema::create('lab_test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_test_id')->constrained('lab_tests')->cascadeOnDelete(); // Link to lab test
            $table->string('parameter_name'); // Parameter name (e.g., Hemoglobin)
            $table->string('result'); // The result (e.g., 13.5 g/dL)
            $table->string('unit')->nullable(); // Unit of measurement (e.g., g/dL)
            $table->string('image_path')->nullable(); // Optional image for the result
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_test_results');
    }
};
