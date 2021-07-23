<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'IdProveedor';

    public $timestamps = false;

    public function DesEstado(){
        return $this->belongsTo(Estado::class, 'Estado','IdEstado');
    }
}
