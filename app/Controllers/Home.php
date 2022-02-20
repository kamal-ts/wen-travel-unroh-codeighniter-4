<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use App\Models\JemaahModel;
use App\Models\PaketModel;

class Home extends BaseController
{
    protected $jemaahModel;
    protected $jadwalModel;
    protected $paketModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
        $this->paketModel = new PaketModel();
        $this->jemaahModel = new JemaahModel();
    }   

    public function index()
    {
        $keyword = $this->request->getPost('keyword');
        $paket = $this->paketModel->findAll();

        

        $a=0;
        if ($keyword) {
            foreach ($paket as $row) {

            
                $totalJemaahPaket[$a] = ['paket' => $row['namaPaket'],
                                                        'jumlah' => count($this->jemaahModel->getJemaahPaketSearch($row['namaPaket'], $keyword))
                                                        ];

                $a++;
            }
        }else{

            foreach ($paket as $row) {                
                    $totalJemaahPaket[$a] = ['paket' => $row['namaPaket'],
                                                            'jumlah' => count($this->jemaahModel->getJemaahPaket($row['namaPaket']))
                                                            ];
                    $a++;
            }
        }

        

        $data = [
            'title' => 'Dashboard',
            'totalJemaah' => $totalJemaahPaket,
        ];
        
        return view('dashboard/index', $data);
    }
}
