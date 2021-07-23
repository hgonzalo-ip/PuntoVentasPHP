<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table = 'tipousuario';
    protected $primaryKey = 'IdTipoUsuario';

    public $timestamps = false;

    public function DesEstado(){
        return $this->belongsTo(Estado::class, 'Estado','IdEstado');
    }
    
}
