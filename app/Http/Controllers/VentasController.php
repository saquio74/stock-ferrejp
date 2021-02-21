<?php

namespace App\Http\Controllers;

use App\Models\ventas;
use App\Models\productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = DB::table('ventas')
                    ->join('productos','product_id','=','productos.id')
                    ->select('ventas.id','ventas.price_cost','amount','units','name','description','ventas.created_at')
                    ->orderBy('ventas.created_at','desc')
                    ->get();
        return response()->json($ventas);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'    => 'required',
            'amount'        => 'required',
            'units'         => 'required',
            'price_cost'    => 'required'
        ]);
        $producto = productos::whereId($request->product_id)->first();
        if($producto->stock - $request->units<0){
            return response()->json(['message'=>'no tienes suficiente stock'],422);
        }
        $producto->stock = $producto->stock - $request->units;
        $producto->save();
        $venta = new ventas;
        $venta->product_id = $request->product_id;
        $venta->price_cost = $request->price_cost;
        $venta->amount = $request->amount;
        $venta->units = $request->units;
        $venta->save();
        return response()->json(['message'=>'venta guardada correctamente'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function show(ventas $ventas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ventas $ventas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta = ventas::whereId($id)->first();
        $producto = productos::whereId($venta->product_id)->first();
        $producto->stock = $producto->stock + $venta->units;
        $producto->save();
        $venta->delete();
        return response()->json(['message'=>'Venta borrada correctamente'],201);
    }
}
