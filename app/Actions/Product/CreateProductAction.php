<?php 

namespace App\Actions\Product;

use App\Models\Product;
use App\Services\FileUploader;

class CreateProductAction
{
	/**
	 * The function takes in parameters for a product's name, description, price, category, and image,
	 * uploads the image to a specified directory, and creates a new product with the given information.
	 * 
	 * @param string name The name of the product.
	 * @param string description The description parameter is a string that represents the description of
	 * the product. It provides additional information or details about the product.
	 * @param float price The price parameter is a float value representing the price of the product.
	 * @param int category The category parameter is an integer representing the category ID of the
	 * product. It is used to associate the product with a specific category in the database.
	 * @param array image The "image" parameter is an array that contains the file data of the image to be
	 * uploaded. It is expected to have the following structure:
	 * 
	 * @return array|bool an array or a boolean value. If the image upload is successful, it returns true.
	 * If there is an error during the image upload, it returns an array with an error message.
	 */
	public function execute(
		string $name,
		string $description,
		float $price,
		int $category,
		array $image
	): array|bool
	{
		if($image = FileUploader::upload($image, '/public/images/products')) {
			Product::create([
				"name" => $name,
				"description" => $description,
				"price" => $price,
				"category_id" => $category,
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