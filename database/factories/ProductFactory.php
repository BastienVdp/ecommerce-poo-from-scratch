<?php 

namespace Database\Factories;

use App\Models\Product;
use App\Core\Factory;

class ProductFactory extends Factory
{
	public static $model = Product::class;

	public static function generate(array $dependencies): array
	{
		$images = array_diff(scandir('public/images/products'), ['.', '..']);

		return [
			'name' => self::$faker->word,
			'description' => self::$faker->sentence,
			'price' => self::$faker->randomFloat(2, 1, 100),
			'image' => self::$faker->randomElement($images),
			'category_id' => $dependencies['categories'][array_rand($dependencies['categories'])]['id'],
			'user_id' => $dependencies['users'][array_rand($dependencies['users'])]['id'],
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		];
	}
}