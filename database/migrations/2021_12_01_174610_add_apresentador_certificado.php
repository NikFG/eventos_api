<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApresentadorCertificado extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('certificados', function (Blueprint $table) {
            $table->unsignedBigInteger('apresentador_id')->nullable();
            $table->unsignedBigInteger('participante_id')->nullable()->change();
            $table->foreign('apresentador_id')->references('id')->on('apresentadores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('certificados', function (Blueprint $table) {
            $table->dropForeign(['apresentador_id']);
            $table->dropColumn('apresentador_id');
            $table->unsignedBigInteger('participante_id')->nullable(false)->change();
        });

    }
}
