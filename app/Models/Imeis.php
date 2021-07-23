<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imeis extends Model
{
    protected $table = 'imeis';
    protected $primaryKey = 'IdImei';

    public $timestamps = false;

    public function Productos(){

        return $this->belongsTo(Productos::class, 'IdProducto', 'IdProducto');
    }

}
