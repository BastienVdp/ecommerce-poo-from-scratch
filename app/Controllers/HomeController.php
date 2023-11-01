<?php 

namespace App\Controllers;

use App\Models\Product;
use App\Core\Controller;
use App\Core\Application;

class HomeController extends Controller
{
	public function __construct()
	{
		$this->registerMiddleware([
			'class' => \App\Middlewares\AuthMiddleware::class,
			'actions' => ['profile']
		]);
	}

	public function index()
	{
		$products = Product::all();

		// $productModified = Product::update(['description' => 'prout'], ['name' => 'test']);
		// $product = Product::delete(['name' => 'test']);
		

		return $this->render('home/index', [
			'products' => $products
		]);
	}

	public function profile()
	{
		return $this->render('home/profile');
	}	
}