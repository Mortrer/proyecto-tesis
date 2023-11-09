<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viewOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'norden',
        'estado'
    ];
}
