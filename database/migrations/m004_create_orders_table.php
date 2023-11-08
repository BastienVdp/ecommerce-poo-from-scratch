<?php 

namespace Database\Migrations;

use App\Core\Migration;

class m004_create_orders_table extends Migration
{
	public string $table = 'orders';

	public function __construct(\PDO $pdo)
	{
		parent::__construct($pdo, $this->table);
	}

	public function up()
	{
		parent::up();
		$this->varchar('number', 10);
		$this->float('total_price');
		$this->foreignKey('user_id', 'users', 'id', 'CASCADE');
		$this->addTimestamps();
	}

	public function down()
	{
		parent::down();
	}
}