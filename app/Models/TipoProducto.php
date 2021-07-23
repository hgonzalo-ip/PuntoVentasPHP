<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    protected $table = 'tipoproductos';
    protected $primaryKey = 'IdTipoProducto';

    public $timestamps = false;

    public function DesEstado(){
        return $this->belongsTo(Estado::class, 'Estado', 'IdEstado');
    }
}
