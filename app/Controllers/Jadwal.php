<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use App\Models\PaketModel;
use DateTime;

class Jadwal extends BaseController
{
    protected $jadwalModel;
    protected $paketModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
        $this->paketModel = new PaketModel();
    }

    

    public function index()
    {   
        $data = [
            'title'     => "Jadwal Perjalanan",
            'jadwal'    => $this->jadwalModel->getJadwal(),
        ];
        
        return view('jadwal/index', $data);
    }
    
    public function create()
    {
        $data = [
            'title' => 'Tambah Jadwal',
            'paket' => $this->paketModel->getUmroh(),
            'validation' => \Config\Services::validation()
        ];

        return view('jadwal/create', $data);
    }
    
    public function save()
    {
            

    
        if (!$this->validate([
            'namaPesawat' => [
                'label'  => 'nama pesawat',
                'rules' => 'required'
            ],

            'harga' => [
                'rules' => 'integer|is_natural',
                'errors' => [
                    'integer' => 'harus bilangan bulat'
                ]
            ],

            'slot' => [
                'rules' => 'integer|is_natural',
                'errors' => [
                    'integer' => 'harus bilangan bulat'
                ]
            ],

            'idPaket' => [
                'label'  => 'nama paket',
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'nama paket tidak ada'
                ]

            ],
            'jamBerangkat' => [
                'label' => 'jam berangkat',
                'rules' => 'required'
            ],
            'tglBerangkat' => [
                'label' => 'tanggal berangkat',
                'rules' => 'required'
            ]

        ])) {

            // $validation = \Config\Services::validation();

            // return redirect()->to('/product/create')->withInput()->with('validation', $validation);
            return redirect()->to('/jadwal/create')->withInput();
        }

        $getdate = $this->request->getVar('tglBerangkat');

            $date = date('Y-m-d', strtotime($getdate));

            $getjam = $this->request->getVar('jamBerangkat');

            $hasil = "$date $getjam:00";


        $this->jadwalModel->save([
            'idPaket' => $this->request->getVar('idPaket'),
            'namaPesawat' => $this->request->getVar('namaPesawat'),
            'harga' => $this->request->getVar('harga'),
            'status' => $this->request->getVar('status'),
            'slot' => $this->request->getVar('slot'),
            'jamBerangkat' => $hasil,
        ]);

        session()->setFlashdata('pesan', 'jadwal Berhasil Ditambahkan .');

        return redirect()->to('/jadwal');
    }

    public function edit($idJadwal)
    {
        $jadwal = $this->jadwalModel->getWhere($idJadwal);

        $jamBerangkat = $jadwal['jamBerangkat'];

        $pecah2 = explode(" ", $jamBerangkat);

        

        $data = [
            'title' => 'Edit Jadwal',
            'validation' => \Config\Services::validation(),
            'paket' => $this->paketModel->getUmroh(),
            'jadwal' => $jadwal,
            'jam' => $pecah2[1],
            'tgl' => $pecah2[0]
        ];

        return view('jadwal/edit', $data);
    }

    public function update()
    {
        
        
        if (!$this->validate([
            'namaPesawat' => [
                'label'  => 'nama pesawat',
                'rules' => 'required'
            ],

            'harga' => [
                'rules' => 'integer|is_natural',
                'errors' => [
                    'integer' => 'harus bilangan bulat'
                ]
            ],

            'slot' => [
                'rules' => 'integer|is_natural',
                'errors' => [
                    'integer' => 'harus bilangan bulat'
                ]
            ],

            'idPaket' => [
                'label'  => 'nama paket',
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'nama paket tidak ada'
                ]

            ],
            'status' => [
                'label'  => 'status',
                'rules' => 'alpha',
                'errors' => [
                    'alpha' => 'status tidak ada'
                ]

            ],
            'jamBerangkat' => [
                'label' => 'jam berangkat',
                'rules' => 'required'
            ],

            'tglBerangkat' => [
                'label' => 'tanggal berangkat',
                'rules' => 'required'
            ]

        ])) {

            // $validation = \Config\Services::validation();

            // return redirect()->to('/product/create')->withInput()->with('validation', $validation);
            return redirect()->to('/jadwal/edit/'. $this->request->getVar('idJadwal'))->withInput();
        }

        $getdate = $this->request->getVar('tglBerangkat');

            $date = date('Y-m-d', strtotime($getdate));

            $getjam = $this->request->getVar('jamBerangkat');

            $hasil = "$date $getjam:00";


        $this->jadwalModel->save([
            'idJadwal' => $this->request->getVar('idJadwal'),
            'idPaket' => $this->request->getVar('idPaket'),
            'namaPesawat' => $this->request->getVar('namaPesawat'),
            'harga' => $this->request->getVar('harga'),
            'status' => $this->request->getVar('status'),
            'slot' => $this->request->getVar('slot'),
            'jamBerangkat' => $hasil,
        ]);

        session()->setFlashdata('pesan', 'jadwal Berhasil Diedit .');

        return redirect()->to('/jadwal');
    }

    public function excel()
    {   

        $data = [
            'porsi'    => $this->porsiModel->getPorsi()
        ];

        echo view('porsihaji/excel', $data);
    }
    
    public function delete($idJadwal)
    {
        if($this->jadwalModel->delete($idJadwal)){
            session()->setFlashdata('pesan', 'Jadwal berhasil di hapus');
            return redirect()->to('/jadwal');
        }
        
        session()->setFlashdata('pesangagal', 'Jadwal gagal di hapus');
        return redirect()->to('/jadwal');
    }


}