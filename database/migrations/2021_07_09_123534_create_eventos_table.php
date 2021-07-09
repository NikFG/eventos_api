<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->unsignedInteger('expectativa_participantes');
            $table->string('link_evento', 100)->unique();
            $table->string('breve_descricao', 100);
            $table->string('local', 500)->nullable();
            $table->text('descricao')->nullable();
            $table->string('link_descricao', 400)->nullable();
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('instituicao_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::table('eventos', function (Blueprint $table) {
            $table->foreign('categoria_id')->references('id')->on('categoria');
            $table->foreign('tipo_id')->references('id')->on('tipo_eventos');
            $table->foreign('instituicao_id')->references('id')->on('instituicoes');
            $table->foreign('user_id')->references('id')->on('users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('eventos');
    }
}
