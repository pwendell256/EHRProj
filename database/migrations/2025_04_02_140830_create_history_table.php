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
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_Id')->constrained('patients')->onDelete('Cascade')->onUpdate('Cascade');
            $table->longtext('history')->nullable();
            $table->longtext('past')->nullable();
            $table->longtext('family')->nullable();
            $table->longtext('birth')->nullable();
            $table->longtext('environment')->nullable();
            $table->longtext('dietary')->nullable();
            $table->longtext('review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
