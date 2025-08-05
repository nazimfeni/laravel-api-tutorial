<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{

public function index()
{
    $products = Product::all(); // You can use pagination too: Product::paginate(10)
    return response()->json($products);
}
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
    ]);

    $product = Product::create($validated);

    return response()->json([
        'message' => 'Product created successfully',
        'data' => $product
    ], 201);
}

public function update(Request $request, $id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
    ]);

    $product->update($validated);

    return response()->json([
        'message' => 'Product updated successfully',
        'data' => $product
    ]);
}

public function destroy($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->delete();

    return response()->json(['message' => 'Product deleted successfully']);
}



    public function test()
{
    return response()->json(['message' => 'Product controller is working']);
}


}
