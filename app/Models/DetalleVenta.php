<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalleventa';
    protected $primaryKey = 'IdDetalleVenta';
 
    public $timestamps = false;
    public function Venta(){
        return $this->belongsTo(Ventas::class,'IdCompra','IdCompra');
        // return $this->belongsTo(Ventas::class,'IdCompra','IdCompra');
    }
    public function Productos(){
        return $this->belongsTo(Productos::class,'IdProducto','IdProducto');
    }
}
