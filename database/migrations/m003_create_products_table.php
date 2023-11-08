<?php 

namespace Database\Migrations;

use App\Core\Migration;

class m003_create_products_table extends Migration
{
	public string $table = 'products';

	public function __construct(\PDO $pdo)
	{
		parent::__construct($pdo, $this->table);
	}

	public function up()
	{
		parent::up();
		$this->varchar('name');
		$this->mediumText('description');
		$this->float('price');
		$this->varchar('image');
		$this->foreignKey('user_id', 'users', 'id', 'CASCADE');
		$this->foreignKey('category_id', 'categories', 'id', 'CASCADE');
		$this->addTimestamps();
	}

	public function down()
	{
		parent::down();
	}
}