<?php 

namespace Database\Migrations;

use App\Core\Migration;

class m005_create_order_product_table extends Migration
{
	public string $table = 'order_product';

	public function __construct(\PDO $pdo)
	{
		parent::__construct($pdo, $this->table);
	}

	public function up()
	{
		parent::up();
		$this->foreignKey('order_id', 'orders', 'id');
		$this->foreignKey('product_id', 'products', 'id');
		$this->addTimestamps();
	}

	public function down()
	{
		parent::down();
	}
}