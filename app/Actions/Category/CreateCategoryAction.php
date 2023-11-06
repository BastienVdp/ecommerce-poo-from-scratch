<?php 

namespace App\Actions\Category;

use App\Models\Category;

class CreateCategoryAction
{
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