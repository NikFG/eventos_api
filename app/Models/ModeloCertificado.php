<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModeloCertificado extends Model {
    use HasFactory;

    public function instituicao(): BelongsTo {
        return $this->belongsTo(Instituicao::class);
    }
    //relation with certificado
    public function certificados(): HasMany {
        return $this->hasMany(Certificado::class);
    }
}
