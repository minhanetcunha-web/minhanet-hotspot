<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hotspots', function (Blueprint $table) {
            if (!Schema::hasColumn('hotspots', 'empresa')) {
                $table->string('empresa')->nullable()->after('nome');
            }
            if (!Schema::hasColumn('hotspots', 'status')) {
                $table->string('status')->default('Ativo')->after('ativo');
            }
            if (!Schema::hasColumn('hotspots', 'servidor_radius')) {
                $table->string('servidor_radius')->nullable()->after('status');
            }
            if (!Schema::hasColumn('hotspots', 'chave_publica_wireguard')) {
                $table->text('chave_publica_wireguard')->nullable()->after('servidor_radius');
            }
            if (!Schema::hasColumn('hotspots', 'chave_privada_wireguard')) {
                $table->text('chave_privada_wireguard')->nullable()->after('chave_publica_wireguard');
            }
            if (!Schema::hasColumn('hotspots', 'ip_vpn')) {
                $table->string('ip_vpn')->nullable()->after('chave_privada_wireguard');
            }
            if (!Schema::hasColumn('hotspots', 'porta_wireguard')) {
                $table->integer('porta_wireguard')->nullable()->after('ip_vpn');
            }
            if (!Schema::hasColumn('hotspots', 'endpoint_vpn')) {
                $table->string('endpoint_vpn')->nullable()->after('porta_wireguard');
            }
            if (!Schema::hasColumn('hotspots', 'allowed_ips')) {
                $table->text('allowed_ips')->nullable()->after('endpoint_vpn');
            }
            if (!Schema::hasColumn('hotspots', 'api_ssl')) {
                $table->boolean('api_ssl')->default(false)->after('allowed_ips');
            }
            if (!Schema::hasColumn('hotspots', 'last_sync_at')) {
                $table->timestamp('last_sync_at')->nullable()->after('api_ssl');
            }
        });
    }

    public function down(): void
    {
        Schema::table('hotspots', function (Blueprint $table) {
            $columns = ['empresa', 'status', 'servidor_radius', 'chave_publica_wireguard', 'chave_privada_wireguard', 'ip_vpn', 'porta_wireguard', 'endpoint_vpn', 'allowed_ips', 'api_ssl', 'last_sync_at'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('hotspots', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
