<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model {

    protected $table = 'instituicoes';
    use HasFactory;

    public function certificados() {
        return $this->hasMany(Certificado::class);
    }

    public function eventos() {
        return $this->hasMany(Evento::class);
    }

    public function administrador() {
        return $this->belongsTo(User::class, 'administrador_id');
    }

    public function associados($admin_id) {
        return $this->hasMany(User::class)->where('id', '!=', $admin_id);
    }
}
