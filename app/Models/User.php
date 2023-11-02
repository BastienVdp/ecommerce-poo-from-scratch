<?php 

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public static function getTable(): string
    {
        return 'users';
    }

    public static function getAttributes(): array
    {
        return ['username', 'email', 'password'];
    }
}
