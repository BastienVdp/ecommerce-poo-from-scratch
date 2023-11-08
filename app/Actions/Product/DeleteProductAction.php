<?php 

namespace App\Actions\Product;

use App\Models\Product;

class DeleteProductAction
{
	/**
	 * The function executes a delete operation on a product with the specified ID.
	 * 
	 * @param int id The id parameter is an integer that represents the unique identifier of the product
	 * that needs to be deleted.
	 */
	public function execute(
		int $id
	): void
	{
		Product::delete(['id' => $id]);
	}
}