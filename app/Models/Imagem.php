<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagem extends Model {
    protected $table = "imagens";
    use HasFactory;

    public function evento() {
        return $this->belongsTo(Evento::class);
    }

    public function tipo() {
        return $this->belongsTo(TipoImagem::class);
    }
}
