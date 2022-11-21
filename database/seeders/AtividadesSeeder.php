<?php

namespace Database\Seeders;

use App\Models\Atividade;
use Illuminate\Database\Seeder;

class AtividadesSeeder extends Seeder {

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {


        \DB::table('atividades')->delete();

        $atividade = new Atividade();
        $atividade->nome = 'Introdução ao evento';
        $atividade->data = '2022-12-01';
        $atividade->horario_inicio = '10:30:00';
        $atividade->horario_fim = '11:30:00';
        $atividade->local = 'Meet';
        $atividade->descricao = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae vehicula nulla. Nulla suscipit, enim a eleifend pellentesque, nisl risus cursus felis, quis facilisis justo sem nec purus. Curabitur consectetur dui ac dolor malesuada, in pellentesque metus viverra. Curabitur imperdiet risus ac interdum ultrices. Ut volutpat facilisis consectetur. Morbi condimentum felis non diam scelerisque, vitae feugiat erat hendrerit. Nullam odio tortor, volutpat faucibus hendrerit nec, tempus et velit. Suspendisse aliquet ligula in leo placerat, at eleifend metus accumsan. Aliquam erat volutpat.

        Nullam ultricies tristique neque. Etiam aliquam orci sed felis laoreet dapibus. Donec metus magna, fringilla in venenatis eget, pulvinar quis libero. Mauris metus mi, porttitor sit amet condimentum a, varius ut erat. Quisque congue tempor lectus, sit amet lacinia odio hendrerit et. Praesent non finibus sem. Curabitur laoreet rutrum maximus. Suspendisse sagittis id nulla euismod consequat. Maecenas eget lacinia mi. Aliquam sem lacus, dignissim nec convallis vel, blandit vitae mauris. Morbi tincidunt sodales diam et egestas. Duis dapibus vestibulum sapien, at ornare mi scelerisque at. Morbi sagittis auctor odio.

        Sed sollicitudin sem eu sem mattis fermentum. Nullam pharetra felis a nisl congue iaculis. Phasellus non sem vitae nunc fermentum iaculis. Sed lacinia sem at magna posuere, eu pellentesque elit pellentesque. Aenean tristique pulvinar dui at iaculis. Vivamus scelerisque semper vestibulum. Mauris laoreet, leo at venenatis posuere, sapien magna sollicitudin justo, ut vestibulum nunc urna vitae felis. Nam id fermentum massa. Cras aliquet libero non enim dictum, ac elementum nulla pretium. Quisque scelerisque diam id metus aliquet vestibulum ut ac quam.

        Integer posuere leo eget tempor accumsan. Integer varius aliquam convallis. Aenean turpis ex, maximus eget eleifend nec, cursus et ligula. Suspendisse cursus malesuada enim id finibus. Pellentesque dictum tortor nunc, vel vehicula turpis posuere vitae. Aenean nibh neque, dapibus quis justo eu, aliquam congue neque. Fusce et rutrum eros. Morbi dapibus, tortor a egestas egestas, mauris nisi lacinia nisi, vel mattis nibh lorem eget lectus. Nam scelerisque nunc sem, ut volutpat felis suscipit feugiat.

        Proin vulputate viverra convallis. Duis libero odio, aliquet sit amet elit vel, fringilla rutrum quam. Fusce rutrum rutrum justo. Etiam ipsum est, mollis quis interdum quis, lobortis eu diam. Mauris facilisis id nunc id interdum. Etiam posuere nisl eget magna efficitur efficitur. Mauris nec lacus vitae mauris aliquam vulputate vitae id ex. Vivamus nibh dui, hendrerit a mauris placerat, molestie porttitor purus. Nulla a hendrerit velit. Mauris mollis augue turpis, interdum auctor turpis tempus nec. Pellentesque non magna eget massa commodo accumsan at posuere orci. Vivamus vel mollis ipsum, vitae viverra quam. Nam consectetur consectetur tortor placerat dictum. Nulla euismod consectetur luctus. Duis euismod congue dolor id tincidunt.';
        $atividade->evento_id = 1;
        $atividade->tipo_atividade_id = 1;

        $atividade->save();

        $atividade = new Atividade();
        $atividade->nome = 'Minicurso PHP';
        $atividade->data = '2022-12-02';
        $atividade->horario_inicio = '09:30:00';
        $atividade->horario_fim = '13:30:00';
        $atividade->local = 'Meet';
        $atividade->descricao = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae vehicula nulla. Nulla suscipit, enim a eleifend pellentesque, nisl risus cursus felis, quis facilisis justo sem nec purus. Curabitur consectetur dui ac dolor malesuada, in pellentesque metus viverra. Curabitur imperdiet risus ac interdum ultrices. Ut volutpat facilisis consectetur. Morbi condimentum felis non diam scelerisque, vitae feugiat erat hendrerit. Nullam odio tortor, volutpat faucibus hendrerit nec, tempus et velit. Suspendisse aliquet ligula in leo placerat, at eleifend metus accumsan. Aliquam erat volutpat.

        Nullam ultricies tristique neque. Etiam aliquam orci sed felis laoreet dapibus. Donec metus magna, fringilla in venenatis eget, pulvinar quis libero. Mauris metus mi, porttitor sit amet condimentum a, varius ut erat. Quisque congue tempor lectus, sit amet lacinia odio hendrerit et. Praesent non finibus sem. Curabitur laoreet rutrum maximus. Suspendisse sagittis id nulla euismod consequat. Maecenas eget lacinia mi. Aliquam sem lacus, dignissim nec convallis vel, blandit vitae mauris. Morbi tincidunt sodales diam et egestas. Duis dapibus vestibulum sapien, at ornare mi scelerisque at. Morbi sagittis auctor odio.

        Sed sollicitudin sem eu sem mattis fermentum. Nullam pharetra felis a nisl congue iaculis. Phasellus non sem vitae nunc fermentum iaculis. Sed lacinia sem at magna posuere, eu pellentesque elit pellentesque. Aenean tristique pulvinar dui at iaculis. Vivamus scelerisque semper vestibulum. Mauris laoreet, leo at venenatis posuere, sapien magna sollicitudin justo, ut vestibulum nunc urna vitae felis. Nam id fermentum massa. Cras aliquet libero non enim dictum, ac elementum nulla pretium. Quisque scelerisque diam id metus aliquet vestibulum ut ac quam.

        Integer posuere leo eget tempor accumsan. Integer varius aliquam convallis. Aenean turpis ex, maximus eget eleifend nec, cursus et ligula. Suspendisse cursus malesuada enim id finibus. Pellentesque dictum tortor nunc, vel vehicula turpis posuere vitae. Aenean nibh neque, dapibus quis justo eu, aliquam congue neque. Fusce et rutrum eros. Morbi dapibus, tortor a egestas egestas, mauris nisi lacinia nisi, vel mattis nibh lorem eget lectus. Nam scelerisque nunc sem, ut volutpat felis suscipit feugiat.

        Proin vulputate viverra convallis. Duis libero odio, aliquet sit amet elit vel, fringilla rutrum quam. Fusce rutrum rutrum justo. Etiam ipsum est, mollis quis interdum quis, lobortis eu diam. Mauris facilisis id nunc id interdum. Etiam posuere nisl eget magna efficitur efficitur. Mauris nec lacus vitae mauris aliquam vulputate vitae id ex. Vivamus nibh dui, hendrerit a mauris placerat, molestie porttitor purus. Nulla a hendrerit velit. Mauris mollis augue turpis, interdum auctor turpis tempus nec. Pellentesque non magna eget massa commodo accumsan at posuere orci. Vivamus vel mollis ipsum, vitae viverra quam. Nam consectetur consectetur tortor placerat dictum. Nulla euismod consectetur luctus. Duis euismod congue dolor id tincidunt.';
        $atividade->evento_id = 1;
        $atividade->tipo_atividade_id = 1;
        $atividade->url = 'http://meet.google.com/abc-def-ghi';
        $atividade->save();

        $atividade = new Atividade();
        $atividade->nome = 'Apresentação';
        $atividade->data = '2022-12-03';
        $atividade->horario_inicio = '16:30:00';
        $atividade->horario_fim = '19:00:00';
        $atividade->local = 'Meet';
        $atividade->descricao = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae vehicula nulla. Nulla suscipit, enim a eleifend pellentesque, nisl risus cursus felis, quis facilisis justo sem nec purus. Curabitur consectetur dui ac dolor malesuada, in pellentesque metus viverra. Curabitur imperdiet risus ac interdum ultrices. Ut volutpat facilisis consectetur. Morbi condimentum felis non diam scelerisque, vitae feugiat erat hendrerit. Nullam odio tortor, volutpat faucibus hendrerit nec, tempus et velit. Suspendisse aliquet ligula in leo placerat, at eleifend metus accumsan. Aliquam erat volutpat.

        Nullam ultricies tristique neque. Etiam aliquam orci sed felis laoreet dapibus. Donec metus magna, fringilla in venenatis eget, pulvinar quis libero. Mauris metus mi, porttitor sit amet condimentum a, varius ut erat. Quisque congue tempor lectus, sit amet lacinia odio hendrerit et. Praesent non finibus sem. Curabitur laoreet rutrum maximus. Suspendisse sagittis id nulla euismod consequat. Maecenas eget lacinia mi. Aliquam sem lacus, dignissim nec convallis vel, blandit vitae mauris. Morbi tincidunt sodales diam et egestas. Duis dapibus vestibulum sapien, at ornare mi scelerisque at. Morbi sagittis auctor odio.

        Sed sollicitudin sem eu sem mattis fermentum. Nullam pharetra felis a nisl congue iaculis. Phasellus non sem vitae nunc fermentum iaculis. Sed lacinia sem at magna posuere, eu pellentesque elit pellentesque. Aenean tristique pulvinar dui at iaculis. Vivamus scelerisque semper vestibulum. Mauris laoreet, leo at venenatis posuere, sapien magna sollicitudin justo, ut vestibulum nunc urna vitae felis. Nam id fermentum massa. Cras aliquet libero non enim dictum, ac elementum nulla pretium. Quisque scelerisque diam id metus aliquet vestibulum ut ac quam.

        Integer posuere leo eget tempor accumsan. Integer varius aliquam convallis. Aenean turpis ex, maximus eget eleifend nec, cursus et ligula. Suspendisse cursus malesuada enim id finibus. Pellentesque dictum tortor nunc, vel vehicula turpis posuere vitae. Aenean nibh neque, dapibus quis justo eu, aliquam congue neque. Fusce et rutrum eros. Morbi dapibus, tortor a egestas egestas, mauris nisi lacinia nisi, vel mattis nibh lorem eget lectus. Nam scelerisque nunc sem, ut volutpat felis suscipit feugiat.

        Proin vulputate viverra convallis. Duis libero odio, aliquet sit amet elit vel, fringilla rutrum quam. Fusce rutrum rutrum justo. Etiam ipsum est, mollis quis interdum quis, lobortis eu diam. Mauris facilisis id nunc id interdum. Etiam posuere nisl eget magna efficitur efficitur. Mauris nec lacus vitae mauris aliquam vulputate vitae id ex. Vivamus nibh dui, hendrerit a mauris placerat, molestie porttitor purus. Nulla a hendrerit velit. Mauris mollis augue turpis, interdum auctor turpis tempus nec. Pellentesque non magna eget massa commodo accumsan at posuere orci. Vivamus vel mollis ipsum, vitae viverra quam. Nam consectetur consectetur tortor placerat dictum. Nulla euismod consectetur luctus. Duis euismod congue dolor id tincidunt.';
        $atividade->evento_id = 2;
        $atividade->tipo_atividade_id = 1;
        $atividade->url = 'http://teams.com';
        $atividade->save();


        $atividade = new Atividade();
        $atividade->nome = 'Minicurso';
        $atividade->data = '2022-12-04';
        $atividade->horario_inicio = '17:45:00';
        $atividade->horario_fim = '18:00:00';
        $atividade->local = 'Meet';
        $atividade->descricao = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae vehicula nulla. Nulla suscipit, enim a eleifend pellentesque, nisl risus cursus felis, quis facilisis justo sem nec purus. Curabitur consectetur dui ac dolor malesuada, in pellentesque metus viverra. Curabitur imperdiet risus ac interdum ultrices. Ut volutpat facilisis consectetur. Morbi condimentum felis non diam scelerisque, vitae feugiat erat hendrerit. Nullam odio tortor, volutpat faucibus hendrerit nec, tempus et velit. Suspendisse aliquet ligula in leo placerat, at eleifend metus accumsan. Aliquam erat volutpat.

        Nullam ultricies tristique neque. Etiam aliquam orci sed felis laoreet dapibus. Donec metus magna, fringilla in venenatis eget, pulvinar quis libero. Mauris metus mi, porttitor sit amet condimentum a, varius ut erat. Quisque congue tempor lectus, sit amet lacinia odio hendrerit et. Praesent non finibus sem. Curabitur laoreet rutrum maximus. Suspendisse sagittis id nulla euismod consequat. Maecenas eget lacinia mi. Aliquam sem lacus, dignissim nec convallis vel, blandit vitae mauris. Morbi tincidunt sodales diam et egestas. Duis dapibus vestibulum sapien, at ornare mi scelerisque at. Morbi sagittis auctor odio.

        Sed sollicitudin sem eu sem mattis fermentum. Nullam pharetra felis a nisl congue iaculis. Phasellus non sem vitae nunc fermentum iaculis. Sed lacinia sem at magna posuere, eu pellentesque elit pellentesque. Aenean tristique pulvinar dui at iaculis. Vivamus scelerisque semper vestibulum. Mauris laoreet, leo at venenatis posuere, sapien magna sollicitudin justo, ut vestibulum nunc urna vitae felis. Nam id fermentum massa. Cras aliquet libero non enim dictum, ac elementum nulla pretium. Quisque scelerisque diam id metus aliquet vestibulum ut ac quam.

        Integer posuere leo eget tempor accumsan. Integer varius aliquam convallis. Aenean turpis ex, maximus eget eleifend nec, cursus et ligula. Suspendisse cursus malesuada enim id finibus. Pellentesque dictum tortor nunc, vel vehicula turpis posuere vitae. Aenean nibh neque, dapibus quis justo eu, aliquam congue neque. Fusce et rutrum eros. Morbi dapibus, tortor a egestas egestas, mauris nisi lacinia nisi, vel mattis nibh lorem eget lectus. Nam scelerisque nunc sem, ut volutpat felis suscipit feugiat.

        Proin vulputate viverra convallis. Duis libero odio, aliquet sit amet elit vel, fringilla rutrum quam. Fusce rutrum rutrum justo. Etiam ipsum est, mollis quis interdum quis, lobortis eu diam. Mauris facilisis id nunc id interdum. Etiam posuere nisl eget magna efficitur efficitur. Mauris nec lacus vitae mauris aliquam vulputate vitae id ex. Vivamus nibh dui, hendrerit a mauris placerat, molestie porttitor purus. Nulla a hendrerit velit. Mauris mollis augue turpis, interdum auctor turpis tempus nec. Pellentesque non magna eget massa commodo accumsan at posuere orci. Vivamus vel mollis ipsum, vitae viverra quam. Nam consectetur consectetur tortor placerat dictum. Nulla euismod consectetur luctus. Duis euismod congue dolor id tincidunt.';
        $atividade->evento_id = 3;
        $atividade->tipo_atividade_id = 1;
        $atividade->url = 'http://meet.google.com';
        $atividade->save();

    }
}
