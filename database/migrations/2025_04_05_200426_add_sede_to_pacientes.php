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
        Schema::table('pacientes', function (Blueprint $table) {
            $table->foreignId('sede_id')->nullable()->constrained('sedes');
            $table->foreignId('dependencia_id')->nullable()->constrained('dependencias');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropForeign(['sede_id']);
            $table->dropForeign(['dependencia_id']);
            $table->dropColumn(['sede_id', 'dependencia_id']);
        });
    }
};
