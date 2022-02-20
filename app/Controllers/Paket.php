<?php

namespace App\Controllers;

use App\Models\PaketModel;


class Paket extends BaseController
{
    protected $paketModel;

    public function __construct()
    {
        $this->paketModel = new PaketModel();
    }

    

    public function index()
    {   
        $data = [
            'title'     => "Paket Model",
            'paket'    => $this->paketModel->getPaket(),
        ];
        
        return view('paket/index', $data);
    }
    
    public function create()
    {
        $data = [
            'title' => 'Tambah Paket',
            'validation' => \Config\Services::validation()
        ];

        return view('paket/create', $data);
    }
    
    public function save()
    {
        if (!$this->validate([
            'namaPaket' => [
                'label'  => 'nama paket',
                'rules' => 'required|is_unique[tbpaket.namaPaket]',
                'errors' => [
                    'is_unique' => 'nama paket sudah ada'
                ]
            ],

            'description' => [
                'rules' => 'required'
            ],

            'kategori' => [
                'label'  => 'kategori',
                'rules' => 'alpha'

            ],
            'hargaDaftar' => [
                'label' => 'harga pendaftaran',
                'rules' => 'required|integer|is_natural'
            ]

        ])) {

            // $validation = \Config\Services::validation();

            // return redirect()->to('/product/create')->withInput()->with('validation', $validation);
            return redirect()->to('/paket/create')->withInput();
        }


        $this->paketModel->save([
            'kategori' => $this->request->getVar('kategori'),
            'namaPaket' => $this->request->getVar('namaPaket'),
            'description' => $this->request->getVar('description'),
            'hargaDaftar' => $this->request->getVar('hargaDaftar'),
        ]);

        session()->setFlashdata('pesan', 'Paket Berhasil Ditambahkan .');

        return redirect()->to('/paket');
    }

    public function edit($idPaket)
    {
        $data = [
            'title' => 'Edit Paket',
            'validation' => \Config\Services::validation(),
            'paket' => $this->paketModel->getWhere($idPaket)
        ];

        return view('paket/edit', $data);
    }

    public function update()
    {
        $namaPaket = $this->request->getVar('namaPaket');
        $idPaket = $this->request->getVar('idPaket');
        $data = $this->paketModel->getWhere($idPaket);

        if($data['namaPaket'] == $namaPaket){
            $rulePaket = 'required';
        }else {
            $rulePaket = 'required|is_unique[tbpaket.namaPaket]';
        }
        
        if (!$this->validate([
            'namaPaket' => [
                'label'  => 'nama paket',
                'rules' => $rulePaket,
                'errors' => [
                    'is_unique' => 'nama paket sudah ada'
                ]
            ],
            'description' => [
                'rules' => 'required'
            ],

            'kategori' => [
                'label'  => 'kategori',
                'rules' => 'alpha'

            ],
            'hargaDaftar' => [
                'label' => 'harga pendaftaran',
                'rules' => 'required|integer|is_natural'
            ]

        ])) {

            // $validation = \Config\Services::validation();

            // return redirect()->to('/product/create')->withInput()->with('validation', $validation);
            return redirect()->to('/paket/edit/'. $this->request->getVar('idPaket'))->withInput();
        }


        $this->paketModel->save([
            'idPaket' => $idPaket,
            'kategori' => $this->request->getVar('kategori'),
            'namaPaket' => $this->request->getVar('namaPaket'),
            'description' => $this->request->getVar('description'),
            'hargaDaftar' => $this->request->getVar('hargaDaftar'),
        ]);

        session()->setFlashdata('pesan', 'Paket Berhasil DiEdit .');

        return redirect()->to('/paket');

    }

    public function excel()
    {   

        $data = [
            'porsi'    => $this->porsiModel->getPorsi()
        ];

        echo view('porsihaji/excel', $data);
    }
    
    public function delete($idPaket)
    {
        $this->paketModel->delete($idPaket);
        session()->setFlashdata('pesan', 'Paket Successfully Deleted');
        return redirect()->to('/paket');
    }


}