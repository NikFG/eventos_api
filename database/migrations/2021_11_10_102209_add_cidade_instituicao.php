<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCidadeInstituicao extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //add cidade to instituicoes
        Schema::table('instituicoes', function (Blueprint $table) {
            $table->string('cidade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //remove cidade from instituicoes
        Schema::table('instituicoes', function (Blueprint $table) {
            $table->dropColumn('cidade');
        });
    }
}
