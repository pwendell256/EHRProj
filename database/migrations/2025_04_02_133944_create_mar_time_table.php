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
        Schema::create('mar_time', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mar_Id')->constrained('mar')->onDelete('Cascade')->onUpdate('Cascade');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('adm')->nullable();
            $table->string('path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mar_time');
    }
};
