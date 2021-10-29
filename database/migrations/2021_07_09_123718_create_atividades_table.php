<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->date('data');
            $table->time('horario_inicio');
            $table->time('horario_fim');
            $table->string('local', 200)->nullable();
            $table->string('link_tranmissao', 400)->nullable();
            $table->string('imagem', 400)->nullable();
            $table->text('descricao')->nullable();
            $table->unsignedBigInteger('evento_id');
            $table->unsignedBigInteger('tipo_atividade_id');
            $table->unsignedBigInteger('apresentador_id')->nullable();
            $table->timestamps();
        });
        Schema::table('atividades', function (Blueprint $table) {
            $table->foreign('evento_id')->references('id')->on('eventos');
            $table->foreign('tipo_atividade_id')->references('id')->on('tipo_atividades');
            $table->foreign('apresentador_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('atividades');
    }
}
