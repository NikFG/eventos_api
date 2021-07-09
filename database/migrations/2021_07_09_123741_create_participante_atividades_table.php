<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipanteAtividadesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('participante_atividades', function (Blueprint $table) {
            $table->id();
            $table->boolean('participou')->nullable()->default(false);
            $table->boolean('orador')->nullable()->default(false);
            $table->string('nome_orador', 100)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('atividade_id');
            $table->timestamps();
        });
        Schema::create('participante_atividades', function (Blueprint $table) {
            $table->foreign('atividade_id')->references('id')->on('atividades');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('participante_atividades');
    }
}
