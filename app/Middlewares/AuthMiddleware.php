<?php 

namespace App\Middlewares;

use App\Core\Middleware;
use App\Core\Application;

class AuthMiddleware extends Middleware
{
    public function execute(): void
    {
        if (!Application::isConnected()) {
            Application::$app->response->redirect('/login');
        }
    }
}
