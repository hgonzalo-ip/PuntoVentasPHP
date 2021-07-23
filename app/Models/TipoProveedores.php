<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProveedores extends Model
{
    protected $table  = 'tipoproveedor';
    protected $primaryKey = 'IdTipoProveedor'; 
    public $timestamps = false;
}
