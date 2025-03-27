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
        Schema::create('medication', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_Id')->constrained('patients')->onDelete('Cascade')->onUpdate('Cascade');
            $table->date('date');
            $table->string('medication');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication');
    }
};
