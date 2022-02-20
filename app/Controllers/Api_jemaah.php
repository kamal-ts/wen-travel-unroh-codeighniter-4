<?php namespace App\Controllers;

use App\Models\JadwalModel;
use App\Models\JemaahModel;
use App\Models\PaketModel;
use App\Models\PembayaranModel;
use App\Models\PorsiModel;
use CodeIgniter\RESTful\ResourceController;

class Api_jemaah extends ResourceController{

    protected $jemaahModel;
    protected $jadwalModel;
    protected $porsiModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->jemaahModel = new JemaahModel();
        $this->jadwalModel = new JadwalModel();
        $this->porsiModel = new PorsiModel();
        $this->pembayaranModel = new PembayaranModel();

        $this->validation = \Config\Services::validation();
    }

    public function cekEmail($email)
    {
        $data = $this->jemaahModel->cekEmail($email);
        
        if(!$data){
            return $this->fail('email tidak ditemukan');
        }

        return $this->respond($data);

    }

    public function create()
    {
        $data = $this->request->getPost();
        // $validate = $this->validation->run($data, 'createjemaah');
        // $errors = $this->validation->getErrors();

        // if($errors){
        //     // $respons = [
        //     //     'status' => 400,
        //     //     'error' => 400,
        //     //     'messages' => $errors
        //     // ];
        //     // return $this->respond($respons);
        //     return $this->fail($errors);
        // }

        if (!$this->validate([
            'noKtp' => 'required|numeric',
            'noPaspor' => 'required|alpha_numeric',
            'namaJemaah' => 'required',
            'namaAyahKandung' => 'required',
            'namaIbuKandung' => 'required',
            'tempatLahir' => 'required',
            'tglLahir' => 'required|valid_date[Y-m-d]',
            'alamatRumah' => 'required',
            'kelurahan' => 'required',
            'kota' => 'required',
            'kodePos' => 'required|numeric',
            'telponRumah' => 'required|numeric',
            'telponMobile' => 'required|numeric',
            'pekerjaan' => 'required',
            'ukuranPakaian' => [
                'label' => 'ukuran pakaian',
                'rules' => 'required|not_in_list[Pilih Ukuran]',
                'errors' => [
                    'not_in_list' => 'Ukuran Pakaian Tidak Boleh Kosong'
                ]
            ],
            'statusPerkawinan' => 'required',
            'email' => 'required|valid_email|is_unique[tbjemaah.email]',
            'idPaket' => [
                'label'  => 'nama paket',
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'nama paket tidak ada'
                ]

            ],
            'idJadwal' => [
                'label'  => 'jadwal',
                'rules' => 'required|not_in_list[Pilih Jadwal]|numeric',
                'errors' => [
                    'numeric' => 'jadwal tidak ada',
                    'not_in_list' => 'jadwal tidak ada'
                ]
            ],
		])) {

			$validation = \Config\Services::validation();
			return $this->fail($validation->getErrors());
		}


        $respons = [
            'status' => 'ok',
            'data' => $data
        ];

        if($this->jemaahModel->save($data)){
            return $this->respondCreated($respons);
        }

    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        $data['idJemaah'] = $id;

        $validate = $this->validation->run($data, 'update_jemaah');
        $errors = $this->validation->getErrors(); 
        

        if(!$this->jemaahModel->detailJemaah($id)){
            return $this->fail('id tidak ditemukan');
        }

        if($errors){
            return $this->fail($errors);
        }


        $jemaah = new \App\Entities\Api_jemaah();
        $jemaah->fill($data);

        if($this->jemaahModel->save($jemaah)){
            return $this->respondUpdated($jemaah, 'berhasil update');
        }

    }

    public function show($id = null)
    {
        $cek = $this->jemaahModel->detailJemaah($id);

        if($cek['idPaket']==1){
            $data = [
                'title' => 'Detail Jemaah haji',
                'jemaah' => $this->jemaahModel->detailJemaahHaji($id),
                'porsi' => $this->porsiModel->getWherePorsi($id),
                // 'pembayaran' => $this->pembayaranModel->first($id),
            ];

            return $this->respond($data);
        }else{
            $data = [
                'title' => 'Detail Jemaah Umroh',
                'jemaah' => $this->jemaahModel->detailJemaahUmroh($id),
                'porsi' => null,
                // 'pembayaran' => $this->pembayaranModel->first($id),
            ];
            return $this->respond($data);
        }

        return $this->fail('id tidak ditemukan');
    }

}



?>