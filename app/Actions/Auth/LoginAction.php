<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Core\Application;

class LoginAction {

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