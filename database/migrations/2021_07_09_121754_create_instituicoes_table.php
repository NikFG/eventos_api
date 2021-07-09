<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituicoesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('instituicoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 200);
            $table->string('cnpj', 20)->nullable()->unique();
            $table->string('endereco', 500);
            $table->string('logo', 100);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->unsignedBigInteger('administrador_id');
            $table->timestamps();
        });
        Schema::table('instituicoes', function (Blueprint $table) {
            $table->foreign('administrador_id')->references('id')->on('users');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('instituicao_id');
            $table->foreign('instituicao_id')->references('id')->on('instituicoes')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('instituicao_id');
            $table->dropColumn('instituicao_id');
        });
        Schema::dropIfExists('instituicoes');

    }
}
