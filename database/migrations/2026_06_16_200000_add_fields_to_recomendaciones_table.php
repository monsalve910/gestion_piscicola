<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recomendaciones', function (Blueprint $table) {
            $table->string('tipo')->nullable()->after('mensaje');
            $table->string('nivel_riesgo')->nullable()->after('tipo');
            $table->text('parametros')->nullable()->after('nivel_riesgo');
            $table->boolean('es_actual')->default(false)->after('parametros');
        });
    }

    public function down(): void
    {
        Schema::table('recomendaciones', function (Blueprint $table) {
            $table->dropColumn(['tipo', 'nivel_riesgo', 'parametros', 'es_actual']);
        });
    }
};
