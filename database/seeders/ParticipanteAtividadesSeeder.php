<?php

namespace Database\Seeders;

use App\Models\ParticipanteAtividade;
use Illuminate\Database\Seeder;

class ParticipanteAtividadesSeeder extends Seeder {

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {


        \DB::table('participante_atividades')->delete();

        $participante = new ParticipanteAtividade();
        $participante->participou = 0;
        $participante->atividade_id = 1;
        $participante->apresentador_id = 1;
        $participante->save();

        $participante = new ParticipanteAtividade();
        $participante->participou = 0;
        $participante->user_id = 2;
        $participante->atividade_id = 2;
        $participante->apresentador_id = 2;
        $participante->save();

        $participante = new ParticipanteAtividade();
        $participante->participou = 0;
        $participante->atividade_id = 2;
        $participante->apresentador_id = 3;
        $participante->save();

        $participante = new ParticipanteAtividade();
        $participante->participou = 0;
        $participante->user_id = 2;
        $participante->atividade_id = 3;
        $participante->apresentador_id = 4;
        $participante->save();

        $participante = new ParticipanteAtividade();
        $participante->participou = 0;
        $participante->user_id = 2;
        $participante->atividade_id = 4;
        $participante->apresentador_id = 5;
        $participante->save();



    }
}
