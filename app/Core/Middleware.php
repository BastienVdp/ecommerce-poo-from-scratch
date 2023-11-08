<?php 

namespace App\Core;
abstract class Middleware
{
    abstract public function execute(): void;

    /**
     * The function runs a list of middlewares based on the current action of the application's router.
     * 
     * @param array middlewares An array of middleware configurations. Each middleware configuration
     * should have two keys: 'class' and 'actions'. 'class' represents the class name of the
     * middleware, and 'actions' represents an array of actions where the middleware should be
     * executed.
     */
    public static function runMiddlewares(array $middlewares): void
    {
        foreach ($middlewares as $middleware) {
            if (in_array(Application::$app->router->action, $middleware['actions'])) {
                (new $middleware['class'])->execute();
            }
        }
    }
}
