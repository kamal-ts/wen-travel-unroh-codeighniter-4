<?php

namespace App\Controllers;

// use App\Models\JadwalModel;
// use App\Models\JemaahModel;
// use App\Models\PaketModel;
use App\Models\PembayaranModel;

class Pembayaran extends BaseController
{
    protected $pembayaranModel;
    // protected $jemaahModel;
    // protected $paketModel;
    // protected $jadwalModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        // $this->jemaahModel = new JemaahModel();
        // $this->paketModel = new PaketModel();
        // $this->jadwalModel = new JadwalModel();
    }

    public function index()
    {   
        $data = [
            'kategori' => 'haji',
            'title'     => "Pembayaran Haji",
            'pembayaran'    => $this->pembayaranModel->getPembayaranHaji()
        ];

        return view('pembayaran/index', $data);
    }

    public function umroh()
    {   
        $data = [
            'kategori' => 'umroh',
            'title'     => "Pembayaran Umroh",
            'pembayaran'    => $this->pembayaranModel->getPembayaranUmroh()
        ];

        return view('pembayaran/index', $data);
    }

    
    public function detail($idBukti)
    {
        $data = [
            'title' => 'Detail Pembayaran',
            'pembayaran' => $this->pembayaranModel->detailPembayaran($idBukti)
        ];

        // jika produk tdk ada di tabel
        if (empty($data['pembayaran'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('pembayaran is not found.');
        }

        return view('pembayaran/detail', $data);
    }

    // public function detailfil($idBukti)
    // {
    //     $data = [
    //         'title' => 'Detail Pembayaran',
    //         'pembayaran' => $this->pembayaranModel->detailPembayaran($idBukti)
    //     ];

    //     if (empty($data['pembayaran'])) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException('pembayaran is not found.');
    //     }

    //     return view('pembayaran/detail', $data);
    // }
    

    public function excel($kategori)
    {   
        if($kategori == 'haji'){
            $get = $this->pembayaranModel->getPembayaranHaji();
        }else
            $get = $this->pembayaranModel->getPembayaranUmroh();

        $data = [
            'kategori' => $kategori,
            'title'     => "Jemaah $kategori",
            'pembayaran'    => $get
        ];

        echo view('pembayaran/excel', $data);
    }

    public function savebayar()
    {
        $idBukti = $this->request->getPost('idBukti');
        
        $pembayaran= $this->pembayaranModel->detailPembayaran($idBukti);
        

        

        $this->pembayaranModel->save([
            'idBukti' => $idBukti,
            'statusPembayaran' => $this->request->getVar('statusPembayaran')
        ]);

        session()->setFlashdata('pesan', 'berhasil dikonfirmasi.');

        return redirect()->to('/pembayaran/detail/'. $idBukti);
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

    
}