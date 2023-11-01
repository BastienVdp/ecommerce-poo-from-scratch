<?php 

namespace App\Core;

use App\Core\Middleware;

abstract class Controller
{
	public string $layout = 'default';
	public array $middlewares = [];

	protected function render(string $view, array $params = []): string
	{
		return Application::$app->router->renderView($view, $params);
	}

	protected function registerMiddleware(array $middlewares)
	{
		$this->middlewares[] = $middlewares;
	}
}