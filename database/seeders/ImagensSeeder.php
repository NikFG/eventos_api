<?php

namespace Database\Seeders;

use App\Models\Imagem;
use Illuminate\Database\Seeder;

class ImagensSeeder extends Seeder {

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {


        \DB::table('imagens')->delete();

        $imagem = new Imagem();
        $imagem->imagem = 'https://firebasestorage.googleapis.com/v0/b/eventos-dados.appspot.com/o/eventos%2F1%2Fbanner%2FOficina-Cultural-do-Colegio-Etapa-reune-pais-e-alunos-para-manha-de-integracao-e-resgate-de-brincadeiras%20(2).jpg?alt=media&token=e87df1fd-8198-4cac-8bc0-729df0643475';
        $imagem->descricao = 'Oficina-Cultural-do-Colegio-Etapa-reune-pais-e-alunos-para-manha-de-integracao-e-resgate-de-brincadeiras (2).jpg';
        $imagem->evento_id = 1;
        $imagem->tipo_imagem_id = 1;
        $imagem->save();


        $imagem = new Imagem();
        $imagem->imagem = 'https://firebasestorage.googleapis.com/v0/b/eventos-dados.appspot.com/o/eventos%2F1%2Foutras%2F%C3%ADndice.jpg?alt=media&token=e8726c42-a92a-420d-a441-34c5336334e5';
        $imagem->descricao = 'índice.jpg';
        $imagem->evento_id = 1;
        $imagem->tipo_imagem_id = 2;
        $imagem->save();

        $imagem = new Imagem();
        $imagem->imagem = 'https://firebasestorage.googleapis.com/v0/b/eventos-dados.appspot.com/o/eventos%2F1%2Foutras%2Fimages.jpg?alt=media&token=89862125-54f1-4e9b-bc96-b230cc3c3e92';
        $imagem->descricao = 'images.jpg';
        $imagem->evento_id = 1;
        $imagem->tipo_imagem_id = 2;
        $imagem->save();

        $imagem = new Imagem();
        $imagem->imagem = 'https://firebasestorage.googleapis.com/v0/b/eventos-dados.appspot.com/o/eventos%2F2%2Fbanner%2Ffuturo.png?alt=media&token=4899f7b2-1740-4ebf-9cd4-33cb80944ec3';
        $imagem->descricao = 'futuro.png';
        $imagem->evento_id = 2;
        $imagem->tipo_imagem_id = 1;
        $imagem->save();

        $imagem = new Imagem();
        $imagem->imagem = 'https://firebasestorage.googleapis.com/v0/b/eventos-dados.appspot.com/o/eventos%2F3%2Fbanner%2Flaravel.png?alt=media&token=2758c731-dd3f-43e7-927b-ab2579577ec5';
        $imagem->descricao = 'laravel.png';
        $imagem->evento_id = 3;
        $imagem->tipo_imagem_id = 1;
        $imagem->save();


    }
}
