<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comentario;
use App\Personas;

class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /**
     * @SWG\Get(
     *   path="/comentarios",
     *   tags={"Comment"},
     *   summary="List comment",
     *   operationId="getComment",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=404, description="not found"),)
     * )
     *
     */
    public function index()
    {
        return  response()->json(['Comentario'=> Comentario::all()], 200); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Post(
     *   path="/comentarios",
     *   tags={"Comment"},
     *   summary="create comment",
     *   operationId="createComment",
     *   @SWG\Parameter(
     *     name="comentario",
     *     in="formData",
     *     description="Into comment",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="fechacreacion",
     *     in="formData",
     *     description="Into create date",
     *     required=true,
     *     type="string",
     *     format="YYYY-mm-dd H:i:s"
     *   ),
     *   @SWG\Parameter(
     *     name="personas_id",
     *     in="formData",
     *     description="Into identification person",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=201, description="create comment successful"),
     *   @SWG\Response(response=404, description="not exist person"),
     *   @SWG\Response(response=422, description="unprocessable entity"),
     * )
     *
     */
    public function store(Request $request)
    {
        if(($request->comentario=="")||($request->fechacreacion=="")||($request->personas_id=="")){
            return response()->json(['Message'=>'No se permiten valores nulos'], 422);

        }
        $personaId = Personas::find($request->personas_id);
        if(!$personaId){
            return response()->json(['Message'=>'Persona no encontrada'], 404);
        }

        $comentario = new Comentario;
        $date= new \DateTime($request->fechacreacion);
        $comentario->comentario = $request->comentario;
        $comentario->fechacreacion = $date->format('Y-m-d H:i:s');
        $comentario->personas_id = $request->personas_id;
        $comentario->save();
        return response()->json(['Message'=>'Dato ingresado correctamente'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Get(
     *   path="/comentarios/persona/{personas_id}",
     *   tags={"Comment"},
     *   summary="get comment to person",
     *   operationId="getCommentPerson",
     *   @SWG\Parameter(
     *     name="personas_id",
     *     in="path",
     *     description="Into personID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=404, description="not found"),
     * )
     *
     */
    public function getcomment($id)
    {
        $persona = Personas::find($id);
        if ($persona){
            return response()->json(['Comentario'=>$persona->comentarios], 200);
       }else{
            return response()->json(['Message'=>'Persona no encontrada'], 404);
       }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
