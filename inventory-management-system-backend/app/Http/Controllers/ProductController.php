<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return $product;
    }

    public function update(Request $request, $id)
{
    $product = Product::find($id);
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }
    $product->update($request->all());
    return response()->json($product, 200);
}


    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function getProducts()
    {
        $products = Product::select('products.id', 'products.ProductName', 'products.Description', 'products.QuantityAvailable', 'products.UnitPrice', 'categories.CategoryName', 'products.CategoryID' ,'products.created_at', 'products.updated_at')
            ->leftJoin('categories', 'products.CategoryID', '=', 'categories.id')
            ->orderBy('products.created_at', 'desc')
            ->get();

        return response()->json($products);
    }



}
