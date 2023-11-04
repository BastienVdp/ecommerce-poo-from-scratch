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
        return ['name', 'description', 'price', 'image'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
