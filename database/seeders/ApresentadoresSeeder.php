<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ApresentadoresSeeder extends Seeder {

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {


        \DB::table('apresentadores')->delete();

        \DB::table('apresentadores')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'nome' => 'Marcelo',
                    'email' => 'mariowii2011@live.com',
                    'user_id' => NULL,
                    'created_at' => '2022-05-28 11:31:42',
                    'updated_at' => '2022-05-28 11:31:42',
                ),
            1 =>
                array(
                    'id' => 2,
                    'nome' => 'Nikollas',
                    'email' => 'nikollasferreira@hotmail.com',
                    'user_id' => 2,
                    'created_at' => '2022-05-28 11:31:42',
                    'updated_at' => '2022-05-28 11:31:42',
                ),
            2 =>
                array(
                    'id' => 3,
                    'nome' => 'Gustavo Alberto',
                    'email' => 'nikollas.galo@hotmail.com',
                    'user_id' => NULL,
                    'created_at' => '2022-05-28 11:31:42',
                    'updated_at' => '2022-05-28 11:31:42',
                ),
            3 =>
                array(
                    'id' => 4,
                    'nome' => 'Mauro',
                    'email' => 'nikollasferreira@hotmail.com',
                    'user_id' => 2,
                    'created_at' => '2022-05-30 19:02:08',
                    'updated_at' => '2022-05-30 19:02:08',
                ),
            4 =>
                array(
                    'id' => 5,
                    'nome' => 'Nikollas',
                    'email' => 'nikollasferreira@hotmail.com',
                    'user_id' => 2,
                    'created_at' => '2022-05-30 19:05:42',
                    'updated_at' => '2022-05-30 19:05:42',
                ),
        ));


    }
}
