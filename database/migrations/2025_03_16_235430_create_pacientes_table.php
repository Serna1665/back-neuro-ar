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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->text('nombres');
            $table->text('apellidos');
            $table->date('fecha_nacimiento');
            $table->foreignId('oficio_id')->constrained('oficios');
            $table->string('genero');
            $table->string('lateralidad_dominante');
            $table->foreignId('municipio_id')->constrained('municipios');
            $table->foreignId('tipo_documento_id')->constrained('tipos_documentos');
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->float('estatura');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
