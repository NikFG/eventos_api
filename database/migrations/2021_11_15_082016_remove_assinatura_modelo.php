<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RemoveAssinaturaModelo extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('modelo_certificados', function ($table) {
            $table->dropColumn('numero_assinaturas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('modelo_certificados', function ($table) {
            $table->integer('numero_assinaturas');
        });
    }
}
