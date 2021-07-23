<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'IdVenta';

    public $timestamps = false;

    public function User(){
        return $this->belongsTo(User::class,'IdUsuario','IdUsuario');
    }
    
        public function Clientes(){
            return $this->hasMany(Clientes::class, 'IdCliente','IdCliente');
        }
        public function DetalleVenta(){
            return $this->hasMany(DetalleVenta::class,'IdVenta','IdVenta');
        }
}
