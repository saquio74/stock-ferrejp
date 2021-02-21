<?php

namespace App\Http\Controllers;

use App\Models\productos;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = productos::all();

        return response()->json($productos,200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          =>'required',
            
            'description'   =>'required',
            'stock'         =>'required',
            'price_cost'    =>'required',
            'price_sell'    =>'required'
        ]);
        
        $productos = new productos;
        $productos->name = $request->name;
        $productos->code = $request->code?$request->code:Str::random(40);
        $productos->description = $request->description;
        $productos->price_cost = $request->price_cost;
        $productos->price_sell = $request->price_sell;
        $productos->stock = $request->stock?$request->stock:0;
        $productos->save();
        return response()->json(['message'=>'Producto guardado correctamente'],201);
    }




    public function show($id)
    {
        $productos = productos::whereId($id)->first();

        return response()->json($productos,200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'          =>'required',
            'code'          =>'required',
            'description'   =>'required',
            'price_cost'    =>'required',
            'stock'         =>'required',
            'price_sell'    =>'required'
        ]);
        $productos = productos::whereId($request->id)->first();
        $productos->name = $request->name;
        $productos->code = $request->code;
        $productos->description = $request->description;
        $productos->price_cost = $request->price_cost;
        $productos->stock = $request->stock>0?$request->stock:0;
        $productos->price_sell = $request->price_sell;
        $productos->save();
        return response()->json(['message'=>'Producto modificado correctamente'],201);
        
    }

    public function destroy($id)
    {
        $productos = productos::whereId($id)->first();
        $productos->delete();
        return response()->json(['message'=>'producto borrado correctamente'],201);
    }
}
