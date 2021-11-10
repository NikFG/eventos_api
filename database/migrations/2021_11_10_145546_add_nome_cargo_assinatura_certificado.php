<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomeCargoAssinaturaCertificado extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('certificados', function (Blueprint $table) {
            $table->string('nome', 120)->default('Nikollas');
            $table->string('cargo', 50)->default('Reitor');
            $table->string('assinatura')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('certificados', function (Blueprint $table) {
            $table->dropColumn('nome');
            $table->dropColumn('cargo');
            $table->dropColumn('assinatura');
        });

    }
}
