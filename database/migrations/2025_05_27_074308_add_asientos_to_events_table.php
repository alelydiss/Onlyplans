<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAsientosToEventsTable extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('requiere_asientos')->default(false);
            $table->integer('asientos_totales')->default(0);
            $table->integer('asientos_disponibles')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['asientos_totales', 'asientos_disponibles']);
        });
    }
}
