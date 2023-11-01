<?php 

namespace App\Core;

class View 
{
	public static function make(string $view, array $params = []): string
    {
        $layoutContent = self::layoutContent(Application::$app->controller->layout);
        $viewContent = self::viewContent($view, $params);

        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    private static function layoutContent(string $layout): string
    {
        ob_start();
        include_once Application::$root_dir . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    private static function viewContent(string $view, array $params = []): string
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$root_dir . "/views/$view.php";
        return ob_get_clean();
    }
}