<?php 

namespace Database\Factories;

use App\Models\Category;
use App\Core\Factory;

class CategoryFactory extends Factory
{
	public static $model = Category::class;

	public static function generate(): array
	{
		return [
			'name' => self::$faker->word,
			'description' => self::$faker->sentence,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		];
	}
}