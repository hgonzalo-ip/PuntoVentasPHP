<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colores';
    protected $primaryKey = 'IdColor';

    public $timestamps = false;

    public function DesEstado(){
        return $this->belongsTo(Estado::class, 'Estado','IdEstado');
    }
}
