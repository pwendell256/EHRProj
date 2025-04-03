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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_Id')->constrained('patients')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('conductor')->nullable();
            $table->date('date')->nullable()->default(null);
            $table->string('time')->nullable();
            $table->string('orientation_level')->nullable()->default('Alert');
            $table->string('person')->nullable();
            $table->string('place')->nullable();
            $table->string('situation')->nullable();
            
            // Vitals
            $table->string('temperature')->nullable()->default('Warm');
            $table->string('blood_pressure')->nullable();
            $table->string('respiratory_rate')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('oxygen_saturation')->nullable();
            
            // Head assessment
            $table->string('hair')->nullable();
            $table->string('eyes')->nullable();
            $table->boolean('perrla')->nullable()->default(false);
            $table->string('nose')->nullable();
            $table->string('ears')->nullable();
            $table->string('mouth')->nullable();
            $table->boolean('midline_tongue')->nullable()->default(false);
            $table->boolean('moist')->nullable()->default(false);
            $table->boolean('lesions')->nullable()->default(false);
            $table->boolean('dentition')->nullable()->default(false);
            
            // Neck/Chest
            $table->boolean('carotid_pulse')->nullable()->default(false);
            $table->boolean('jugular_vein_distention')->nullable()->default(false);
            $table->boolean('trachea_midline')->nullable()->default(false);
            $table->boolean('muffled')->nullable()->default(false);
            $table->boolean('arrhythmia')->nullable()->default(false);
            $table->boolean('anterior')->nullable()->default(false);
            $table->boolean('posterior')->nullable()->default(false);
            $table->boolean('lateral')->nullable()->default(false);
            $table->boolean('chest_symmetry')->nullable()->default(false);
            
            // Skin and abdomen
            $table->boolean('skin_turgor')->nullable()->default(false);
            $table->string('inspection')->nullable();
            $table->string('palpation')->nullable();
            $table->string('auscultation')->nullable();
            $table->string('luq')->nullable()->default('Active'); // Left Upper Quadrant
            $table->string('ruq')->nullable()->default('Active'); // Right Upper Quadrant
            $table->string('llq')->nullable()->default('Active'); // Left Lower Quadrant
            $table->string('rlq')->nullable()->default('Active'); // Right Lower Quadrant
            
            // Extremities
            $table->string('radial_pulses')->nullable();
            $table->string('radial_other')->nullable();
            $table->string('temperaturetrunk')->nullable();
            $table->string('grip')->nullable();
            $table->string('capillary_refill')->nullable();
            $table->boolean('hair_present')->nullable()->default(false);
            $table->string('edema')->nullable();
            $table->string('foot_strength')->nullable();
            
            // Nails
            $table->boolean('yellowed')->nullable()->default(false);
            $table->boolean('thickened')->nullable()->default(false);
            $table->boolean('ingrown')->nullable()->default(false);
            
            // Musculoskeletal
            $table->string('upper_r1')->nullable();
            $table->string('upper_r2')->nullable();
            $table->string('upper_l1')->nullable();
            $table->string('upper_l2')->nullable();
            $table->string('lower_r1')->nullable();
            $table->string('lower_r2')->nullable();
            $table->string('lower_l1')->nullable();
            $table->string('lower_l2')->nullable();
            $table->string('sensation')->nullable();
            
            // Measurements
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();
            $table->decimal('bmi', 8, 2)->nullable();
            
            // Pain assessment
            $table->string('type')->nullable();
            $table->integer('intensity')->nullable()->default(1);
            $table->string('location')->nullable();
            $table->string('duration')->nullable();
            $table->string('characteristics')->nullable();
            $table->string('precipitation')->nullable();
            $table->string('frequency')->nullable();
            $table->string('nonverbals')->nullable();
            $table->string('relief_factors')->nullable();
            $table->string('sleep')->nullable();
            $table->text('description')->nullable();
                        
            // Basic info


            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
