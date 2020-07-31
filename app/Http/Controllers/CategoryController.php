<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        $body = $request->all();
        $validator = Validator::make($body, [
            'name' => 'required|unique:categories|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There was a problem trying to create the category',
                'errors' => $validator->errors(),
            ], 400);
        }
        $category= Category::create($body);
        return response()->json($category,201);
    }
}
