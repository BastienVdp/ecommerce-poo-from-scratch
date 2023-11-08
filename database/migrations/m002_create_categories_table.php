<?php 

namespace Database\Migrations;

use App\Core\Migration;

class m002_create_categories_table extends Migration
{
	public string $table = 'categories';

	public function __construct(\PDO $pdo)
	{
		parent::__construct($pdo, $this->table);
	}

	public function up()
	{
		parent::up();
		$this->varchar('name');
		$this->mediumText('description');
		$this->addTimestamps();
	}

	public function down()
	{
		parent::down();
	}
}