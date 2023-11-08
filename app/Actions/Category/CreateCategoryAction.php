<?php 

namespace App\Actions\Category;

use App\Models\Category;

class CreateCategoryAction
{
	/**
	 * The function creates a new category with a given name and description.
	 * 
	 * @param string name A string representing the name of the category.
	 * @param string description The "description" parameter is a string that represents the description
	 * of a category.
	 */
	public function execute(
		string $name, 
		string $description
	): void
	{
		Category::create([
			'name' => $name,
			'description' => $description
		]);
	}
}