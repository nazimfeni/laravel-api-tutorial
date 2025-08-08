<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
{
    return CategoryResource::collection(Category::with('products')->get());
}

public function show(Category $category)
{
    return new CategoryResource($category->load('products'));
}


}
