<?php 

namespace App\Actions\Product;

use App\Models\Product;

class DeleteProductAction
{
	public function execute(
		int $id
	): bool
	{
		Product::delete(['id' => $id]);
		return true;
	}
}