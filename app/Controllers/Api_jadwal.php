<?php namespace App\Controllers;

use App\Models\JadwalModel;
use App\Models\JemaahModel;
use CodeIgniter\RESTful\ResourceController;

class Api_jadwal extends ResourceController{

    protected $jadwalModel;
    protected $jemaahModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
        $this->jemaahModel = new JemaahModel();

        $this->validation = \Config\Services::validation();
    }

    public function index()
    {   
        $jadwal = $this->jadwalModel->getJadwalSiap();

        
        foreach($jadwal as  $row){

            $dataJadwal = $row;
            $jemaah = $this->jemaahModel->getJemaahJadwal($row['idJadwal']);
            $total = count($jemaah);
            $hasil = $dataJadwal['slot']-$total;

            $jamBerangkat = $dataJadwal['jamBerangkat'];

            $pecah2 = explode(" ", $jamBerangkat);

            if($hasil>0){
                $dataJadwal['slotKosong'] = $hasil;
                
                $dataJadwal['tgl'] = $pecah2[0];
                $dataJadwal['jam'] = $pecah2[1];

                $data[] = $dataJadwal;
            }

        }

        return $this->respond($data);
    }

    public function show($idJadwal = null)
    {   
        $jadwal = $this->jadwalModel->getWhere($idJadwal);

        $jemaah = $this->jemaahModel->getJemaahJadwal($idJadwal);

        $total = count($jemaah);
        $hasil = $jadwal['slot']-$total;

        $jadwal['slotKosong'] = $hasil;

        return $this->respond($jadwal);
        
    }

}



?>