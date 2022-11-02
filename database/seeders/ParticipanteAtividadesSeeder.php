<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParticipanteAtividadesSeeder extends Seeder {

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {


        \DB::table('participante_atividades')->delete();

        \DB::table('participante_atividades')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'participou' => 0,
                    'nome_orador' => NULL,
                    'user_id' => NULL,
                    'atividade_id' => 1,
                    'created_at' => '2022-05-28 11:31:42',
                    'updated_at' => '2022-05-28 11:31:42',
                    'apresentador_id' => 1,
                ),
            1 =>
                array(
                    'id' => 2,
                    'participou' => 0,
                    'nome_orador' => NULL,
                    'user_id' => 2,
                    'atividade_id' => 2,
                    'created_at' => '2022-05-28 11:31:42',
                    'updated_at' => '2022-05-28 11:31:42',
                    'apresentador_id' => 2,
                ),
            2 =>
                array(
                    'id' => 3,
                    'participou' => 0,
                    'nome_orador' => NULL,
                    'user_id' => NULL,
                    'atividade_id' => 2,
                    'created_at' => '2022-05-28 11:31:42',
                    'updated_at' => '2022-05-28 11:31:42',
                    'apresentador_id' => 3,
                ),
            3 =>
                array(
                    'id' => 4,
                    'participou' => 0,
                    'nome_orador' => NULL,
                    'user_id' => 2,
                    'atividade_id' => 3,
                    'created_at' => '2022-05-30 19:02:08',
                    'updated_at' => '2022-05-30 19:02:08',
                    'apresentador_id' => 4,
                ),
            4 =>
                array(
                    'id' => 5,
                    'participou' => 0,
                    'nome_orador' => NULL,
                    'user_id' => 2,
                    'atividade_id' => 4,
                    'created_at' => '2022-05-30 19:05:42',
                    'updated_at' => '2022-05-30 19:05:42',
                    'apresentador_id' => 5,
                ),
        ));


    }
}
