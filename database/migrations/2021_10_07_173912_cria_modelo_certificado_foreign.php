<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriaModeloCertificadoForeign extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('eventos', function (Blueprint $table) {
            $table->unsignedBigInteger('modelo_certificado_id')->nullable();
        });
        Schema::table('eventos', function (Blueprint $table) {
            $table->foreign('modelo_certificado_id')->references('id')->on('modelo_certificados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('eventos', function (Blueprint $table) {
            $table->dropForeign('modelo_certificado_id');
            $table->dropColumn('modelo_certificado_id');
        });
    }
}
