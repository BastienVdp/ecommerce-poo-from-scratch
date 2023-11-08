<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Core\Application;

class LoginAction {

	/**
	 * The function takes an email and password as input, checks if the user exists and if the password is
	 * correct, and returns an array with error messages or sets the user in the application.
	 * 
	 * @param string email The email parameter is a string that represents the user's email address.
	 * @param string password The password parameter is a string that represents the user's password.
	 * 
	 * @return array|null an array or null.
	 */
	public function execute(
		string $email,
		string $password
	): array|null
	{
		$user = User::find(['email' => $email]);
		
		if(!$user) {
			return ['email' => "L'utilisateur n'existe pas."];
		} else if(!password_verify($password, $user->password)) {
			return ['password' => 'Le mot de passe est incorrect.'];
		} else {
			return Application::$app->setUser($user);
		}
	}
}