<?php 

namespace App\Models;

use App\Core\Model;
use App\Trait\Relationship;

class Order extends Model
{
    use Relationship;

	public static function getTable(): string
    {
        return 'orders';
    }

    public static function getAttributes(): array
    {
        return ['number', 'total_price', 'user_id'];
    }

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function products()
	{
		return $this->belongsToMany(Product::class, 'order_product');
	}
}