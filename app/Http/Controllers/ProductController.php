<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{

public function index()
{
    // $products = Product::all(); // You can use pagination too: Product::paginate(10)
    // return response()->json($products);
    // $products = Product::latest()->paginate(10);
    // return ProductResource::collection($products);

    return ProductResource::collection(
        Product::with('category')->paginate(10)
    );

}
public function store(StoreProductRequest $request)
{
   
    $product = Product::create($request->validated());

    return response()->json([
        'message' => 'Product created successfully',
        'data' => $product
    ], 201);
}

public function update(UpdateProductRequest $request, $id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

   
    $product->update($request->validated());

    return response()->json([
        'message' => 'Product updated successfully',
        'data' => $product
    ]);
}





public function show(Product $product)
{
   return new ProductResource($product->load(['category', 'tags']));
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
