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
                        ->get();

        return response()->json($results);


    }
    // public function searchName(Request $request)
    // {
    //     $searchName = $request->input('q');

    //     // Perform the search in 'name' and 'category' columns
    //     $results = Stock::where('name', 'like', '%' . $searchName . '%')->get();

    //     return response()->json($results);

    // }
    // public function searchCategory(Request $request)
    // {
    //     $searchCategory = $request->input('q');

    //     // Perform the search in 'name' and 'category' columns
    //     $results = Stock::where('category', 'like', '%' . $searchCategory . '%')->get();

    //     return response()->json($results);

    // }
    // public function searchDescription(Request $request)
    // {
    //     $searchDescription = $request->input('q');

    //     // Perform the search in 'name' and 'category' columns
    //     $results = Stock::where('description', 'like', '%' . $searchDescription . '%')->get();

    //     return response()->json($results);

    // }
}