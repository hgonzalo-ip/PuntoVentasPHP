<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
  protected $table = 'productos';
  protected $primaryKey = 'IdProducto';

    
    public $timestamps = false;

    public function TipoProducto(){
        return $this->belongsTo(TipoProducto::class, 'IdTipoProducto', 'IdTipoProducto');
    }
    public function Proveedor(){
        return $this->belongsTo(Proveedores::class, 'IdProveedor', 'IdProveedor');
    }
    public function Color(){
        return $this->belongsTo(Color::class, 'IdColor', 'IdColor');
    }
    public function DesEstado(){
        return $this->belongsTo(Estado::class, 'Estado', 'IdEstado');
    }
}
