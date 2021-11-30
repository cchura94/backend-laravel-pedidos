<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_categorias = Categoria::all();
        return response()->json($lista_categorias);
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
            "nombre" => "required|unique:categorias|min:3|max:50",
            "detalle" => "string"
        ]);
        // guardar
        $categoria = new Categoria;
        $categoria->nombre = $request->nombre;
        $categoria->detalle = $request->detalle;
        $categoria->save();

        return response()->json(["mensaje" => "Categoria Registrada", "data" => $categoria], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*$categoria = Categoria::find($id);

        $categoria->subcategorias;

        return $categoria;
        */
        $categoria = DB::table("categorias")->select("nombre")->find($id);

        $subcategorias = DB::table("subcategorias")
                        ->where("subcategorias.categoria_id", $id)
                        ->select("id", "nombre")
                        ->get();
        $categoria->sub_categorias = $subcategorias;
        return $categoria;
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
        $mi_id = $id;
        // validar
        $request->validate([
            "nombre" => "required|min:3|max:50|unique:categorias,nombre,$mi_id",
            // 'nombre' => ['required', 'min:3', 'max:50', Rule::unique('categorias')->ignore($id, 'mi_id')],
            "detalle" => "string"
        ]);

        $categoria = Categoria::find($id);
        // modificar
        $categoria->nombre = $request->nombre;
        $categoria->detalle = $request->detalle;
        $categoria->save();

        return response()->json(["mensaje" => "Categoria Modificada", "data" => $categoria], 201);
  
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
