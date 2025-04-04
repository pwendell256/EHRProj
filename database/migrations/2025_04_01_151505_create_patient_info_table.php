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
        Schema::create('patient_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_Id')->constrained('patients')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('registration_no')->nullable(); 
            $table->string('religion')->nullable(); 
            $table->text('address')->nullable(); 
            $table->date('admission_date')->nullable(); 
            $table->string('diagnosis')->nullable(); 
            $table->string('other_diagnoses')->nullable(); 
            $table->string('allergies')->nullable();
            $table->string('reaction')->nullable();
            $table->string('emergency_name')->nullable(); 
            $table->string('emergency_relationship')->nullable(); 
            $table->text('emergency_address')->nullable(); 
            $table->string('emergency_phone')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_info');
    }
};
