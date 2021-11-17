<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificaDadosApresentadorAtividade extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('atividades', function (Blueprint $table) {
            $table->dropColumn('nome_apresentador');
            $table->dropColumn('email_apresentador');
            $table->dropForeign(['apresentador_id']);
            $table->dropColumn('apresentador_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('atividades', function (Blueprint $table) {
            $table->string('nome_apresentador')->nullable();
            $table->string('email_apresentador')->nullable();
            $table->unsignedBigInteger('apresentador_id')->nullable();
            $table->foreign('apresentador_id')->references('id')->on('users');
        });
    }
}
