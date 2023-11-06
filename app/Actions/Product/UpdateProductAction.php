<?php 

namespace App\Actions\Product;

use App\Models\Product;
use App\Services\FileUploader;

class UpdateProductAction 
{
	public function execute(
		Product $product,
		string $name,
		string $description,
		float $price,
		int $category,
		array $image
	): array|bool
	{
		if(!empty($image['name'])) {
			// Update product with new image
			if($image = FileUploader::upload($image, '/public/images/products')) {
				if($product->image) FileUploader::delete($product->image, '/public/images/products');
				Product::update(['id' => $product->id], [
					"name" => $name,
					"description" => $description,
					"price" => $price,
					"category_id" => $category,
					"image" => $image
				]);
				return true;
			} else {
				return ["image" => "Une erreur s'est produite lors du téléchargement de l'image."];
			}
		} else {
			// Update product without new image
			Product::update(['id' => $product->id], [
				"name" => $name,
				"description" => $description,
				"category_id" => $category,
				"price" => $price,
			]);
			return true;
		}
	}
}