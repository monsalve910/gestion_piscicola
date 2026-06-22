<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->decimal('peso_kg', 10, 2)->after('especie_id');
        });

        DB::statement('UPDATE ventas SET peso_kg = cantidad');

        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn('cantidad');
        });
    }

    public function down(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->integer('cantidad')->after('especie_id');
        });

        DB::statement('UPDATE ventas SET cantidad = peso_kg');

        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn('peso_kg');
        });
    }
};
