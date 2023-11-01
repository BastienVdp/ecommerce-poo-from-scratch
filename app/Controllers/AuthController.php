<?php 

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Core\Controller;
use App\Core\Validation;
use App\Core\Application;

class AuthController extends Controller
{
    public string $layout = 'guest';

    public function login($request)
    {
        if ($request->isPost()) {
            $errors = Validation::validate(
                $request, [
                'email' => 'required|email',
                'password' => 'required',
                ]
            );
            
            if ($errors) {
                return View::make(
                    'auth/login', [
                    'errors' => $errors
                    ]
                );
            } else {
                // User::create()
            }
        }
        return View::make('auth/login');
    }

    public function store($request)
    {
        
    }

    public function register($request, $response)
    {
        if ($request->isPost()) {

            $errors = Validation::validate(
                $request, [
                'email' => 'required|email|unique:User,email',
                'username' => 'required|min:3|unique:User,username',
                'password' => 'required|min:3',
                'password_confirmation' => 'required|confirmed'
                ]
            );
            
            if ($errors) {
                return View::make(
                    'auth/register', [
                    'errors' => $errors
                    ]
                );
            } else {
                $user = User::create($request->body);
                Application::$app->setUser($user);
                $response->redirect('/profile');
            }
        }

        return View::make('auth/register');
    }
}
