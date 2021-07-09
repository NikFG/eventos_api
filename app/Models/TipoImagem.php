<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoImagem extends Model {
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tipo_imagens';

    public function imagens() {
        return $this->hasMany(Imagem::class);
    }
}
