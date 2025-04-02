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
        Schema::create('lab_diagnosis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_Id')->constrained('patients')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('wbc')->nullable();
            $table->string('rbc')->nullable();
            $table->string('hemoglobin')->nullable();
            $table->string('hematocrit')->nullable();
            $table->string('mcv')->nullable();
            $table->string('mch')->nullable();
            $table->string('mchc')->nullable();
            $table->string('rbc_width')->nullable();
            $table->string('platelet_count')->nullable();
            $table->string('neutrophils')->nullable();
            $table->string('lymphocytes')->nullable();
            $table->string('monocytes')->nullable();
            $table->string('eosinophils')->nullable();
            $table->string('basophils')->nullable();
            $table->text('chest_pa')->nullable();
            $table->text('impression')->nullable();
            $table->text('advice')->nullable();
            $table->string('advice_path')->nullable();
            $table->date('uri_date')->nullable();
            $table->time('uri_time')->nullable();
            $table->string('transparency')->nullable();
            $table->string('color')->nullable();
            $table->string('sp_gravity')->nullable();  
            $table->string('ph')->nullable();  
            $table->string('protein')->nullable();  
            $table->string('glucose')->nullable();  
            $table->string('bilirubin')->nullable(); 
            $table->string('ery_hb')->nullable();  
            $table->string('leukocytes')->nullable();  
            $table->string('nitrite')->nullable();  
            $table->string('urobilinogen')->nullable();  
            $table->string('ketone')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_diagnosis');
    }
};
