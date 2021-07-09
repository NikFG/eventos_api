<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividade extends Model {
    use HasFactory;

    public function evento() {
        return $this->belongsTo(Evento::class);
    }

    public function apresentador() {
        return $this->belongsTo(User::class, 'apresentador_id');
    }

    public function tipo_atividade() {
        return $this->belongsTo(TipoAtividade::class);
    }

    public function certificados() {
        return $this->hasMany(Certificado::class);
    }


}
