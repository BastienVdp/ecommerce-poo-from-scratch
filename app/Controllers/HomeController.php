<?php 

namespace App\Controllers;

use App\Models\Product;
use App\Core\Controller;
use App\Core\Application;
use App\Core\View;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return View::make('home/index', [
            'products' => $products
        ]);
    } 
}
