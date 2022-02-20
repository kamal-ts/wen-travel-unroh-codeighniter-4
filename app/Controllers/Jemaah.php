<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use App\Models\JemaahModel;
use App\Models\PaketModel;
use App\Models\PembayaranModel;
use App\Models\PorsiModel;

class Jemaah extends BaseController
{
    protected $jemaahModel;
    protected $paketModel;
    protected $jadwalModel;
    protected $porsiModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->jemaahModel = new JemaahModel();
        $this->paketModel = new PaketModel();
        $this->jadwalModel = new JadwalModel();
        $this->porsiModel = new PorsiModel();
        $this->pembayaranModel = new PembayaranModel();
    }

    public function index()
    {   
        $data = [
            'kategori' => 'haji',
            'title'     => "Jemaah Haji",
            'jemaah'    => $this->jemaahModel->getJemaahHaji()
        ];

        return view('jemaah/index', $data);
    }
    
    public function umroh()
    {   
        $data = [
            'kategori' => 'umroh',
            'title'     => "Jemaah Umroh",
            'jemaah'    => $this->jemaahModel->getJemaahUmroh()
        ];

        return view('jemaah/index', $data);
    }

    public function detail_haji($idJemaah)
    {
        
        $data = [
            'title' => 'Detail Jemaah',
            'jemaah' => $this->jemaahModel->detailJemaahHaji($idJemaah),
            'porsi' => $this->porsiModel->getWherePorsi($idJemaah),
            'pembayaran' => $this->pembayaranModel->jemaahPembayaranHaji($idJemaah),
        ];

        
        // jika jemaah tdk ada di tabel
        if (empty($data['jemaah'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('jemaah is not found.');
        }

        return view('jemaah/detail', $data);
    }

    public function detail_umroh($idJemaah)
    {
        $data = [
            'title' => 'Detail Jemaah',
            'jemaah' => $this->jemaahModel->detailJemaahUmroh($idJemaah),
            'pembayaran' => $this->pembayaranModel->jemaahPembayaranUmroh($idJemaah),
            'porsi' => null
        ];

        // jika jemaah tdk ada di tabel
        if (empty($data['jemaah'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('jemaah is not found.');
        }

        return view('jemaah/detail', $data);
    }


    public function excel($kategori)
    {   
        if($kategori == 'haji'){

        $get = $this->jemaahModel->getJemaahHaji();
        }
        else 
        $get = $this->jemaahModel->getJemaahUmroh();


        $data = [
            'kategori' => $kategori,
            'title'     => "Jemaah $kategori",
            'jemaah'    => $get
        ];
        
        echo view('jemaah/excel', $data);
    }


    public function update($idJemaah){
        $kategori = $this->request->getPost('kategori');

        $this->jemaahModel->save([
            'idJemaah' => $idJemaah,
            'statusJemaah' => $this->request->getPost('statusJemaah')
        ]);

        session()->setFlashdata('pesan', 'status jemaah berhasil diubah.');

        return redirect()->to("/jemaah/detail_$kategori/$idJemaah");

    }


    public function createporsi($idJemaah)
    {   
        
        if($this->porsiModel->getWherePorsi($idJemaah)){
            session()->setFlashdata('pesangagal', 'data porsi jemaah ini sudah ada.');
            return redirect()->to("/jemaah/detail_haji/$idJemaah");
        }

        $data = [
            'idJemaah' => $idJemaah,
            'title' => 'Tambah Data Porsi',
            'validation' => \Config\Services::validation()
        ];

        return view('jemaah/createporsi', $data);
    }
    
    public function saveporsi()
    {
        $idJemaah = $this->request->getPost('idJemaah');

        
        if (!$this->validate([
            'nomorPorsi' => [
                'label'  => 'nomor porsi',
                'rules' => 'required|is_unique[tbporsi.nomorPorsi]'
            ],
            'idJemaah' => [
                'label'  => 'jemaah',
                'rules' => 'required|is_unique[tbporsi.idJemaah]'
            ],
            'hargaPelunasan' => [
                'label'  => 'harga pelunasan',
                'rules' => 'required|numeric',
            ],
            'tglBerangkat' => [
                'label'  => 'harga pelunasan',
                'rules' => 'required',
            ]
            
        ])) {

            return redirect()->to('/jemaah/createporsi/'. $idJemaah)->withInput();
        }


        $this->porsiModel->save([
            'idJemaah' => $idJemaah,
            'nomorPorsi' => $this->request->getVar('nomorPorsi'),
            'hargaPelunasan' => $this->request->getVar('hargaPelunasan'),
            'tglBerangkat' => $this->request->getVar('tglBerangkat')
        ]);

        session()->setFlashdata('pesan', 'data porsi berhasil ditambahkan.');

        return redirect()->to('/jemaah/detail_haji/'. $idJemaah);
    }
    
    public function delete($idJemaah)
    {
        $kategori = $this->request->getVar('kategori');

        if($kategori == 'haji'){
            $data = $this->porsiModel->getWherePorsi($idJemaah);

            $this->porsiModel->delete($data['id']);
        }

        $this->jemaahModel->delete($idJemaah);
        session()->setFlashdata('pesan', 'Data Successfully Deleted');
        return redirect()->to('/jemaah/'. $kategori);
    }
    
}
