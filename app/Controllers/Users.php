<?php

namespace App\Controllers;

use App\Models\JemaahModel;
use App\Models\RoleModel;
use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;
    protected $roleModel;
    protected $jemaahModel;


    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->jemaahModel = new JemaahModel();
    }

    

    public function index()
    {   
        $data = [
            'title'     => "Data User",
            'users'    => $this->userModel->getUsers(),
            'role'    => $this->roleModel->findAll(),
        ];
        
        return view('user/index', $data);
    }
    
    public function update($id)
    {
        
        $this->userModel->save([
            'id' => $id,
            'role_id' => $this->request->getVar('role_id'),
            'is_active' => $this->request->getVar('is_active')
        ]);

        session()->setFlashdata('pesan', 'User Berhasil DiEdit .');

        return redirect()->to('/users');

    }

    public function delete($id)
    {
        $data = $this->userModel->getUsersId($id);

        if($this->jemaahModel->cekEmail($data['email'])){
            session()->setFlashdata('pesangagal', 'User tidak bisa dihapus karena termasuk daftar jemaah');
            return redirect()->to('/users');
        }
        

        $this->userModel->delete($id);
        session()->setFlashdata('pesan', 'Users Successfully Deleted');
        return redirect()->to('/users');
    }


}