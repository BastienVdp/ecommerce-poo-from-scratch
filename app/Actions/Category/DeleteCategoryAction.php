<?php 

namespace App\Actions\Category;

use App\Models\Category;

class DeleteCategoryAction
{
	public function execute(
		int $id
	): void
	{
		Category::delete(['id' => $id]);
	}
}