<?php 

namespace App\Controllers;

use App\Core\View;
use App\Models\Product;
use App\Core\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return View::make(
            'products/index', [
            'products' => $products
            ]
        );
    }

    public function show($request)
    {
        $product = Product::find(['id' => $request->params['id']]);
        if (!$product) {
            throw new \Exception("Product not found", 404);
        }
        return View::make(
            'products/show', [
            'product' => $product
            ]
        );
    }

    public function edit($request)
    {
        return 'coucou';
    }
}
