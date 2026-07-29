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
        Schema::table('planos', function (Blueprint $table) {

            $table->text('descricao')->nullable()->after('nome');

            $table->string('unidade_tempo')->default('hora')->after('tempo');

            $table->integer('download')->default(0)->after('preco');
            $table->integer('upload')->default(0)->after('download');

            $table->integer('simultaneos')->default(1)->after('upload');

            $table->boolean('ativo')->default(true)->after('status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('planos', function (Blueprint $table) {

            $table->dropColumn([
                'descricao',
                'unidade_tempo',
                'download',
                'upload',
                'simultaneos',
                'ativo'
            ]);

        });
    }
};