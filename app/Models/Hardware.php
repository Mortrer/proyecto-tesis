<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    use HasFactory;
    protected $filleable = ['serial', 'id_cliente', 'almacenamiento', 'ram', 'procesador', 'h_detalles', 'estado'];
    protected $primaryKey = 'serial';
}
