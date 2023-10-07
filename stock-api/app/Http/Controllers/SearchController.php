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
        // // Validate the search term
        // $request->validate([
        //     'q' => 'required|string|max:255',
        // ]);

        // $searchTerm = $request->input('q');

        // // Perform the search in the 'posts' table based on the 'title' column
        // $results = Stock::where('name', 'like', '%' . $searchTerm . '%')->get();
        // $results = Stock::where('category', 'like', '%' . $searchTerm . '%')->get();



        // $query = Stock::select('sku', 'name','category', 'description', 'price');

        // if ($request->searchQuery){
        //     $query->where(function ($q) use($request) {
        //         $q>orWhere('name', 'like', '%'.$request->searchQuery. '%');
        //         $q>orWhere('category', 'like', '%'.$request->searchQuery. '%');
        //     });
        // }
        // $stock = $query->get();
        // return $stock;

        // return response()->json($results);
        $searchTerm = $request->input('q');
        $category = $request->input('category');

        $query = Stock::query();

        // Check if search term is provided
        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Check if category is provided
        if ($category) {
            $query->where('category', 'like', '%' . $category . '%');
        }

        // Perform the search
        $results = $query->get();

        return response()->json($results);
    }
}