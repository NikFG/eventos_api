<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividade extends Model {
    use HasFactory;

    protected $casts = [
        'data' => 'date:d/m/Y',
        'horario_inicio' => 'date:H:i',
        'horario_fim' => 'date:H:i',
    ];

    public function evento() {
        return $this->belongsTo(Evento::class);
    }

    public function apresentadores() {
        return $this->hasMany(Apresentador::class);
    }

    public function tipo_atividade() {
        return $this->belongsTo(TipoAtividade::class);
    }

    public function certificados() {
        return $this->hasMany(Certificado::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, ParticipanteAtividade::class)->withPivot(['participou', 'apresentador']);
    }

}
