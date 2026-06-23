<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('especies', function (Blueprint $table) {
            $table->decimal('temp_min', 5, 2)->nullable()->after('precio');
            $table->decimal('temp_max', 5, 2)->nullable()->after('temp_min');
            $table->decimal('ph_min', 4, 2)->nullable()->after('temp_max');
            $table->decimal('ph_max', 4, 2)->nullable()->after('ph_min');
            $table->decimal('oxigeno_min', 5, 2)->nullable()->after('ph_max');
            $table->decimal('oxigeno_max', 5, 2)->nullable()->after('oxigeno_min');
        });
    }

    public function down(): void
    {
        Schema::table('especies', function (Blueprint $table) {
            $table->dropColumn(['temp_min', 'temp_max', 'ph_min', 'ph_max', 'oxigeno_min', 'oxigeno_max']);
        });
    }
};
