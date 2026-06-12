<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'rol', 'status', 'telefono'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function esAdministrador(): bool
    {
        return $this->rol === 'administrador';
    }

    public function esTrabajador(): bool
    {
        return $this->rol === 'trabajador';
    }

    public function esActivo(): bool
    {
        return $this->status === 'activo';
    }

    public function redireccionar(): string
    {
        return match ($this->rol) {
            'administrador' => route('admin.dashboard'),
            'trabajador' => route('trabajador.dashboard'),
            default => route('dashboard'),
        };
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class);
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class);
    }
}
