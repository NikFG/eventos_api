<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteAtividadeidApresentadores extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('apresentadores', function (Blueprint $table) {
            $table->dropForeign(['atividade_id']);
            $table->dropColumn('atividade_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('apresentadores', function (Blueprint $table) {
            $table->unsignedBigInteger('atividade_id')->nullable();
            $table->foreign('atividade_id')->references('id')->on('atividades');
        });
    }
}
