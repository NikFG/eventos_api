<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ImagensSeeder extends Seeder {

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {


        \DB::table('imagens')->delete();

        \DB::table('imagens')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'imagem' => 'https://firebasestorage.googleapis.com/v0/b/eventos-dados.appspot.com/o/eventos%2F1%2Fbanner%2FOficina-Cultural-do-Colegio-Etapa-reune-pais-e-alunos-para-manha-de-integracao-e-resgate-de-brincadeiras%20(2).jpg?alt=media&token=e87df1fd-8198-4cac-8bc0-729df0643475',
                    'descricao' => 'Oficina-Cultural-do-Colegio-Etapa-reune-pais-e-alunos-para-manha-de-integracao-e-resgate-de-brincadeiras (2).jpg',
                    'evento_id' => 1,
                    'tipo_imagem_id' => 1,
                    'created_at' => '2022-05-28 11:31:47',
                    'updated_at' => '2022-05-28 11:31:47',
                ),
            1 =>
                array(
                    'id' => 2,
                    'imagem' => 'https://firebasestorage.googleapis.com/v0/b/eventos-dados.appspot.com/o/eventos%2F1%2Foutras%2F%C3%ADndice.jpg?alt=media&token=e8726c42-a92a-420d-a441-34c5336334e5',
                    'descricao' => 'índice.jpg',
                    'evento_id' => 1,
                    'tipo_imagem_id' => 2,
                    'created_at' => '2022-05-28 11:31:56',
                    'updated_at' => '2022-05-28 11:31:56',
                ),
            2 =>
                array(
                    'id' => 3,
                    'imagem' => 'https://firebasestorage.googleapis.com/v0/b/eventos-dados.appspot.com/o/eventos%2F1%2Foutras%2Fimages.jpg?alt=media&token=89862125-54f1-4e9b-bc96-b230cc3c3e92',
                    'descricao' => 'images.jpg',
                    'evento_id' => 1,
                    'tipo_imagem_id' => 2,
                    'created_at' => '2022-05-28 11:31:56',
                    'updated_at' => '2022-05-28 11:31:56',
                ),
            3 =>
                array(
                    'id' => 4,
                    'imagem' => 'https://firebasestorage.googleapis.com/v0/b/eventos-dados.appspot.com/o/eventos%2F2%2Fbanner%2Ffuturo.png?alt=media&token=4899f7b2-1740-4ebf-9cd4-33cb80944ec3',
                    'descricao' => 'futuro.png',
                    'evento_id' => 2,
                    'tipo_imagem_id' => 1,
                    'created_at' => '2022-05-30 19:02:11',
                    'updated_at' => '2022-05-30 19:02:11',
                ),
            4 =>
                array(
                    'id' => 5,
                    'imagem' => 'https://firebasestorage.googleapis.com/v0/b/eventos-dados.appspot.com/o/eventos%2F3%2Fbanner%2Flaravel.png?alt=media&token=2758c731-dd3f-43e7-927b-ab2579577ec5',
                    'descricao' => 'laravel.png',
                    'evento_id' => 3,
                    'tipo_imagem_id' => 1,
                    'created_at' => '2022-05-30 19:05:47',
                    'updated_at' => '2022-05-30 19:05:47',
                ),
        ));


    }
}
