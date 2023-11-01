<?php 

namespace App\Core;

abstract class Middleware
{
    abstract public function execute(): void;

    public static function runMiddlewares(array $middlewares): void
    {
        foreach ($middlewares as $middleware) {
            if (in_array(Application::$app->router->action, $middleware['actions'])) {
                (new $middleware['class'])->execute();
            }
        }
    }
}
