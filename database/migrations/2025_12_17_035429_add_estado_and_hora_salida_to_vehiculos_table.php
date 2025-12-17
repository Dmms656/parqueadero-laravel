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
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->enum('estado', ['ABIERTO', 'CERRADO'])
                ->default('ABIERTO')
                ->after('observaciones');

            $table->timestamp('hora_salida')
                ->nullable()
                ->after('estado');
        });
    }

    public function down(): void
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->dropColumn(['estado', 'hora_salida']);
        });
    }
};
