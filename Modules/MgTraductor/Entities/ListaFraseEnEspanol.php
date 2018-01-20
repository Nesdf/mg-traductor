<?php

namespace Modules\MgTraductor\Entities;

use Illuminate\Database\Eloquent\Model;

class ListaFraseEnEspanol extends Model
{
    protected $table = 'frases_espanol';
    protected $fillable = ['frase', 'frase_ingles_id', 'created_at', 'updated_at'];

    public static function eliminarAll($idFraseIngles)
    {
    	return \DB::select(
    		'DELETE FROM frases_espanol 
    			WHERE frase_ingles_id = ' . $idFraseIngles
    		);
    }

    public static function showEspanolAll($id)
    {
    	return \DB::select(
    		'SELECT frase FROM frases_espanol WHERE frase_ingles_id = ' . $id
    		);
    }
}
