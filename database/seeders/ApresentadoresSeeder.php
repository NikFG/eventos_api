<?php

namespace Database\Seeders;

use App\Models\Apresentador;
use Illuminate\Database\Seeder;

class ApresentadoresSeeder extends Seeder {

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {


        \DB::table('apresentadores')->delete();

        $apresentador = new Apresentador();
        $apresentador->nome = 'Marcelo';
        $apresentador->email = 'mariowii2011@live.com';
        $apresentador->save();

        $apresentador = new Apresentador();
        $apresentador->nome = 'Nikollas';
        $apresentador->email = 'nikollasferreira@hotmail.com';
        $apresentador->user_id = 2;
        $apresentador->save();

        $apresentador = new Apresentador();
        $apresentador->nome = 'Gustavo Alberto';
        $apresentador->email = 'nikollas.galo@hotmail.com';
        $apresentador->save();

        $apresentador = new Apresentador();
        $apresentador->nome = 'Nikollas';
        $apresentador->email = 'nikollasferreirag@gmail.com';
        $apresentador->user_id = 1;
        $apresentador->save();

        $apresentador = new Apresentador();
        $apresentador->nome = 'Mauro';
        $apresentador->email = 'mauro@gmail.com';
        $apresentador->save();


    }
}
