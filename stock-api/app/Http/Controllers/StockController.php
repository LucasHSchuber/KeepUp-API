<?php

namespace App\Http\Controllers;

use App\Models\stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Film::all();
        $stock = Stock::all();
        if($stock->count() > 0){
            return response()->json([
                'status' => 200,
                'stock' => $stock
            ], 200);
        } else{
            return response()->json([
                'status' => 404,
                'status_message' => 'Stock empty'
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ser så att värden finns och att de följer vissa krav
        $request->validate([
            // 'SKU'=>'required|between:2,64'

        ]);

        return Stock::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = Stock::find($id);
        if ($stock != null) {
            return $stock;
        }else {
            return response()->json([
                'Product not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stock = Stock::find($id);
        if ($stock != null) {

            //ser så att värden finns och att de följer vissa krav
            $request->validate([
                // 'SKU'=>'required|between:2,64'
                
            ]);

            $stock->update($request->all());
            return $stock;
        } else{
            return response()->json([
                'Product not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(stock $stock)
    {
        return $stock->delete();
    }
}
