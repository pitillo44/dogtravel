<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mascotasPersonas extends Model
{
    use HasFactory;
    protected $table = 'mascotas_personas';


    public function personas(){
        return $this->belongsTo(personas::class,'id_persona','id_persona');
    }

    public function mascota(){
        return $this->belongsTo(Mascotas::class,'id_mascota','id_mascota');
    }

}
