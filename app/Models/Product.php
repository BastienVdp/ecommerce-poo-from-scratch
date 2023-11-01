<?php 

namespace App\Models;

use App\Core\Model;

class Product extends Model
{
    public static function getTable(): string
    {
        return 'products';
    }

    public static function getAttributes(): array
    {
        return ['name', 'description', 'price'];
    }
}
