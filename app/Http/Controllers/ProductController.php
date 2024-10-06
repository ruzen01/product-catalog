<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }
        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }
        if ($request->has('characteristics')) {
            foreach ($request->input('characteristics') as $key => $value) {
                $query->where('characteristics->' . $key, $value);
            }
        }

        $products = $query->paginate(10);

        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::with('reviews')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }
}
