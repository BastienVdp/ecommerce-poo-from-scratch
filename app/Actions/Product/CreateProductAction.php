<?php 

namespace App\Actions\Product;

use App\Models\Product;
use App\Services\FileUploader;

class CreateProductAction
{
	public function execute(
		string $name,
		string $description,
		float $price,
		array $image
	): array|null
	{
		if($image = FileUploader::upload($image, '/public/images/products')) {
			Product::create([
				"name" => $name,
				"description" => $description,
				"price" => $price,
				"image" => $image
			]);
			return true;
		} else {
			return [
				"image" => "Une erreur s'est produite lors du téléchargement de l'image."
			];
		} 
	}
}