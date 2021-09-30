<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model {
    use HasFactory;
    use SoftDeletes;

    public function atividades() {
        return $this->hasMany(Atividade::class)->with('users');
    }

    public function certificados() {
        return $this->hasMany(Certificado::class);
    }

    public function imagens(){
        return $this->hasMany(Imagem::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function tipo() {
        return $this->belongsTo(TipoEvento::class);
    }

    public function instituicao() {
        return $this->belongsTo(Instituicao::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
