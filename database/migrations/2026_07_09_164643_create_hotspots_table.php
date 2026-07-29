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
    Schema::create('hotspots', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('ip');
        $table->integer('porta')->default(8728);
        $table->string('usuario');
        $table->string('senha');
        $table->string('nome_hotspot')->nullable();
        $table->boolean('ativo')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotspots');
    }
};
