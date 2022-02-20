<?php namespace App\Controllers;

// use App\Models\JadwalModel;
use App\Models\JemaahModel;
// use App\Models\PaketModel;
use App\Models\PembayaranModel;
use App\Models\PorsiModel;
use CodeIgniter\RESTful\ResourceController;

class Api_pembayaran extends ResourceController{

    protected $jemaahModel;
    // protected $jadwalModel;
    protected $porsiModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->jemaahModel = new JemaahModel();
        // $this->jadwalModel = new JadwalModel();
        $this->porsiModel = new PorsiModel();
        $this->pembayaranModel = new PembayaranModel();

        $this->validation = \Config\Services::validation();
    }

    public function detail($idJemaah)
    {
        $data = $this->pembayaranModel->getDetail($idJemaah);

        if(!$data){
            return $this->fail('data tidak ditemukan');
        }
        
        foreach ($data as $row){
            $pembayaran[] =  $row['jumlahBayar'];
        }

        $jumlah = array_sum($pembayaran);


        $cek = $this->jemaahModel->detailJemaah($idJemaah);

        if($cek['idPaket']==1){

            $jemaah = $this->jemaahModel->detailJemaahHaji($idJemaah);
            $porsi = $this->porsiModel->getWherePorsi($idJemaah);

            $respon = [
                'data' => $data,
                'totalBayar' => $jumlah,
                'totalPelunasan' => $porsi['hargaPelunasan'],
                'totalYangHarusDibayar' => $porsi['hargaPelunasan']+$jemaah['hargaDaftar'],
                
            ];
    
            return $this->respond($respon);
        }else{
            $jemaah = $this->jemaahModel->detailJemaahUmroh($idJemaah);

            $respon = [
                'data' => $data,
                'totalBayar' => $jumlah,
                'totalYangHarusDibayar' => $jemaah['harga']+$jemaah['hargaDaftar'],
                
            ];
    
            return $this->respond($respon);
        }

        
    }

    public function create()
    {
        $data = $this->request->getPost();
        // return $this->respond($this->request->getFile('namaFile')); 
        
        // if($this->persyaratanModel->cekDokumen($data['idJemaah'], $data['namaDok'])){
        //     $rule = 'required|is_unique[tbdokpersyaratan.namaDok]';
        // }else{
        //     $rule = 'required';
        // }

        if (!$this->validate([
            'idJemaah' => [
                'rules' => 'required'
            ],
            'noRek' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'numeric' => 'Nomor rekening Salah',
                    'required' => 'Tidak Boleh Kosong'
                ]
            ],
            'pemilikRek' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tidak Boleh Kosong'
                ]
            ],
            'namaBank' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bank Tidak Boleh Kosong'
                ]
            ],
            'jumlahBayar' => [
                'rules' => 'required|numeric|is_natural',
                'errors' => [
                    'required' => 'Tidak Boleh Kosong',
                    'numeric' => 'Jumlah bayar harus angka',
                    'is_natural' => 'jumlah bayar salah'
                ]
            ],
            'bankTujuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tidak Boleh Kosong'
                ]
            ],
            'tglTransfer' => [
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Tanggal Transfer Tidak Boleh Kosong',
                    'valid_date' => 'Format tanggal salah'
                ]
            ],
			'gambarStruk' => [
                'rules' => 'uploaded[gambarStruk]|max_size[gambarStruk,2048]|is_image[gambarStruk]|mime_in[gambarStruk,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar',
                    'uploaded' => 'gambar tidak boleh kosong'
                ]
                ]
		])) {

			$validation = \Config\Services::validation();
			return $this->fail($validation->getErrors());
		}

        // ambil file gambar
        $image = $this->request->getFile('gambarStruk');

         // ambil nama
        $namaImage = $image->getRandomName();

         // pindahkan ke folder img
        $image->move('img', $namaImage);

        if($this->pembayaranModel->save([
            'idJemaah' => $this->request->getPost('idJemaah'),
            'noRek' => $this->request->getPost('noRek'),
            'pemilikRek' => $this->request->getPost('pemilikRek'),
            'namaBank' => $this->request->getPost('namaBank'),
            'jumlahBayar' => $this->request->getPost('jumlahBayar'),
            'bankTujuan' => $this->request->getPost('bankTujuan'),
            'tglTransfer' => $this->request->getPost('tglTransfer'),
            'gambarStruk' => $namaImage,
            'statusPembayaran' => '-',
        ])){
            return $this->respondCreated('pembayaran created');
        }
    }

    public function update($id = null)
    {
        // $data = $this->request->getRawInput();
        $data = $this->request->getPost();
        

        if (!$this->validate([
            'noRek' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'numeric' => 'Nomor rekening Salah',
                    'required' => 'Tidak Boleh Kosong'
                ]
            ],
            'pemilikRek' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tidak Boleh Kosong'
                ]
            ],
            'namaBank' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bank Tidak Boleh Kosong'
                ]
            ],
            'jumlahBayar' => [
                'rules' => 'required|numeric|is_natural',
                'errors' => [
                    'required' => 'Tidak Boleh Kosong',
                    'numeric' => 'Jumlah bayar harus angka',
                    'is_natural' => 'jumlah bayar salah'
                ]
            ],
            'bankTujuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tidak Boleh Kosong'
                ]
            ],
            'tglTransfer' => [
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Tanggal Transfer Tidak Boleh Kosong',
                    'valid_date' => 'Format tanggal salah'
                ]
            ],
            'gambarStrukLama' => [
                'rules' => 'required'
            ],
			'gambarStruk' => [
                'rules' => 'max_size[gambarStruk,2048]|is_image[gambarStruk]|mime_in[gambarStruk,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar',
                    'uploaded' => 'gambar tidak boleh kosong'
                ]
                ]

		])) {
			$validation = \Config\Services::validation();
			return $this->fail($validation->getErrors());
		}

        // ambil file gambar
        $image = $this->request->getFile('gambarStruk');

        if ($image->getError() == 4) {
            $namaImage = $this->request->getPost('gambarStrukLama');
        } else {
            // generate nama file random
            $namaImage = $image->getRandomName();
            // pindahkan gambar
            $image->move('img', $namaImage);
            
            // hapus file lama
            if($image != $this->request->getPost('gambarStrukLama')){
                unlink('img/' .$this->request->getPost('gambarStrukLama'));
            }
        }

        $data['idBukti'] = $id;
        $data['gambarStruk'] = $namaImage;

        if($this->pembayaranModel->save(
            $data
        )){
            return $this->respondCreated(['pesan' => 'Pembayaran updated']);
        }

    }


    public function delete($idBukti = null)
    {
        $data = $this->pembayaranModel->detailPembayaran($idBukti);

        if(!$data){
            return $this->fail('data tidak ditemukan');
        }
        // return $this->respond();
        // hapus file lama
        unlink('img/' .$data['gambarStruk']);

        if($this->pembayaranModel->delete($idBukti)){
            return $this->respondDeleted(['idBukti'=>$idBukti .'Deleted']);
        }
    }


}



?>