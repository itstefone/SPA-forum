<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{



    public function index() {

        $categories = Category::latest()->get();


        return CategoryResource::collection($categories);
    }


    public function show(Category $category) {
        return new CategoryResource($category->load('questions'));
    }



    public function store(Request $request) {
        $category =  Category::create([
            'name' => $name = $request->name,
            'slug' => Str::slug($name)
        ]);

        return response()->json([
            'category' => new CategoryResource($category),
            'message' => 'Success created!'
        ], 201);
    }



    public function update(Category $category, Request $request) {
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);


        return response()->json([
            'category' => new CategoryResource($category),
            'message' => 'Success update'
        ],202);
    }


    public function destroy(Category $category) {
        $category->delete();

        return response()->json(null, 204);
    }
}
