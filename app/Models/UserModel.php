<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'fullname', 'phone', 'email', 'password'];
}
