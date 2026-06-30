<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('monitoreos', function (Blueprint $table) {
            $table->dateTime('fecha_monitoreo')->change();
        });
    }

    public function down(): void
    {
        Schema::table('monitoreos', function (Blueprint $table) {
            $table->date('fecha_monitoreo')->change();
        });
    }
};
