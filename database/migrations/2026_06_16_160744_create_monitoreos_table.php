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
        Schema::create('monitoreos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lago_id')->constrained()->onDelete('cascade');
            $table->date('fecha_monitoreo');
            $table->decimal('temperatura_agua', 5, 2)->nullable();
            $table->decimal('ph', 4, 2)->nullable();
            $table->decimal('nivel_oxigeno', 5, 2)->nullable();
            $table->string('estado_general')->default('bueno');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoreos');
    }
};
