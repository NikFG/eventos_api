<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdicionaDadosAssinaturaModelo extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('modelo_certificados', function (Blueprint $table) {
            $table->string('assinatura', 500)->nullable();
            $table->string('nome_assinatura', 100);
            $table->string('cargo_assinatura', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('modelo_certificados', function (Blueprint $table) {
            $table->dropColumn('assinatura');
            $table->dropColumn('nome_assinatura');
            $table->dropColumn('cargo_assinatura');
        });
    }
}
