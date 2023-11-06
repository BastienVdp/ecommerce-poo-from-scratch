<?php 

namespace App\Core;

class Migration
{
	protected $db;

	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}

	public function up()
	{

	}

	public function down()
}