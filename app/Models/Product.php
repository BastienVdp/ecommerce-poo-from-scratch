<?php 

namespace App\Models;

use App\Core\Model;
use App\Trait\Relationship;

class Product extends Model
{
    use Relationship;

    public static function getTable(): string
    {
        return 'products';
    }

    public static function getAttributes(): array
    {
        return ['name', 'description', 'price', 'image', 'category_id'];
    }

    public function user(): object
    {
        return $this->belongsTo(User::class);
    }

    public function category(): object|bool
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product');
    }
}
