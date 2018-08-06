<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'apellido', 'cedula','direccion','telefono',
    ];
}
