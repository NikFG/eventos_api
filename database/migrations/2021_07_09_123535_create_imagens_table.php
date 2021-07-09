<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagensTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('imagens', function (Blueprint $table) {
            $table->id();
            $table->string('imagem',400);
            $table->text('descricao')->nullable();
            $table->unsignedBigInteger('evento_id');
            $table->unsignedBigInteger('tipo_imagem_id');
            $table->timestamps();
        });
        Schema::table('imagens', function (Blueprint $table) {
            $table->foreign('evento_id')->references('id')->on('eventos');
            $table->foreign('tipo_imagem_id')->references('id')->on('tipo_imagens');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('imagens');
    }
}
