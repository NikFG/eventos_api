<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipanteAtividade extends Model {
    use HasFactory;

    public function atividades() {
        return $this->belongsToMany(Atividade::class, ParticipanteAtividade::class, 'atividade_id', 'participante_id');
    }

    public function participantes() {
        return $this->belongsToMany(User::class, ParticipanteAtividade::class, 'participante_id', 'atividade_id');
    }

}
