<?php

namespace Modules\MgTraductor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AgregarFrasesEnEspanolController extends Controller
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
                'frase_espanol' => 'required',
                
            ];
            
            $messages = [
                'frase_espanol.required' => trans('mgtraductor::ui.display.error_required', ['attribute' => trans('mgtraductor::ui.attribute.frase_espanol')])
            ]; 
            
            $validator = \Validator::make($request->all(), $rules, $messages);          
            
            if ( $validator->fails() ) {
                return Response(['msg' => $validator->errors()->all()], 402)->header('Content-Type', 'application/json');
            } else {
                \Modules\MgTraductor\Entities\ListaFraseEnEspanol::create([ 
                    'frase' => ucfirst( $request->input('frase_espanol')),
                    'frase_ingles_id' => $request->input('id')
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
    public function show()
    {
        return view('mgtraductor::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        return \Modules\MgTraductor\Entities\ListaFraseEnEspanol::find($id); 
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
                'frase_espanol' => 'required',                
            ];
            
            $messages = [
                'frase_espanol.required' => trans('mgtraductor::ui.display.error_required', ['attribute' => trans('mgtraductor::ui.attribute.frase_espanol')])
            ]; 
            
            $validator = \Validator::make($request->all(), $rules, $messages);          
            
            if ( $validator->fails() ) {
                return Response(['msg' => $validator->errors()->all()], 402)->header('Content-Type', 'application/json');
            } else {
                \Modules\MgTraductor\Entities\ListaFraseEnEspanol::where('id', $request->input('id'))
                ->update([ 
                    'frase' => ucfirst( $request->input('frase_espanol')),
                    'frase_ingles_id' => $request->input('frase_espanol_id')
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
    {   $id_frase_ingles = \Modules\MgTraductor\Entities\ListaFraseEnEspanol::find($id);
        \Modules\MgTraductor\Entities\ListaFraseEnEspanol::destroy($id);
        \Request::session()->flash('message', trans('mgtraductor::ui.flash.flash_delete_frase'));
        return redirect('mgtraductor/update/'. $id_frase_ingles->frase_ingles_id);
    }
}
