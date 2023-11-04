<?php 

namespace App\Controllers;

use App\Core\View;
use App\Models\Product;
use App\Core\Controller;
use App\Core\Validation;
use App\Services\FileUploader;
use App\Actions\Product\CreateProductAction;
use App\Actions\Product\DeleteProductAction;
use App\Actions\Product\UpdateProductAction;

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

	public function filterProduct($request)
	{
		return View::make('admin/products/index', [
			"products" => Product::all($request->body['filter'])
		]);
	}

	public function createProduct($request, $response)
	{
		if($request->isPost()) {
			$errors = Validation::validate($request, [
				"name" => "required",
				"description" => "required",
				"price" => "required|numeric",
				"image" => "required|image:png,jpg,jpeg"
			]);

			if(empty($errors)) {
				if(
					is_array($errors = (new CreateProductAction())->execute(
						$request->body['name'],
						$request->body['description'],
						$request->body['price'],
						$request->body['image']
					))
				) {
					return View::make('admin/products/create', [
						"errors" => $errors
					]);
				} 
				$response->redirect('/admin/products');
			} else {
				return View::make('admin/products/create', [
					"errors" => $errors
				]);
			}
		}
		return View::make('admin/products/create');
	}

	public function editProduct($request, $response)
	{	
		$product = Product::find(['id' => $request->params['id']]);

		if($request->isPost()) {
			$rules = ["name" => "required", "description" => "required", "price" => "required|numeric"];
			
			if($request->body['image']['name']) $rules['image'] = "required|image:png,jpg,jpeg";
			
			$errors = Validation::validate($request, $rules);

			if(empty($errors)) {
				if(
					is_array($errors = (new UpdateProductAction())->execute(
						$product,
						$request->body['name'],
						$request->body['description'],
						$request->body['price'],
						$request->body['image']
					))
				) {
					return View::make('admin/products/edit', [
						"product" => $product,
						"errors" => $errors
					]);
				}
				$response->redirect('/admin/products');
			} else {
				return View::make('admin/products/edit', [
					"product" => $product,
					"errors" => $errors
				]);
			}
		}
		return View::make('admin/products/edit', [
			"product" => $product
		]);
	}

	public function deleteProduct($request, $response)
	{
		(new DeleteProductAction())->execute($request->params['id']);
		$response->redirect('/admin/products');
	}

	public function users()
	{
		return View::make('admin/users');
	}
}