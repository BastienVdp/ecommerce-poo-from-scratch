<?php 

namespace App\Models;

use App\Core\Model;
use App\Trait\Relationship;

class Category extends Model
{
    use Relationship;

	public static function getTable(): string
    {
        return 'categories';
    }

    public static function getAttributes(): array
    {
        return ['name', 'description'];
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}