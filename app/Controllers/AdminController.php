<?php 

namespace App\Controllers;

use App\Core\View;
use App\Models\Product;
use App\Core\Controller;

class AdminController extends Controller
{
	public string $layout = 'admin';

	public function __construct()
	{
		$this->registerMiddleware([
			"class" => \App\Middlewares\AdminMiddleware::class,
			"actions" => [
				"index", 
				"products", 
				"createProduct", 
				"editProduct", 
				"deleteProduct", 
				"users"
			]
		]);
	}

	public function index()
	{
		return View::make('admin/dashboard');
	}

	public function products()
	{
		return View::make('admin/products/index', [
			"products" => Product::all()
		]);
	}

	public function users()
	{
		return View::make('admin/users');
	}
}