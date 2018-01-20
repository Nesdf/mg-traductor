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
    		'SELECT frases_ingles.id, frases_ingles.frase, COUNT(frases_espanol.*) AS total
				FROM frases_ingles 
				INNER JOIN frases_espanol ON frases_ingles.id = frases_espanol.frase_ingles_id 
				GROUP BY frases_ingles.id, frases_ingles.frase' 
    		);
    }

    public static function traduccionDeFrases()
    {
        return \DB::table('frases_ingles')
            ->join('frases_espanol', 'frases_ingles.id', 'frases_espanol.frase_ingles_id')
            ->select('frases_ingles.frase as ingles', 'frases_espanol.frase as espanol')
            ->get();
    }

    public static function totalDeFrases()
    {
        return \DB::select(\DB::raw(
            'SELECT frases_ingles.frase AS ingles, COUNT(frases_espanol.*)  AS total 
                FROM frases_ingles 
                INNER JOIN frases_espanol ON frases_ingles.id = frases_espanol.frase_ingles_id 
                GROUP BY frases_ingles.frase'));
    }

    public static function dbFrases()
    {
        return \DB::select(\DB::raw(
            'SELECT frases_ingles.frase AS ingles, COUNT(frases_espanol.*)  AS total 
                FROM frases_ingles 
                INNER JOIN frases_espanol ON frases_ingles.id = frases_espanol.frase_ingles_id 
                GROUP BY frases_ingles.frase'));
    }

    public static function oneFrase($frase_ingles)
    {
        return \DB::table('frases_ingles')
            ->join('frases_espanol', 'frases_ingles.id', 'frases_espanol.frase_ingles_id')
            ->select('frases_espanol.frase as espanol')
            ->where('frases_ingles.frase', '=', $frase_ingles)
            ->get();
    }

    public static function findFraseIngles($fraseIngles)
    {
        return \DB::table('frases_ingles')
            ->join('frases_espanol', 'frases_ingles.id', 'frases_espanol.frase_ingles_id')
            ->select('frases_espanol.frase', 'frases_ingles.id')
            ->where('frases_ingles.frase', '=', $fraseIngles)
            ->get();
    }
}
