<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleMarca extends Model
{
    protected $table = 'detallemarca';
    protected $primaryKey = 'IdDetalleMarca';

    public $timestamps = false;

    public function Proveedor(){
        return $this->belongsTo(Proveedores::class, 'IdProveedor', 'IdProveedor');
    }
    public function Marca(){
        return $this->belongsTo(Marca::class, 'IdMarca', 'IdMarca');
    }
}
