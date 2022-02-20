<?php

namespace App\Controllers;

use App\Models\PersyaratanModel;

// use App\Models\JadwalModel;
// use App\Models\JemaahModel;
// use App\Models\PaketModel;
// use App\Models\PembayaranModel;

class Persyaratan extends BaseController
{
    // protected $pembayaranModel;
    // protected $jemaahModel;
    // protected $paketModel;
    // protected $jadwalModel;
    protected $persyaratanModel;

    public function __construct()
    {
        // $this->pembayaranModel = new PembayaranModel();
        // $this->jemaahModel = new JemaahModel();
        // $this->paketModel = new PaketModel();
        // $this->jadwalModel = new JadwalModel();
        $this->persyaratanModel = new PersyaratanModel();
    }

    public function detail($idJemaah)
    {   
        $data = [
            'idJemaah' => $idJemaah,
            'title'     => "Dokumen Persyaratan",
            'persyaratan'    => $this->persyaratanModel->getDetail($idJemaah)
        ];
        
        return view('persyaratan/detail', $data);
    }
    

    public function delete($idBukti)
    {
        $data = $this->pembayaranModel->find($idBukti);

        if ($data['gambarStruk'] != 'struk.jpg') {
            // hapus gambar
            unlink('img/' . $data['gambarStruk']);
        }

        $this->pembayaranModel->delete($idBukti);
        session()->setFlashdata('pesan', 'Data Successfully Deleted');
        return redirect()->to('/pembayaran/'. $this->request->getVar('kategori'));
    }

    public function create($idJemaah)
    {   

        $data = [
            'idJemaah' => $idJemaah,
            'title' => 'Tambah Dokumen Persyaratan',
            'validation' => \Config\Services::validation()
        ];

        return view('persyaratan/create', $data);
    }
    
}