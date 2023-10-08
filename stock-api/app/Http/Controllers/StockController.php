<?php

namespace App\Http\Controllers;

use App\Models\stock;
use Illuminate\Http\Request;
use App\Models\User;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock = Stock::all();
        // Replace users_id with name
        $data = [];
        foreach ($stock as $item) {
            // Push to array
            // Get name from users_id
            $user = User::where('id', $item->users_id)->first();
            $name = $user->name;

            // Format output date as 2023-01-01 12.15
            $date = date('Y-m-d H:i', strtotime($item->created_at));
            $date2 = date('Y-m-d H:i', strtotime($item->updated_at));

            array_push($data, [
                'id' => $item->id,
                'SKU' => $item->SKU,
                'name' => $item->name,
                'category' => $item->category,
                'description' => $item->description,
                'price' => $item->price,
                'image' => $item->image,
                'author' => $name,
                'users_id' => $item->users_id,
                'created_at' => $date,
                'updated_at' => $date2
            ]);
        }       

        return $data;
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
            'SKU'=>'required|between:1,64',
            'name'=>'required|between:1,64',
            'category'=>'required|between:1,64',
            'description'=>'required|between:1,256',
            'price'=>'required|numeric',

        ]);

        $data = $request->all();        

        // Image upload
        if($request->hasFile('image')) {            
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
            ]);

            $image = $request->file('image');
            $filesize = $request->file('image')->getSize();

            // Generate a unique name for the image
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Move the uploaded image to a storage directory
            $image->move(public_path('uploads'), $imageName);

            // Create the URL for the uploaded image
            $imageUrl = asset('uploads/' . $imageName);

            // Add image to data array
            $data['image'] = $imageUrl;  
        }

        // Stored logged in user id
        $data['users_id'] = auth()->user()->id;    

        return Stock::create($data);

        // return Stock::create($request->all());
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
                'SKU'=>'required|between:1,64',
                'name'=>'required|between:1,64',
                'category'=>'required|between:1,64',
                'description'=>'required|between:1,256',
                'price'=>'required|numeric'
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
    public function destroy($id)
    {
        $stock = Stock::find($id);
        if ($stock != null) {
            $stock->delete();
            return response()->json([
                'Product deleted'
            ]);
        }

        return response()->json([
            'Product not found'
        ], 404);
    }
    public function userInputs()
    {
        // Get the logged-in user
        $user = auth()->user();

        // Retrieve groceries for the logged-in user
        $input = Stock::where('users_id', $user->id)->get();

        return response()->json($input);
    }
}
