<?php

namespace Modules\MgTraductor\Http\Controllers;

use \Statickidz\GoogleTranslate;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AgregarFrasesEnInglesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('mgtraductor::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('mgtraductor::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if( $request->method('post') && $request->ajax() ){
            
            $rules = [
                'frase_ingles' => 'required',
                
            ];
            
            $messages = [
                'frase_ingles.required' => trans('mgtraductor::ui.display.error_required', ['attribute' => trans('mgtraductor::ui.attribute.frase_ingles')])
            ]; 
            
            $validator = \Validator::make($request->all(), $rules, $messages);          
            
            if ( $validator->fails() ) {
                return Response(['msg' => $validator->errors()->all()], 402)->header('Content-Type', 'application/json');
            } else {
                $frase = \Modules\MgTraductor\Entities\FraseEnIngles::create([ 
                    'frase' => ucfirst( $request->input('frase_ingles') )
                ]);

                $source = 'en';
                $target = 'es';
                $text = $request->input('frase_ingles');
                 
                $trans = new GoogleTranslate();
                $result = $trans->translate($source, $target, $text);

                \Modules\MgTraductor\Entities\ListaFraseEnEspanol::create([ 
                    'frase' => ucfirst( $result ),
                    'frase_ingles_id' => $frase->id
                ]);

                $request->session()->flash('message', trans('mgtraductor::ui.flash.flash_create_frase'));
                return Response(['msg' => 'success'], 200)->header('Content-Type', 'application/json');
            }
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        return \Modules\MgTraductor\Entities\ListaFraseEnEspanol::showEspanolAll($id);
        \Request::session()->flash('message', trans('mgtraductor::ui.flash.flash_dshow_frase'));
        return redirect('mgtraductor/frases-ingles');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return \Modules\MgTraductor\Entities\FraseEnIngles::find($id); 
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        if( $request->method('post') && $request->ajax() ){
            
            $rules = [
                'frase_ingles' => 'required',                
            ];
            
            $messages = [
                'frase_ingles.required' => trans('mgtraductor::ui.display.error_required', ['attribute' => trans('mgtraductor::ui.attribute.frase_ingles')])
            ]; 
            
            $validator = \Validator::make($request->all(), $rules, $messages);          
            
            if ( $validator->fails() ) {
                return Response(['msg' => $validator->errors()->all()], 402)->header('Content-Type', 'application/json');
            } else {
                $frase = \Modules\MgTraductor\Entities\FraseEnIngles::where('id', $request->input('id') )
                ->update([ 
                    'frase' => ucfirst( $request->input('frase_ingles') )
                ]);

                $request->session()->flash('message', trans('mgtraductor::ui.flash.flash_create_frase'));
                return Response(['msg' => 'success'], 200)->header('Content-Type', 'application/json');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        \Modules\MgTraductor\Entities\ListaFraseEnEspanol::eliminarAll($id);
        \Modules\MgTraductor\Entities\FraseEnIngles::destroy($id);
        \Request::session()->flash('message', trans('mgtraductor::ui.flash.flash_delete_frase'));
        return redirect('mgtraductor/frases-ingles');
    }

    public function listFrases()
    {
        $frases = \Modules\MgTraductor\Entities\FraseEnIngles::relationInglesEspanol();
        return view('mgtraductor::frases_ingles', compact('frases'));
    }

    public function updateFrases($id)
    {
        $fraseEnIngles = \Modules\MgTraductor\Entities\FraseEnIngles::find($id);
        $frasesEnEspanol = \Modules\MgTraductor\Entities\ListaFraseEnEspanol::where('frase_ingles_id', $id)->get();
        return view('mgtraductor::show_frase_ingles', compact('fraseEnIngles', 'frasesEnEspanol'));
    }


}
