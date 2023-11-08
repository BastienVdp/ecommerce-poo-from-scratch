<?php 

namespace App\Actions\Category;

use App\Models\Category;

class DeleteCategoryAction
{
	/**
	 * The function executes a delete operation on a Category object based on the provided ID.
	 * 
	 * @param int id The parameter "id" is an integer that represents the ID of the category that needs to
	 * be deleted.
	 */
	public function execute(
		int $id
	): void
	{
		Category::delete(['id' => $id]);
	}
}