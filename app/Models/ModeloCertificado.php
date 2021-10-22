<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloCertificado extends Model {
    use HasFactory;

    public function instituicao() {
        return $this->belongsTo(Instituicao::class);
    }
}
