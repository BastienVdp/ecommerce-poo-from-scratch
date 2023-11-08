<?php 

namespace App\Models;

use App\Core\Model;
use App\Models\Product;
use App\Trait\Relationship;

class User extends Model
{
    use Relationship;

    public static function getTable(): string
    {
        return 'users';
    }

    public static function getAttributes(): array
    {
        return ['username', 'email', 'password'];
    }
    
    public static function getLabels(): array
    {
        return [
            'username' => 'Nom d\'utilisateur',
            'email' => 'Adresse email',
            'password' => 'Mot de passe'
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
