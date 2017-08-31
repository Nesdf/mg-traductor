<?php

namespace Modules\MgTraductor\Entities;

use Illuminate\Database\Eloquent\Model;

class FraseEnIngles extends Model
{
    protected $table = 'frases_ingles';
    protected $fillable = ['frase', 'created_at', 'updated_at'];

    public static function relationInglesEspanol()
    {
    	return \DB::select(
    		'SELECT frases_ingles.id, frases_ingles.frase, COUNT(frases_espanol.*) as total
				FROM frases_ingles 
				inner join frases_espanol on frases_ingles.id = frases_espanol.frase_ingles_id 
				GROUP BY frases_ingles.id, frases_ingles.frase' 
    		);
    }
}
