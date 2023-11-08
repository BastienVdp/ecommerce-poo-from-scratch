<?php 

namespace App\Actions\Category;

use App\Models\Category;

class UpdateCategoryAction
{
	/**
	 * The function updates the name and description of a category with the given ID.
	 * 
	 * @param int id An integer representing the ID of the category to be updated.
	 * @param string name The name parameter is a string that represents the new name for the category.
	 * @param string description The "description" parameter is a string that represents the new
	 * description for the category.
	 */
	public function execute(
		int $id,
		string $name, 
		string $description
	): void
	{
		Category::update(['id' => $id], [
			'name' => $name,
			'description' => $description
		]);
	}
}