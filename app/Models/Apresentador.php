<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apresentador extends Model {
    use HasFactory;

    protected $table = 'apresentadores';


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function atividade() {
        return $this->belongsTo(Atividade::class);
    }
    public function apresentador() {
        return $this->belongsTo(Apresentador::class);
    }
}
