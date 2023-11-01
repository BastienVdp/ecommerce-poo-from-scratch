<?php 

namespace App\Core;

class Database
{
	public \PDO $pdo;

	public function __construct(array $config)
	{
		$dsn =  "mysql:host=". $config['host'] ?? ''.";dbname=". $config['name'] ?? '';
		
		$this->pdo = new \PDO($dsn, $config['username'], $config['password']);
		$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$this->pdo->exec("USE " . $config['name']);
	}
}