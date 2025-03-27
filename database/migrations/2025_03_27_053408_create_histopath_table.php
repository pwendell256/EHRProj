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
        Schema::create('histopath', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_Id')->constrained('patients')->onDelete('Cascade')->onUpdate('Cascade');
            $table->dateTime('dateTime');
            $table->string('testType');
            $table->string('result');
            $table->string('path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histopath');
    }
};
