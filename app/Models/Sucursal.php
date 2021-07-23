<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    protected $primaryKey = 'IdSucursal';

    public $timestamps = false;
    
    public function DesEstado(){
        return $this->belongsTo(Estado::class, 'Estado','IdEstado');
    }
}
