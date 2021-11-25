<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelacionaApresentadorParticipante extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('participante_atividades', function (Blueprint $table) {
            $table->dropColumn('apresentador');
            $table->unsignedBigInteger('apresentador_id')->nullable();
            $table->foreign('apresentador_id')->references('id')->on('apresentadores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('participante_atividades', function (Blueprint $table) {
            $table->dropForeign(['apresentador_id']);
            $table->dropColumn('apresentador_id');
            $table->boolean('apresentador')->default(false);
        });
    }
}
