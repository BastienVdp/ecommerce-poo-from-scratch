<?php 

namespace App\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\RegisterAction;
use App\Core\View;
use App\Models\User;
use App\Core\Controller;
use App\Core\Validation;
use App\Core\Application;

class AuthController extends Controller
{
    public string $layout = 'guest';

    public function login($request, $response)
    {
        if ($request->isPost()) {
            $errors = Validation::validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            
            if ($errors) {
                return View::make(
                    'auth/login', [
                    'errors' => $errors
                ]);
            } else {
                if(is_array(
                    $errors = (new LoginAction())->execute(
                        $request->body['email'],
                        $request->body['password']
                    )
                )) {
                    return View::make(
                        'auth/login', [
                        'errors' => $errors
                    ]);
                }
                $response->redirect('/profile');
            }
        }
        return View::make('auth/login');
    }


    public function register($request, $response)
    {
        if ($request->isPost()) {

            $errors = Validation::validate($request, [
                'email' => 'required|email|unique:User,email',
                'username' => 'required|min:3|unique:User,username',
                'password' => 'required|min:3',
                'password_confirmation' => 'required|confirmed'
            ]);
            
            if ($errors) {
                return View::make(
                    'auth/register', [
                    'errors' => $errors
                    ]
                );
            } else {
               (new RegisterAction())->execute(
                    $request->body['email'],
                    $request->body['username'],
                    $request->body['password']
                );
                $response->redirect('/profile');        
            }
        }

        return View::make('auth/register');
    }
}
