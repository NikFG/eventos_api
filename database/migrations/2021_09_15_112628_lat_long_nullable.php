<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LatLongNullable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('instituicoes', function (Blueprint $table) {
            $table->decimal('latitude',10,8)->nullable()->change();
            $table->decimal('longitude',10,8)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('instituicoes', function (Blueprint $table) {
            $table->decimal('latitude')->nullable(false)->change();
            $table->decimal('longitude')->nullable(false)->change();
        });
    }
}
