<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'user_role';
    protected $useTimestamps = true;
    protected $primaryKey = 'idRole';
    
    // tentukan field yg boleh user isi
    // protected $allowedFields = ['name', 'email', 'image', 'password', 'role_id', 'is_active'];



}
