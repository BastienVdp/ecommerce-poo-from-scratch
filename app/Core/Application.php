<?php 

namespace App\Core;

use App\Models\User;
use App\Core\Request;
use App\Core\Response;


class Application 
{
	public static $root_dir;
	public static $app;

	public Request $request;
	public Response $response;
	public Router $router;
	public Controller $controller;
	public Database $database;
	public Session $session;

	public ?User $user;

	public function __construct(string $path, array $config)
	{
		self::$root_dir = $path;
		self::$app = $this;

		$this->request = new Request();
		$this->response = new Response();
		$this->router = new Router($this->request, $this->response);
		$this->database = new Database($config['database']);
		$this->session = new Session($config['session']);
		
		if(Application::$app->session->get('user')) {
			$this->user = Application::$app->session->get('user');
		}
	}

	public function run(): void
	{
		echo $this->router->resolve();
	}

	public static function get($path, $callback): void
	{
		self::$app->router->get($path, $callback);
	}
	
	public static function post($path, $callback): void
	{
		self::$app->router->post($path, $callback);
	}

	public static function isConnected()
	{
		return self::$app->user;
	}

	public function setUser(User $user): void
	{
		$this->user = $user;
		Application::$app->session->set('user', $user);
	}

	public function unsetUser(): void
	{
		$this->user = null;
		$this->session->remove('user');
	}
}