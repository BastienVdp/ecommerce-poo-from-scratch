<?php 

namespace App\Middlewares;

use App\Core\Middleware;
use App\Core\Application;
class AdminMiddleware extends Middleware
{
	public function execute(): void
	{
		if (!Application::isAdmin()) {
			Application::$app->response->redirect('/');
		}
	}
}