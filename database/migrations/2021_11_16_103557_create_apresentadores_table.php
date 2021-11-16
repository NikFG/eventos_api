<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApresentadoresTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('apresentadores', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('email', 100);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('atividade_id');
            $table->timestamps();
        });
        Schema::table('apresentadores', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('atividade_id')->references('id')->on('atividades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('apresentadores');
    }
}
