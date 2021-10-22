<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModeloCertificadosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('modelo_certificados', function (Blueprint $table) {
            $table->id();
            $table->string('imagem_fundo', 200)->nullable();
            $table->string('titulo', 300);
            $table->string('logo', 200)->nullable();
            $table->unsignedInteger('numero_assinaturas');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('modelo_certificados');
    }
}
