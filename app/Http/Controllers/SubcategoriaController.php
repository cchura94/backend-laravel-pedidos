<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategoria;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_subcategorias = Subcategoria::get();
        return response()->json($lista_subcategorias);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // validar
         $request->validate([
            "nombre" => "required|unique:subcategorias|min:2|max:50",
            "categoria_id" => "required"
        ]);

        //guardar
        $subcat = new Subcategoria();
        $subcat->nombre = $request->nombre;
        $subcat->categoria_id = $request->categoria_id;
        $subcat->save();

        return response()->json(["mensaje" => "SubCategoria Registrada", "data" => $subcat], 201);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
