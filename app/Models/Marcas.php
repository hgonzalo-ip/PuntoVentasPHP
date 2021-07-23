<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    protected $table = 'marcas';
    protected $primaryKey = 'IdMarca';

    public $timestamps = false;

    public function DesEstado(){
        return $this->belongsTo(Estado::class, 'Estado','IdEstado');
    }
}
