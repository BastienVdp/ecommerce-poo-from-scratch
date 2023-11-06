<?php 

namespace App\Actions\Product;

use App\Models\Product;

class DeleteProductAction
{
	public function execute(
		int $id
	): void
	{
		Product::delete(['id' => $id]);
	}
}