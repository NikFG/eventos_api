<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AtividadesSeeder extends Seeder {

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {


        \DB::table('atividades')->delete();

        \DB::table('atividades')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'nome' => 'Introdução ao evento',
                    'data' => '2022-11-01',
                    'horario_inicio' => '10:30:00',
                    'horario_fim' => '11:30:00',
                    'local' => 'Meet',
                    'link_tranmissao' => NULL,
                    'imagem' => NULL,
                    'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae vehicula nulla. Nulla suscipit, enim a eleifend pellentesque, nisl risus cursus felis, quis facilisis justo sem nec purus. Curabitur consectetur dui ac dolor malesuada, in pellentesque metus viverra. Curabitur imperdiet risus ac interdum ultrices. Ut volutpat facilisis consectetur. Morbi condimentum felis non diam scelerisque, vitae feugiat erat hendrerit. Nullam odio tortor, volutpat faucibus hendrerit nec, tempus et velit. Suspendisse aliquet ligula in leo placerat, at eleifend metus accumsan. Aliquam erat volutpat.

Nullam ultricies tristique neque. Etiam aliquam orci sed felis laoreet dapibus. Donec metus magna, fringilla in venenatis eget, pulvinar quis libero. Mauris metus mi, porttitor sit amet condimentum a, varius ut erat. Quisque congue tempor lectus, sit amet lacinia odio hendrerit et. Praesent non finibus sem. Curabitur laoreet rutrum maximus. Suspendisse sagittis id nulla euismod consequat. Maecenas eget lacinia mi. Aliquam sem lacus, dignissim nec convallis vel, blandit vitae mauris. Morbi tincidunt sodales diam et egestas. Duis dapibus vestibulum sapien, at ornare mi scelerisque at. Morbi sagittis auctor odio.

Sed sollicitudin sem eu sem mattis fermentum. Nullam pharetra felis a nisl congue iaculis. Phasellus non sem vitae nunc fermentum iaculis. Sed lacinia sem at magna posuere, eu pellentesque elit pellentesque. Aenean tristique pulvinar dui at iaculis. Vivamus scelerisque semper vestibulum. Mauris laoreet, leo at venenatis posuere, sapien magna sollicitudin justo, ut vestibulum nunc urna vitae felis. Nam id fermentum massa. Cras aliquet libero non enim dictum, ac elementum nulla pretium. Quisque scelerisque diam id metus aliquet vestibulum ut ac quam.

Integer posuere leo eget tempor accumsan. Integer varius aliquam convallis. Aenean turpis ex, maximus eget eleifend nec, cursus et ligula. Suspendisse cursus malesuada enim id finibus. Pellentesque dictum tortor nunc, vel vehicula turpis posuere vitae. Aenean nibh neque, dapibus quis justo eu, aliquam congue neque. Fusce et rutrum eros. Morbi dapibus, tortor a egestas egestas, mauris nisi lacinia nisi, vel mattis nibh lorem eget lectus. Nam scelerisque nunc sem, ut volutpat felis suscipit feugiat.

Proin vulputate viverra convallis. Duis libero odio, aliquet sit amet elit vel, fringilla rutrum quam. Fusce rutrum rutrum justo. Etiam ipsum est, mollis quis interdum quis, lobortis eu diam. Mauris facilisis id nunc id interdum. Etiam posuere nisl eget magna efficitur efficitur. Mauris nec lacus vitae mauris aliquam vulputate vitae id ex. Vivamus nibh dui, hendrerit a mauris placerat, molestie porttitor purus. Nulla a hendrerit velit. Mauris mollis augue turpis, interdum auctor turpis tempus nec. Pellentesque non magna eget massa commodo accumsan at posuere orci. Vivamus vel mollis ipsum, vitae viverra quam. Nam consectetur consectetur tortor placerat dictum. Nulla euismod consectetur luctus. Duis euismod congue dolor id tincidunt.',
                    'evento_id' => 1,
                    'tipo_atividade_id' => 1,
                    'created_at' => '2022-05-28 11:31:42',
                    'updated_at' => '2022-05-28 11:31:42',
                    'url' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'nome' => 'Minicurso PHP',
                    'data' => '2022-11-02',
                    'horario_inicio' => '09:00:00',
                    'horario_fim' => '13:30:00',
                    'local' => 'Meet',
                    'link_tranmissao' => NULL,
                    'imagem' => NULL,
                    'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae vehicula nulla. Nulla suscipit, enim a eleifend pellentesque, nisl risus cursus felis, quis facilisis justo sem nec purus. Curabitur consectetur dui ac dolor malesuada, in pellentesque metus viverra. Curabitur imperdiet risus ac interdum ultrices. Ut volutpat facilisis consectetur. Morbi condimentum felis non diam scelerisque, vitae feugiat erat hendrerit. Nullam odio tortor, volutpat faucibus hendrerit nec, tempus et velit. Suspendisse aliquet ligula in leo placerat, at eleifend metus accumsan. Aliquam erat volutpat.

Nullam ultricies tristique neque. Etiam aliquam orci sed felis laoreet dapibus. Donec metus magna, fringilla in venenatis eget, pulvinar quis libero. Mauris metus mi, porttitor sit amet condimentum a, varius ut erat. Quisque congue tempor lectus, sit amet lacinia odio hendrerit et. Praesent non finibus sem. Curabitur laoreet rutrum maximus. Suspendisse sagittis id nulla euismod consequat. Maecenas eget lacinia mi. Aliquam sem lacus, dignissim nec convallis vel, blandit vitae mauris. Morbi tincidunt sodales diam et egestas. Duis dapibus vestibulum sapien, at ornare mi scelerisque at. Morbi sagittis auctor odio.

Sed sollicitudin sem eu sem mattis fermentum. Nullam pharetra felis a nisl congue iaculis. Phasellus non sem vitae nunc fermentum iaculis. Sed lacinia sem at magna posuere, eu pellentesque elit pellentesque. Aenean tristique pulvinar dui at iaculis. Vivamus scelerisque semper vestibulum. Mauris laoreet, leo at venenatis posuere, sapien magna sollicitudin justo, ut vestibulum nunc urna vitae felis. Nam id fermentum massa. Cras aliquet libero non enim dictum, ac elementum nulla pretium. Quisque scelerisque diam id metus aliquet vestibulum ut ac quam.

Integer posuere leo eget tempor accumsan. Integer varius aliquam convallis. Aenean turpis ex, maximus eget eleifend nec, cursus et ligula. Suspendisse cursus malesuada enim id finibus. Pellentesque dictum tortor nunc, vel vehicula turpis posuere vitae. Aenean nibh neque, dapibus quis justo eu, aliquam congue neque. Fusce et rutrum eros. Morbi dapibus, tortor a egestas egestas, mauris nisi lacinia nisi, vel mattis nibh lorem eget lectus. Nam scelerisque nunc sem, ut volutpat felis suscipit feugiat.

Proin vulputate viverra convallis. Duis libero odio, aliquet sit amet elit vel, fringilla rutrum quam. Fusce rutrum rutrum justo. Etiam ipsum est, mollis quis interdum quis, lobortis eu diam. Mauris facilisis id nunc id interdum. Etiam posuere nisl eget magna efficitur efficitur. Mauris nec lacus vitae mauris aliquam vulputate vitae id ex. Vivamus nibh dui, hendrerit a mauris placerat, molestie porttitor purus. Nulla a hendrerit velit. Mauris mollis augue turpis, interdum auctor turpis tempus nec. Pellentesque non magna eget massa commodo accumsan at posuere orci. Vivamus vel mollis ipsum, vitae viverra quam. Nam consectetur consectetur tortor placerat dictum. Nulla euismod consectetur luctus. Duis euismod congue dolor id tincidunt.',
                    'evento_id' => 1,
                    'tipo_atividade_id' => 1,
                    'created_at' => '2022-05-28 11:31:42',
                    'updated_at' => '2022-05-28 11:31:42',
                    'url' => 'http://meet.google.com/abc-def-ghi',
                ),
            2 =>
                array(
                    'id' => 3,
                    'nome' => 'Apresentação',
                    'data' => '2022-11-20',
                    'horario_inicio' => '16:30:00',
                    'horario_fim' => '19:00:00',
                    'local' => 'Teams',
                    'link_tranmissao' => NULL,
                    'imagem' => NULL,
                    'descricao' => 'Apresentação',
                    'evento_id' => 2,
                    'tipo_atividade_id' => 1,
                    'created_at' => '2022-05-30 19:02:08',
                    'updated_at' => '2022-05-30 19:02:08',
                    'url' => 'http://teams.com',
                ),
            3 =>
                array(
                    'id' => 4,
                    'nome' => 'Minicurso',
                    'data' => '2022-11-24',
                    'horario_inicio' => '17:45:00',
                    'horario_fim' => '18:45:00',
                    'local' => 'Meet',
                    'link_tranmissao' => NULL,
                    'imagem' => NULL,
                    'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae vehicula nulla. Nulla suscipit, enim a eleifend pellentesque, nisl risus cursus felis, quis facilisis justo sem nec purus. Curabitur consectetur dui ac dolor malesuada, in pellentesque metus viverra. Curabitur imperdiet risus ac interdum ultrices. Ut volutpat facilisis consectetur. Morbi condimentum felis non diam scelerisque, vitae feugiat erat hendrerit. Nullam odio tortor, volutpat faucibus hendrerit nec, tempus et velit. Suspendisse aliquet ligula in leo placerat, at eleifend metus accumsan. Aliquam erat volutpat. Nullam ultricies tristique neque. Etiam aliquam orci sed felis laoreet dapibus. Donec metus magna, fringilla in venenatis eget, pulvinar quis libero. Mauris metus mi, porttitor sit amet condimentum a, varius ut erat. Quisque congue tempor lectus, sit amet lacinia odio hendrerit et. Praesent non finibus sem. Curabitur laoreet rutrum maximus. Suspendisse sagittis id nulla euismod consequat. Maecenas eget lacinia mi. Aliquam sem lacus, dignissim nec convallis vel, blandit vitae mauris. Morbi tincidunt sodales diam et egestas. Duis dapibus vestibulum sapien, at ornare mi scelerisque at. Morbi sagittis auctor odio. Sed sollicitudin sem eu sem mattis fermentum. Nullam pharetra felis a nisl congue iaculis. Phasellus non sem vitae nunc fermentum iaculis. Sed lacinia sem at magna posuere, eu pellentesque elit pellentesque. Aenean tristique pulvinar dui at iaculis. Vivamus scelerisque semper vestibulum. Mauris laoreet, leo at venenatis posuere, sapien magna sollicitudin justo, ut vestibulum nunc urna vitae felis. Nam id fermentum massa. Cras aliquet libero non enim dictum, ac elementum nulla pretium. Quisque scelerisque diam id metus aliquet vestibulum ut ac quam. Integer posuere leo eget tempor accumsan. Integer varius aliquam convallis. Aenean turpis ex, maximus eget eleifend nec, cursus et ligula. Suspendisse cursus malesuada enim id finibus. Pellentesque dictum tortor nunc, vel vehicula turpis posuere vitae. Aenean nibh neque, dapibus quis justo eu, aliquam congue neque. Fusce et rutrum eros. Morbi dapibus, tortor a egestas egestas, mauris nisi lacinia nisi, vel mattis nibh lorem eget lectus. Nam scelerisque nunc sem, ut volutpat felis suscipit feugiat. Proin vulputate viverra convallis. Duis libero odio, aliquet sit amet elit vel, fringilla rutrum quam. Fusce rutrum rutrum justo. Etiam ipsum est, mollis quis interdum quis, lobortis eu diam. Mauris facilisis id nunc id interdum. Etiam posuere nisl eget magna efficitur efficitur. Mauris nec lacus vitae mauris aliquam vulputate vitae id ex. Vivamus nibh dui, hendrerit a mauris placerat, molestie porttitor purus. Nulla a hendrerit velit. Mauris mollis augue turpis, interdum auctor turpis tempus nec. Pellentesque non magna eget massa commodo accumsan at posuere orci. Vivamus vel mollis ipsum, vitae viverra quam. Nam consectetur consectetur tortor placerat dictum. Nulla euismod consectetur luctus. Duis euismod congue dolor id tincidunt.',
                    'evento_id' => 3,
                    'tipo_atividade_id' => 1,
                    'created_at' => '2022-05-30 19:05:42',
                    'updated_at' => '2022-05-30 19:05:42',
                    'url' => 'http://meet.google.com',
                ),
        ));


    }
}
