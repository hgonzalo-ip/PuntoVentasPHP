<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'IdCompra';

    public $timestamps = false;

    public function User(){
        return $this->belongsTo(User::class,'IdUsuario','IdUsuario');
    }
    public function DetalleCompra(){
        return $this->hasMany(DetalleCompra::class,'IdCompra','IdCompra');
    }
}
