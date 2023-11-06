<?php 

namespace App\Core;

use App\Models\User;
use App\Core\Request;
use App\Core\Response;


class Application
{
    public static $root_dir;
    public static $app;
    public $twig;

    public Request $request;
    public Response $response;
    public Router $router;
    public Controller $controller;
    public Database $database;
    public Session $session;

    public ?User $user = null;

    public function __construct(string $path, array $config)
    {
        self::$root_dir = $path;
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->database = new Database($config['database']);
        $this->session = new Session($config['session']);
        $this->twig = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader($path . '/ressources/views')
        );

        if (Application::$app->session->get('user')) {
            $this->user = Application::$app->session->get('user');
        }
    }

    public function run(): void
    {
        echo $this->router->resolve();
    }

    public static function get(string $path, mixed $callback): void
    {
        self::$app->router->get($path, $callback);
    }
    
    public static function post(string $path, mixed $callback): void
    {
        self::$app->router->post($path, $callback);
    }

    public static function delete(string $path, mixed $callback): void
    {
        self::$app->router->delete($path, $callback);
    }

    public static function isConnected()
    {
        return self::$app->user !== null;
    }

    public static function isAdmin()
    {
        return self::$app->user->admin;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
        self::$app->session->set('user', $user);
    }

    public function unsetUser(): void
    {
        $this->user = null;
        self::$app->session->remove('user');
    }
}
