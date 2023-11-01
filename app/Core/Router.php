<?php 

namespace App\Core;

class Router 
{
	public array $routes = [];
	public string $action = '';
	public Request $request;
	public Response $response;

	public function __construct(Request $request, Response $response)
	{
		$this->request = $request;
		$this->response = $response;
	}
	
	public function get(string $path, $callback): void
	{
		$this->routes['get'][$path] = $callback;
	}

	public function post(string $path, $callback): void
	{
		$this->routes['post'][$path] = $callback;
	}

	public function resolve(): mixed
	{
		$path = $this->request->getPath();
		$method = $this->request->getMethod();
		$callback = $this->routes[$method][$path] ?? false;

		if ($callback === false) {
			$this->response->setStatusCode(404);
			return 'Not Found';
		}

		if (is_callable($callback)) {
			return $callback();
		}

		if (is_array($callback)) {
			$callback[0] = new $callback[0]();
			$this->action = $callback[1];
			Application::$app->controller = $callback[0];
			Middleware::runMiddlewares($callback[0]->middlewares);
		}
		
		return call_user_func($callback, $this->request, $this->response);
	}

	public function renderView(string $view, array $params = []): string
	{
		$layoutContent = $this->layoutContent(Application::$app->controller->layout);
		$viewContent = $this->viewContent($view, $params);

		return str_replace('{{ content }}', $viewContent, $layoutContent);
	}

	private function layoutContent(string $layout): string
	{
		ob_start();
		include_once Application::$root_dir . "/views/layouts/$layout.php";
		return ob_get_clean();
	}

	private function viewContent(string $view, array $params = []): string
	{
		foreach ($params as $key => $value) {
			$$key = $value;
		}

		ob_start();
		include_once Application::$root_dir . "/views/$view.php";
		return ob_get_clean();
	}
}