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

	/**
	 * This function stores a category in the database if it passes validation, otherwise it returns the
	 * create category view with the validation errors.
	 * 
	 * @param Request request The  parameter is an instance of the Request class, which represents
	 * the HTTP request made to the server. It contains information such as the request method, headers,
	 * and body.
	 * @param Response response The  parameter is an instance of the Response class, which is
	 * responsible for generating and sending HTTP responses back to the client. It is used to redirect
	 * the user to a different page after successfully creating a category or to display any validation
	 * errors if there are any.
	 * 
	 * @return If there are no validation errors, the function will return a redirect response to the
	 * '/admin/categories' route. If there are validation errors, the function will return a view with the
	 * 'admin/categories/create' template and the 'errors' variable containing the validation errors.
	 */
	public function store(Request $request, Response $response)
	{
		$errors = Validation::validate($request, [
			'name' => 'required',
		], Category::class);

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

	/**
	 * This function updates a category with the provided name and description, and redirects to the admin
	 * categories page if successful, otherwise it returns the edit view with any validation errors.
	 * 
	 * @param Request request The  parameter is an instance of the Request class, which represents
	 * the HTTP request made to the server. It contains information such as the request method, headers,
	 * query parameters, and body.
	 * @param Response response The  parameter is an instance of the Response class, which is
	 * used to send a response back to the client. It can be used to set the response status code,
	 * headers, and body content.
	 * 
	 * @return If there are no validation errors, the function will return a redirect response to the
	 * '/admin/categories' URL. If there are validation errors, the function will return a view with the
	 * 'admin/categories/edit' template and the 'errors' variable containing the validation errors.
	 */
	public function update(Request $request, Response $response)
	{
		$errors = Validation::validate($request, [
			'name' => 'required',
		], Category::class);

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