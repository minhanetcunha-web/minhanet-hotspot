<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            if (!Schema::hasColumn('clientes', 'email')) {
                $table->string('email')->nullable();
            }
            if (!Schema::hasColumn('clientes', 'last_access_at')) {
                $table->timestamp('last_access_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            if (Schema::hasColumn('clientes', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('clientes', 'last_access_at')) {
                $table->dropColumn('last_access_at');
            }
        });
    }
};
