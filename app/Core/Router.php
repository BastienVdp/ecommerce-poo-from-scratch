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

    public function delete(string $path, $callback): void
    {
        $this->routes['delete'][$path] = $callback;
    }

    public function resolve(): mixed
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            $callback = $this->getCallback($path, $method);
            if ($callback === false) {
                $this->response->setStatusCode(404);
                return 'Not Found';
            }
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
            $this->action = $callback[1];
            
            Application::$app->controller = $callback[0];
            Middleware::runMiddlewares($callback[0]->middlewares);
        }
        
        return call_user_func($callback, $this->request, $this->response);
    }

    public function getCallback(string $path, string $method): mixed
    {
        $path = trim($path, '/');
        $routes = $this->routes[$method];

        foreach ($routes as $route => $callback) {
            $route = trim($route, '/');
            
            if (preg_match(
                $this->buildRegexFromRoute($route), 
                $path, 
                $matches
            )
            ) {
                $routeName = $this->extractRouteNames($route);
                $values = array_slice($matches, 1);
                
                $params = array_combine($routeName, $values);
                
                $this->request->setParams($params);
                
                return $callback;
            }
        }

        return false;
    }

    private function buildRegexFromRoute(string $route): string
    {
        return "@^" . preg_replace("/\{(\w+)\}/", "(\w+)", $route) . "$@";
    }

    private function extractRouteNames(string $route): array
    {
        preg_match_all("/\{(\w+)\}/", $route, $matches);
        return $matches[1];
    }
}
