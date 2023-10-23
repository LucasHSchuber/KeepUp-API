<?php

Namespace App\Http\Controllers;

use App\Models\stock;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\StockController;




class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('q');

        // Perform the search in 'name' and 'category' columns
        $results = Stock::where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('category', 'like', '%' . $searchTerm . '%')
                        ->orWhere('SKU', 'like', '%' . $searchTerm . '%')
                        ->get();

        return response()->json($results);


    }

}