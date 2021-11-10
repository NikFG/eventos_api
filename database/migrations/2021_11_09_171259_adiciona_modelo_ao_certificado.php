<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AdicionaModeloAoCertificado extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('certificados', function (Blueprint $table) {
            $table->unsignedBigInteger('modelo_certificado_id')->nullable();
        });

        Schema::table('certificados', function (Blueprint $table) {
            $table->foreign('modelo_certificado_id')->references('id')->on('modelo_certificados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //drop column and foreign key
        Schema::table('certificados', function (Blueprint $table) {
            $table->dropForeign(['modelo_certificado_id']);
            $table->dropColumn('modelo_certificado_id');
        });

    }
}
