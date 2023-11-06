<?php 

namespace App\Controllers;

use App\Core\View;
use App\Core\Request;
use App\Core\Response;
use App\Core\Controller;
use App\Core\Validation;
use App\Models\Category;
use App\Actions\Category\CreateCategoryAction;
use App\Actions\Category\DeleteCategoryAction;
use App\Actions\Category\UpdateCategoryAction;

class CategoryController extends Controller
{
	public string $layout = 'admin';

	public function __construct()
	{
		$this->registerMiddleware([
			'class' => \App\Middlewares\AuthMiddleware::class,
			'actions' => ['index', 'create', 'store', 'edit', 'update', 'delete']
		]);
	}
	
	public function index()
	{
		return View::make('admin/categories/index', [
			'categories' => Category::all()
		]);
	}

	public function create()
	{
		return View::make('admin/categories/create');
	}

	public function store(Request $request, Response $response)
	{
		$errors = Validation::validate($request, [
			'name' => 'required',
		]);

		if(empty($errors)) {
			(new CreateCategoryAction())->execute(
				$request->body['name'],
				$request->body['description']
			);
			return $response->redirect('/admin/categories');
		}

		return View::make('admin/categories/create', [
			'errors' => $errors
		]);
	}

	public function edit(Request $request)
	{
		return View::make('admin/categories/edit', [
			'category' => Category::find(['id' => $request->params['id']])
		]);
	}

	public function update(Request $request, Response $response)
	{
		$errors = Validation::validate($request, [
			'name' => 'required',
		]);

		if(empty($errors)) {
			(new UpdateCategoryAction())->execute(
				$request->params['id'],
				$request->body['name'],
				$request->body['description']
			);
			return $response->redirect('/admin/categories');
		}

		return View::make('admin/categories/edit', [
			'errors' => $errors
		]);
	}

	public function delete(Request $request, Response $response) 
	{
		(new DeleteCategoryAction())->execute($request->params['id']);
		return $response->redirect('/admin/categories');
	}
}