<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cost extends Model
{
    use HasFactory;
    protected $fillable = ['id_orden', 'precio', 'estado', 'descripcion'];
}
