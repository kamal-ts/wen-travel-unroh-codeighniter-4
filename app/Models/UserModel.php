<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $useTimestamps = true;
    
    // tentukan field yg boleh user isi
    protected $allowedFields = ['name', 'email', 'image', 'password', 'role_id', 'is_active'];


    public function getUsers()
    {
                return $this
                    ->join('user_role','user_role.idRole=user.role_id')
                    ->get()->getResultArray();
            
    }

    public function getUsersId($id)
    {
                return $this
                    ->where(['id' => $id])
                    ->first();
            
    }

}
