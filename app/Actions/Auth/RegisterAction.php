<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Core\Application;

class RegisterAction {

	public function execute(
		string $email,
		string $username,
		string $password
	)
	{
		Application::$app->setUser(
			User::create([
				'email' => $email,
				'username' => $username,
				'password' => password_hash($password, PASSWORD_DEFAULT)
			])
		);
	}
}