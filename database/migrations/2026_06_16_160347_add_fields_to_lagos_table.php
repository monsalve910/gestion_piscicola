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
        Schema::table('lagos', function (Blueprint $table) {
            $table->string('ubicacion')->nullable()->after('nombre');
            $table->decimal('profundidad', 10, 2)->nullable()->after('tamano');
            $table->integer('capacidad_maxima_peces')->nullable()->after('profundidad');
            $table->text('observaciones')->nullable()->after('estado');
        });
    }

    public function down(): void
    {
        Schema::table('lagos', function (Blueprint $table) {
            $table->dropColumn(['ubicacion', 'profundidad', 'capacidad_maxima_peces', 'observaciones']);
        });
    }
};
