<?php 

namespace App\Entities;
use CodeIgniter\Entity;

class Api_jemaah extends Entity{

    public function setPassword(string $pass){

        $salt = uniqid('', true);
        $this->attributes['salt'] = $salt;
        $this->attributes['password'] = md5($salt.$pass);

        return $this;
    }
}


?>