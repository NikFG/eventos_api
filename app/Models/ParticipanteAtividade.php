<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipanteAtividade extends Model {
    use HasFactory;

    public function atividades() {
        return $this->belongsToMany(Atividade::class, ParticipanteAtividade::class, 'atividade_id');
    }

    public function participantes() {
        return $this->belongsToMany(User::class, ParticipanteAtividade::class, 'user_id');
    }

}
