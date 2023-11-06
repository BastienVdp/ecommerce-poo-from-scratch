<?php 

namespace App\Controllers;

use App\Core\View;
use App\Core\Request;
use App\Core\Response;
use App\Core\Controller;
use App\Core\Validation;
use App\Models\Product;
use App\Models\Category;
use App\Actions\Product\CreateProductAction;
use App\Actions\Product\DeleteProductAction;
use App\Actions\Product\UpdateProductAction;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware([
            "class" => \App\Middlewares\AuthMiddleware::class,
            "actions" => ["create", "store", "edit", "update", "delete"]
        ]);
    }

    public function index()
    {
        return View::make('products/index', [
            'products' => Product::all(),
            'categories' => Category::all()
        ]);
    }

    public function filter(Request $request)
    {
        $products = Category::find(['id' => $request->params['id']])->products();
        $categories = Category::all();
        return View::make('products/index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function sort(Request $request)
    {
        $products = Product::all($request->params['filter'], $request->params['order']);
        
        return View::make('products/index', [
            'products' => $products,
            'categories' => Category::all()
        ]);
    }

    public function show(Request $request)
    {
        $product = Product::find(['id' => $request->params['id']]);
        if (!$product) {
            throw new \Exception("Product not found", 404);
        }
        return View::make('products/show', [
            'product' => $product
        ]);
    }

	public function create()
	{
		return View::make('admin/products/create', [
            "categories" => Category::all()
        ], layout: 'admin');
	}

    public function store(Request $request, Response $response)
    {
        $errors = Validation::validate($request, [
            "name" => "required",
            "description" => "required",
            "price" => "required|numeric",
            "category" => "required",
            "image" => "required|image:png,jpg,jpeg"
        ]);

        if(empty($errors)) {
            if(
                is_array($errors = (new CreateProductAction())->execute(
                    $request->body['name'],
                    $request->body['description'],
                    $request->body['price'],
                    $request->body['category'],
                    $request->body['image']
                ))
            ) {
                return View::make('admin/products/create', [
                    "errors" => $errors
                ], layout: 'admin');
            } 
            return $response->redirect('/admin/products');
        } 

        return View::make('admin/products/create', [
            "errors" => $errors
        ], layout: 'admin');
    }

	public function edit(Request $request, Response $response)
	{	
		$product = Product::find(['id' => $request->params['id']]);
        
        if(!$product) {
            throw new \Exception("Product not found", 404);
        }
        
		return View::make('admin/products/edit', [
			"product" => $product,
            "categories" => Category::all()
		], layout: 'admin');
	}

    public function update(Request $request, Response $response)
    {
		$product = Product::find(['id' => $request->params['id']]);
        $categories = Category::all();

        $rules = [
            "name" => "required", 
            "description" => "required", 
            "price" => "required|numeric", 
            "category" => "required"
        ];
        
        if($request->body['image']['name']) $rules['image'] = "required|image:png,jpg,jpeg";
        
        $errors = Validation::validate($request, $rules);

        if(empty($errors)) {
            if(
                is_array($errors = (new UpdateProductAction())->execute(
                    $product,
                    $request->body['name'],
                    $request->body['description'],
                    $request->body['price'],
                    (int)$request->body['category'],
                    $request->body['image']
                ))
            ) {
                return View::make('admin/products/edit', [
                    "product" => $product,
                    "categories" => $categories,
                    "errors" => $errors
                ], layout: 'admin');
            }

            return $response->redirect('/admin/products');
        } 

        return View::make('admin/products/edit', [
            "product" => $product,
            "categories" => $categories,
            "errors" => $errors
        ], layout: 'admin');
    }

	public function delete(Request $request, Response $response)
	{
		(new DeleteProductAction())->execute($request->params['id']);
		return $response->redirect('/admin/products');
	}
}
