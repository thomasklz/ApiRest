<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personas;

class PersonasController extends Controller
{
    /**
     * @SWG\Swagger(
     *   basePath="/api/v01",
     *   @SWG\Info(
     *     title="Customer rest to test examples",
     *     version="1.0.0",
     *     description="Client rest with Laravel",
     *     termsOfService="",
     *     @SWG\Contact(
     *             email="piposrgt@gmail.com"
     *         )
     *   )
     * )
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Get(
     *   path="/persona",
     *   tags={"Person"},
     *   summary="List persons",
     *   operationId="getCustomerRates",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=404, description="not found"),)
     * )
     *
     */
    public function index()
    {
        return  response()->json(['Personas'=> Personas::all()], 201); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Post(
     *   path="/persona",
     *   tags={"Person"},
     *   summary="create person",
     *   operationId="createPerson",
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Into name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="apellido",
     *     in="formData",
     *     description="Into last name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="cedula",
     *     in="formData",
     *     description="Into identification card",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="direccion",
     *     in="formData",
     *     description="Into address",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="telefono",
     *     in="formData",
     *     description="Into phone",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=201, description="create person successful"),
      *   @SWG\Response(response=400, description="identification exist"),
     *   @SWG\Response(response=422, description="unprocessable entity"),
     * )
     *
     */
    public function store(Request $request)
    {
        if(($request->name=="")||($request->apellido=="")||($request->cedula=="")||($request->direccion=="")||($request->telefono=="")){
             return response()->json(['Message'=>'No se permiten valores nulos'], 422);

        }
        $cedula = Personas::where('cedula',$request->cedula)->first();
        if($cedula){
            return response()->json(['Message'=>'Cédula existente'], 400);
        }
        //Instanciamos la clase Personas
        $persona = new Personas;
        //Declaramos los nombre enviado en el request
        $persona->name = $request->name;
        $persona->apellido = $request->apellido;
        $persona->cedula = $request->cedula;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        //Guardamos el cambio en nuestro modelo
        $persona->save();
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
     *   path="/persona/{personId}",
     *   tags={"Person"},
     *   summary="get person",
     *   operationId="getPerson",
     *   @SWG\Parameter(
     *     name="personId",
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
    public function show($id)
    {
       $persona = Personas::find($id);
       if ($persona){
            return response()->json(['Person'=>$persona], 200);
       }else{
            return response()->json(['Message'=>'No encontrado'], 404);
       }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Put(
     *   path="/persona/{personId}",
     *   tags={"Person"},
     *   summary="update person",
     *   operationId="updatePerson",
     *   @SWG\Parameter(
     *     name="personId",
     *     in="path",
     *     description="Into personId",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Into name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="apellido",
     *     in="formData",
     *     description="Into last name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="cedula",
     *     in="formData",
     *     description="Into identification card",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="direccion",
     *     in="formData",
     *     description="Into address",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="telefono",
     *     in="formData",
     *     description="Into phone",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="update person successful"),
     *   @SWG\Response(response=400, description="identification exist"),
     *   @SWG\Response(response=404, description="not found"),
     *   @SWG\Response(response=422, description="unprocessable entity"),
     * )
     *
     */
    public function update(Request $request, $id)
    {
        if(($request->name=="")||($request->apellido=="")||($request->cedula=="")||($request->direccion=="")||($request->telefono=="")){
             return response()->json(['Message'=>'No se permiten valores nulos'], 422);

        }
        $cedula = Personas::where('cedula',$request->cedula)->first();
        if($cedula){
            return response()->json(['Message'=>'Cédula existente'], 400);
        }
        $persona = Personas::find($id);
        if($persona){
            //Declaramos los nombre enviado en el request
            $persona->name = $request->name;
            $persona->apellido = $request->apellido;
            $persona->cedula = $request->cedula;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            //actualizamos el cambio en nuestro modelo
            $persona->save();
            return response()->json(['Message'=>'Dato actualizado correctamente'], 200);
        }else{
            return response()->json(['Message'=>'No encontrado'], 404);
        }
        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\delete(
     *   path="/persona/{personId}",
     *   tags={"Person"},
     *   summary="delete person",
     *   operationId="deletePerson",
     *   @SWG\Parameter(
     *     name="personId",
     *     in="path",
     *     description="Into personID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=204, description="delete person successful"),
     *   @SWG\Response(response=404, description="not found"),
     * )
     *
     */
    public function destroy($id)
    {
       $persona = Personas::find($id);
       if ($persona){
            Personas::find($id)->delete();
            return response()->json(['Message'=>'Dato eliminado'], 204);
       }else{
            return response()->json(['Message'=>'No encontrado'], 404);
       }
        
        
    }
}
