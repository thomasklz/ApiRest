<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'comentario', 'fechacreacion'
    ];

    public function personas()
    {
        return $this->belongsTo(Personas::class);
    }
}
