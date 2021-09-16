<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmailNomeApresentadorAtividade extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('atividades', function (Blueprint $table) {
            $table->string('nome_apresentador');
            $table->string('email_apresentador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('atividades', function (Blueprint $table) {
            $table->dropColumn('nome_apresentador');
            $table->dropColumn('email_apresentador');
        });
    }
}
