<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function layout (){
        //$userEmail = session('user_email');

        return view('category');
    }

    public function index()
    {
        // Retrieve all categories
        $categories = Category::all();

        return response()->json($categories);
    }

    public function show($id)
    {
        // Retrieve a specific category
        $category = Category::findOrFail($id);

        return response()->json($category);
    }

    public function store(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'name' => 'required',
        ]);

        // Create a new category
        $category = Category::create($request->all());

        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $this->validate($request, [
            'name' => 'required',
        ]);

        // Update the specified category
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        // Delete the specified category
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(null, 204);
    }

}
