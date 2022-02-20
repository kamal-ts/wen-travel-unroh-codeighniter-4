<?php

namespace App\Controllers;

use App\Models\PorsiModel;


class PorsiHaji extends BaseController
{
    protected $porsiModel;

    public function __construct()
    {
        $this->porsiModel = new PorsiModel();
    }

    

    public function index()
    {   
        $data = [
            'title'     => "Porsi Haji",
            'porsi'    => $this->porsiModel->getPorsi(),
            'validation' => \Config\Services::validation()
        ];
        
        return view('porsihaji/index', $data);
    }
    
    

    public function update()
    {
        $id = $this->request->getPost('id');
        $hargaPelunasan = $this->request->getPost('hargaPelunasan');
        $tglBerangkat = $this->request->getPost('tglBerangkat');
        $nomorPorsi = $this->request->getPost('nomorPorsi');

        $data = $this->porsiModel->getWhereid($id);

        if($data['nomorPorsi'] == $nomorPorsi){
            $rulePorsi = 'required|numeric';
        }else {
            $rulePorsi = 'required|numeric|is_unique[tbporsi.nomorPorsi]';
        }
        
        if (!$this->validate([
            'hargaPelunasan' => [
                'label'  => 'harga pelunasan',
                'rules' => 'required|numeric',
            ],            
            'nomorPorsi' => [
                'label'  => 'Nomor Porsi',
                'rules' => $rulePorsi,
            ]            
        ])) {

            return redirect()->to('/porsiHaji')->withInput();
        }

        $this->porsiModel->save([
            'id' => $id,
            'nomorPorsi' => $nomorPorsi,
            'hargaPelunasan' => $hargaPelunasan,
            'tglBerangkat' => $tglBerangkat
        ]);

        session()->setFlashdata('pesan', 'data porsi berhasil di Update.');

        return redirect()->to('/porsiHaji');
    }

    public function excel()
    {   

        $data = [
            'porsi'    => $this->porsiModel->getPorsi()
        ];

        echo view('porsihaji/excel', $data);
    }
    
}