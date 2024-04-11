<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'user_id';
    protected $allowedFields    = ['role_id', 'email', 'password', 'full_name', 'address', 'mobile'];
}
