<?php namespace App\Controllers;

use App\Models\PaketModel;
use CodeIgniter\RESTful\ResourceController;

class Api_paket extends ResourceController{

    protected $paketModel;

    public function __construct()
    {
        $this->paketModel = new PaketModel();

        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return $this->respond($this->paketModel->getPaket());
    }

    public function show($id = null)
    {
        return $this->respond($this->paketModel->getWhere($id));
    }

}



?>