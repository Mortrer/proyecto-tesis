<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'norden',
        'id_cliente',
        'id_equipo',
        'fecha_estimada',
        'comentarios'
    ];
    protected $primaryKey = 'norden';

}
