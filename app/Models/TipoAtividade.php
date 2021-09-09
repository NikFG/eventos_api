<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoAtividade extends Model {
    use HasFactory;
    use SoftDeletes;

    public function atividades() {
        return $this->hasMany(Atividade::class);
    }
}
