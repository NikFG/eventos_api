<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventosSeeder extends Seeder {

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {


        \DB::table('eventos')->delete();

        \DB::table('eventos')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'nome' => 'Evento cultural',
                    'expectativa_participantes' => 0,
                    'breve_descricao' => 'Evento cultural para os profissionais de TI',
                    'local' => 'Meet',
                    'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae vehicula nulla. Nulla suscipit, enim a eleifend pellentesque, nisl risus cursus felis, quis facilisis justo sem nec purus. Curabitur consectetur dui ac dolor malesuada, in pellentesque metus viverra. Curabitur imperdiet risus ac interdum ultrices. Ut volutpat facilisis consectetur. Morbi condimentum felis non diam scelerisque, vitae feugiat erat hendrerit. Nullam odio tortor, volutpat faucibus hendrerit nec, tempus et velit. Suspendisse aliquet ligula in leo placerat, at eleifend metus accumsan. Aliquam erat volutpat.

Nullam ultricies tristique neque. Etiam aliquam orci sed felis laoreet dapibus. Donec metus magna, fringilla in venenatis eget, pulvinar quis libero. Mauris metus mi, porttitor sit amet condimentum a, varius ut erat. Quisque congue tempor lectus, sit amet lacinia odio hendrerit et. Praesent non finibus sem. Curabitur laoreet rutrum maximus. Suspendisse sagittis id nulla euismod consequat. Maecenas eget lacinia mi. Aliquam sem lacus, dignissim nec convallis vel, blandit vitae mauris. Morbi tincidunt sodales diam et egestas. Duis dapibus vestibulum sapien, at ornare mi scelerisque at. Morbi sagittis auctor odio.

Sed sollicitudin sem eu sem mattis fermentum. Nullam pharetra felis a nisl congue iaculis. Phasellus non sem vitae nunc fermentum iaculis. Sed lacinia sem at magna posuere, eu pellentesque elit pellentesque. Aenean tristique pulvinar dui at iaculis. Vivamus scelerisque semper vestibulum. Mauris laoreet, leo at venenatis posuere, sapien magna sollicitudin justo, ut vestibulum nunc urna vitae felis. Nam id fermentum massa. Cras aliquet libero non enim dictum, ac elementum nulla pretium. Quisque scelerisque diam id metus aliquet vestibulum ut ac quam.

Integer posuere leo eget tempor accumsan. Integer varius aliquam convallis. Aenean turpis ex, maximus eget eleifend nec, cursus et ligula. Suspendisse cursus malesuada enim id finibus. Pellentesque dictum tortor nunc, vel vehicula turpis posuere vitae. Aenean nibh neque, dapibus quis justo eu, aliquam congue neque. Fusce et rutrum eros. Morbi dapibus, tortor a egestas egestas, mauris nisi lacinia nisi, vel mattis nibh lorem eget lectus. Nam scelerisque nunc sem, ut volutpat felis suscipit feugiat.

Proin vulputate viverra convallis. Duis libero odio, aliquet sit amet elit vel, fringilla rutrum quam. Fusce rutrum rutrum justo. Etiam ipsum est, mollis quis interdum quis, lobortis eu diam. Mauris facilisis id nunc id interdum. Etiam posuere nisl eget magna efficitur efficitur. Mauris nec lacus vitae mauris aliquam vulputate vitae id ex. Vivamus nibh dui, hendrerit a mauris placerat, molestie porttitor purus. Nulla a hendrerit velit. Mauris mollis augue turpis, interdum auctor turpis tempus nec. Pellentesque non magna eget massa commodo accumsan at posuere orci. Vivamus vel mollis ipsum, vitae viverra quam. Nam consectetur consectetur tortor placerat dictum. Nulla euismod consectetur luctus. Duis euismod congue dolor id tincidunt.',
                    'link_descricao' => NULL,
                    'categoria_id' => 1,
                    'tipo_id' => 1,
                    'instituicao_id' => 1,
                    'user_id' => 1,
                    'created_at' => '2022-05-28 11:31:42',
                    'updated_at' => '2022-05-28 11:31:47',
                    'banner' => 'https://firebasestorage.googleapis.com/v0/b/eventos-dados.appspot.com/o/eventos%2F1%2Fbanner%2FOficina-Cultural-do-Colegio-Etapa-reune-pais-e-alunos-para-manha-de-integracao-e-resgate-de-brincadeiras%20(2).jpg?alt=media&token=e87df1fd-8198-4cac-8bc0-729df0643475',
                    'deleted_at' => NULL,
                    'modelo_certificado_id' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'nome' => 'O futuro do JavaScript',
                    'expectativa_participantes' => 0,
                    'breve_descricao' => 'Nesta mesa redonda iremos discutir qual será o possível rumo que o JavaScript irá tomar',
                    'local' => 'Teams',
                    'descricao' => 'Nesta mesa redonda iremos discutir qual será o possível rumo que o JavaScript irá tomar.',
                    'link_descricao' => NULL,
                    'categoria_id' => 1,
                    'tipo_id' => 1,
                    'instituicao_id' => 1,
                    'user_id' => 1,
                    'created_at' => '2022-05-30 19:02:08',
                    'updated_at' => '2022-05-30 19:02:11',
                    'banner' => 'https://firebasestorage.googleapis.com/v0/b/eventos-dados.appspot.com/o/eventos%2F2%2Fbanner%2Ffuturo.png?alt=media&token=4899f7b2-1740-4ebf-9cd4-33cb80944ec3',
                    'deleted_at' => NULL,
                    'modelo_certificado_id' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'nome' => 'Introdução ao Laravel',
                    'expectativa_participantes' => 0,
                    'breve_descricao' => 'Minicurso introdutório ao framework Laravel',
                    'local' => 'meet',
                    'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae vehicula nulla. Nulla suscipit, enim a eleifend pellentesque, nisl risus cursus felis, quis facilisis justo sem nec purus. Curabitur consectetur dui ac dolor malesuada, in pellentesque metus viverra. Curabitur imperdiet risus ac interdum ultrices. Ut volutpat facilisis consectetur. Morbi condimentum felis non diam scelerisque, vitae feugiat erat hendrerit. Nullam odio tortor, volutpat faucibus hendrerit nec, tempus et velit. Suspendisse aliquet ligula in leo placerat, at eleifend metus accumsan. Aliquam erat volutpat. Nullam ultricies tristique neque. Etiam aliquam orci sed felis laoreet dapibus. Donec metus magna, fringilla in venenatis eget, pulvinar quis libero. Mauris metus mi, porttitor sit amet condimentum a, varius ut erat. Quisque congue tempor lectus, sit amet lacinia odio hendrerit et. Praesent non finibus sem. Curabitur laoreet rutrum maximus. Suspendisse sagittis id nulla euismod consequat. Maecenas eget lacinia mi. Aliquam sem lacus, dignissim nec convallis vel, blandit vitae mauris. Morbi tincidunt sodales diam et egestas. Duis dapibus vestibulum sapien, at ornare mi scelerisque at. Morbi sagittis auctor odio. Sed sollicitudin sem eu sem mattis fermentum. Nullam pharetra felis a nisl congue iaculis. Phasellus non sem vitae nunc fermentum iaculis. Sed lacinia sem at magna posuere, eu pellentesque elit pellentesque. Aenean tristique pulvinar dui at iaculis. Vivamus scelerisque semper vestibulum. Mauris laoreet, leo at venenatis posuere, sapien magna sollicitudin justo, ut vestibulum nunc urna vitae felis. Nam id fermentum massa. Cras aliquet libero non enim dictum, ac elementum nulla pretium. Quisque scelerisque diam id metus aliquet vestibulum ut ac quam. Integer posuere leo eget tempor accumsan. Integer varius aliquam convallis. Aenean turpis ex, maximus eget eleifend nec, cursus et ligula. Suspendisse cursus malesuada enim id finibus. Pellentesque dictum tortor nunc, vel vehicula turpis posuere vitae. Aenean nibh neque, dapibus quis justo eu, aliquam congue neque. Fusce et rutrum eros. Morbi dapibus, tortor a egestas egestas, mauris nisi lacinia nisi, vel mattis nibh lorem eget lectus. Nam scelerisque nunc sem, ut volutpat felis suscipit feugiat. Proin vulputate viverra convallis. Duis libero odio, aliquet sit amet elit vel, fringilla rutrum quam. Fusce rutrum rutrum justo. Etiam ipsum est, mollis quis interdum quis, lobortis eu diam. Mauris facilisis id nunc id interdum. Etiam posuere nisl eget magna efficitur efficitur. Mauris nec lacus vitae mauris aliquam vulputate vitae id ex. Vivamus nibh dui, hendrerit a mauris placerat, molestie porttitor purus. Nulla a hendrerit velit. Mauris mollis augue turpis, interdum auctor turpis tempus nec. Pellentesque non magna eget massa commodo accumsan at posuere orci. Vivamus vel mollis ipsum, vitae viverra quam. Nam consectetur consectetur tortor placerat dictum. Nulla euismod consectetur luctus. Duis euismod congue dolor id tincidunt.',
                    'link_descricao' => NULL,
                    'categoria_id' => 1,
                    'tipo_id' => 1,
                    'instituicao_id' => 1,
                    'user_id' => 1,
                    'created_at' => '2022-05-30 19:05:42',
                    'updated_at' => '2022-05-30 19:05:47',
                    'banner' => 'https://firebasestorage.googleapis.com/v0/b/eventos-dados.appspot.com/o/eventos%2F3%2Fbanner%2Flaravel.png?alt=media&token=2758c731-dd3f-43e7-927b-ab2579577ec5',
                    'deleted_at' => NULL,
                    'modelo_certificado_id' => NULL,
                ),
        ));


    }
}
