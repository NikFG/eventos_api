<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MelhoraNomeApresentadorAtividade extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('participante_atividades', function (Blueprint $table) {
            $table->renameColumn('orador', 'apresentador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('participante_atividades', function (Blueprint $table) {
            $table->renameColumn('apresentador', 'orador');
        });
    }
}
