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
        Schema::create('iostime', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ios_Id')->constrained('ios')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('time')->nullable();
            $table->string('source')->nullable();
            $table->string('amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iostime');
    }
};
