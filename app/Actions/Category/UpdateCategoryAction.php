<?php 

namespace App\Actions\Category;

use App\Models\Category;

class UpdateCategoryAction
{
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