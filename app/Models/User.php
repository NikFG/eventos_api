<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail {
    use HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'api';

    protected $fillable = [
        'nome',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
        'cpf'
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function atividades() {
        return $this->belongsToMany(Atividade::class, 'participante_atividades', 'user_id');
    }

    public function certificados() {
        return $this->hasMany(Certificado::class, 'participante_id');
    }

    public function eventos() {
        return $this->hasMany(Evento::class);
    }

    public function instituicao() {
        return $this->belongsTo(Instituicao::class);
    }


    public function getJWTIdentifier() {
        return $this->getKey();
    }


    public function getJWTCustomClaims() {
        return [];
    }
}
