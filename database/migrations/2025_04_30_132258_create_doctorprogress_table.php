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
        Schema::create('doctorprogress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_Id')->constrained('patients')->onDelete('Cascade')->onUpdate('Cascade');
            $table->text('introduction')->nullable();
            $table->text('history')->nullable();
            $table->text('presentation')->nullable();
            $table->text('mood')->nullable();
            $table->text('social')->nullable();
            $table->text('physical')->nullable();
            $table->text('plan')->nullable();
            $table->text('closing')->nullable();
            $table->text('pracName')->nullable();
            $table->text('clinicAddress')->nullable();
            $table->text('soap_subjective')->nullable();
            $table->text('soap_objective')->nullable();
            $table->text('soap_assessment')->nullable();
            $table->text('soap_plan')->nullable();
            $table->text('birp_behavior')->nullable();
            $table->text('birp_intervention')->nullable();
            $table->text('birp_response')->nullable();
            $table->text('birp_plan')->nullable();
            $table->text('dap_data')->nullable();
            $table->text('dap_assessment')->nullable();
            $table->text('dap_plan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctorprogress');
    }
};
