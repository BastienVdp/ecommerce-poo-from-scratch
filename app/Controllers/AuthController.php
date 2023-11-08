<?php 

namespace App\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\RegisterAction;
use App\Core\View;
use App\Models\User;
use App\Core\Controller;
use App\Core\Validation;
use App\Core\Application;
use App\Core\Request;
use App\Core\Response;

class AuthController extends Controller
{
    public string $layout = 'guest';

    /**
     * The function handles the login process, including validation and redirection.
     * 
     * @param Request request The  parameter is an instance of the Request class, which
     * represents the HTTP request made by the client. It contains information such as the request
     * method, headers, body, and query parameters.
     * @param Response response The `` parameter is an instance of the `Response` class, which
     * is responsible for handling the HTTP response. It is used to send the response back to the
     * client.
     * 
     * @return a View object.
     */
    public function login(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $errors = Validation::validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ], User::class);
            
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

   /**
    * The function is used to handle the registration process, including validation and redirecting the
    * user to the profile page upon successful registration.
    * 
    * @param Request request The  parameter is an instance of the Request class, which
    * represents the HTTP request made by the client. It contains information such as the request
    * method (e.g., GET, POST), request headers, request body, and query parameters.
    * @param Response response The  parameter is an instance of the Response class, which is
    * used to send a response back to the client. It can be used to set headers, cookies, and the
    * response body. In this code, it is used to redirect the user to the '/profile' page after
    * successful registration.
    * 
    * @return a view for the registration page if the request method is not POST. If the request method
    * is POST and there are validation errors, it returns a view for the registration page with the
    * validation errors. If there are no validation errors, it executes the RegisterAction and
    * redirects the user to the '/profile' page.
    */
    public function register(Request $request, Response$response)
    {
        if ($request->isPost()) {

            $errors = Validation::validate($request, [
                'email' => 'required|email|unique:User,email',
                'username' => 'required|min:3|unique:User,username',
                'password' => 'required|min:3',
                'password_confirmation' => 'required|confirmed'
            ], User::class);
            
            if ($errors) {
                return View::make('auth/register', [
                    'errors' => $errors
                ]);
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
