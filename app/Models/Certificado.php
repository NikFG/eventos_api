<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificado extends Model {
    use HasFactory;

    public function participante() {
        return $this->belongsTo(User::class, 'participante_id');
    }

    public function apresentador() {
        return $this->belongsTo(Apresentador::class, 'apresentador_id');
    }

    public function evento() {
        return $this->belongsTo(Evento::class);
    }

    public function instituicao() {
        return $this->belongsTo(Instituicao::class);
    }

    public function atividade() {
        return $this->belongsTo(Atividade::class);
    }

    public function modeloCertificado(): BelongsTo {
        return $this->belongsTo(ModeloCertificado::class);
    }

}
