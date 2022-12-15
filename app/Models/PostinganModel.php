<?php

namespace App\Models;

use CodeIgniter\Model;

class PostinganModel extends Model
{
    protected $table            = 'postingan';
    protected $primaryKey       = 'id_postingan';
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_postingan', 'title', 'description', 'post_type', 'user'];
}
