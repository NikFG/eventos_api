<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function atividades() {
        return $this->hasMany(Atividade::class, 'participante_id');
    }

    public function certificados() {
        return $this->hasMany(Certificado::class, 'participante_id');
    }

    public function eventos() {
        return $this->hasMany(Evento::class);
    }

    public function instituicoes() {
        return $this->hasOne(Instituicao::class, 'administrador_id');
    }


}
