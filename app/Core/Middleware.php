<?php 

namespace App\Core;

abstract class Middleware
{
	abstract public function execute();

	public static function runMiddlewares(array $middlewares)
	{
		// var_dump('runMiddlewares', $middlewares);
		foreach ($middlewares as $middleware) {
			$class = $middleware['class'];
			$actions = $middleware['actions'] ?? [];
	
			// Vérifiez si l'action actuelle correspond aux actions spécifiées dans le middleware.
			if (in_array(Application::$app->router->action, $actions)) {
				// Instanciez le middleware et exécutez-le.
				(new $class)->execute();
			}
		}
	}
}