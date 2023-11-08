<?php 

namespace App\Actions\Product;

use App\Models\Product;
use App\Services\FileUploader;

class UpdateProductAction 
{
	/**
	 * The function updates a product with new information, including a new image if provided.
	 * 
	 * @param Product product An instance of the Product class representing the product to be updated.
	 * @param string name The name of the product.
	 * @param string description The "description" parameter is a string that represents the updated
	 * description of the product.
	 * @param float price The price parameter is a float value representing the price of the product.
	 * @param int category The "category" parameter is an integer representing the category ID of the
	 * product. It is used to specify the category to which the product belongs.
	 * @param array image The "image" parameter is an array that contains information about the uploaded
	 * image file. It typically includes the following keys:
	 * 
	 * @return array|bool either an array or a boolean value. If the image upload is successful, it
	 * returns true. If there is an error during the image upload, it returns an array with an error
	 * message.
	 */
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