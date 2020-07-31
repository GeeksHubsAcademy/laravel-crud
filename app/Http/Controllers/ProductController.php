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
        //Eager loading, esto es igual que include:['categories'] en sequelize
        // return Product::with('categories')->withTrashed()->get();//substrae también los registro eliminados (con valor en deleted_at)
        return Product::with('categories')->get();
    }
    public function create(Request $request)
    {
        $body = $request->all();
        $validator = Validator::make($body, [
            'name' => 'required|unique:products|string|max:255',
            'price' => 'required|numeric',
            'image_path' =>'string',
            'categories' =>'array',
            'stock' => 'required|integer',
            'available' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There was a problem trying to create the product',
                'errors' => $validator->errors(),
            ], 400);
        }
        $product = Product::create($body);
        //el attach añade los ids a la tabla intermedia equivalente a product.addCategory()
        $product->categories()->attach($body['categories']);
        return $product;
    }
    public function update(Request $request, $id)
    {
        $body = $request->all();
        $validator = Validator::make($body, [
            'name' => 'string|max:255',
            'price' => 'numeric',
            'image_path' =>'string',
            'stock' => 'integer',
            'categories' =>'array',
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
        //lo que hace el sync es un detach (elimina en la tabla intermedia las categorias asociadas) y luego hace un attach (añade en la tabla intermedia los ids de las categorias)
        $product->categories()->syncWithoutDetaching($body['categories']);
        return $product;
    }
    public function delete($id)
    {
        $product = Product::find($id);
        //elimina las filas de las asociaciones con las categorias
        $product->categories()->detach();
        $product->delete();
        return response()->json(['message' => 'Product successfully deleted', 'product' => $product]);
    }
}
