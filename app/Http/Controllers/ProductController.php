<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getAll()
    {
        return Product::all();
    }
    public function create(Request $request)
    {
        $body = $request->all();
        $validator = Validator::make($body, [
            'name' => 'required|unique:products|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'available' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There was a problem trying to create the product'
            ], 400);
        }
        return Product::create($body);
    }
    public function update(Request $request, $id)
    {
        $body = $request->all();
        $validator = Validator::make($body, [
            'name' => 'string|max:255',
            'price' => 'numeric',
            'stock' => 'integer',
            'available' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There was a problem trying to update the product',
                'errors' => $validator->errors()
            ], 400);
        }
        $product = Product::find($id);
        $product->update($body);
        return $product;
    }
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['message' => 'Product successfully deleted']);
    }
}
