<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'IdUsuario';
    protected $fillable = [
        'IdTipoUsuario',
        'IdSucursal',
        'Nombres',
        'Apellidos',
        'Telefono',
        'DPI',
        'name',
        'email',
        'password',
        'Estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function TipoUsuario(){
        return $this->belongsTo(TipoUsuario::class, 'IdTipoUsuario', 'IdTipoUsuario');
    }
    public function Sucursales(){
        return $this->belongsTo(Sucursal::class, 'IdSucursal', 'IdSucursal');
    }
    public function DescEstado(){
        return $this->belongsTo(Estado::class, 'Estado', 'IdEstado');
    }

}
