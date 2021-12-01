<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->string('codigo_verificacao', 255)->unique();
            $table->date('data_emissao');
            $table->dateTime('data_hora_evento');
            $table->string('nome_evento', 100);
            $table->string('local', 100);
            $table->string('horas',10);
            $table->unsignedBigInteger('participante_id');
            $table->unsignedBigInteger('evento_id');
            $table->unsignedBigInteger('instituicao_id');
            $table->unsignedBigInteger('atividade_id');
            $table->timestamps();
        });

        Schema::table('certificados', function (Blueprint $table) {
            $table->foreign('participante_id')->references('id')->on('users');
            $table->foreign('evento_id')->references('id')->on('eventos');
            $table->foreign('instituicao_id')->references('id')->on('instituicoes');
            $table->foreign('atividade_id')->references('id')->on('atividades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('certificados');
    }
}
