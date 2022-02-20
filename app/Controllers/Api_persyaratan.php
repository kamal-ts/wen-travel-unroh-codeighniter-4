<?php namespace App\Controllers;


use App\Models\PersyaratanModel;
use CodeIgniter\RESTful\ResourceController;

class Api_persyaratan extends ResourceController{

    protected $persyaratanModel;

    public function __construct()
    {
        $this->persyaratanModel = new PersyaratanModel();
        $this->validation = \Config\Services::validation();
    }

    public function detail($idJemaah)
    {
        $data = $this->persyaratanModel->getDetail($idJemaah);
        if(!$data){
            return $this->fail('data tidak ditemukan');
        }
        return $this->respond($this->persyaratanModel->getDetail($idJemaah));
    }

    public function create()
    {
        $data = $this->request->getPost();
        // return $this->respond($this->request->getFile('namaFile')); 
        
        if($this->persyaratanModel->cekDokumen($data['idJemaah'], $data['namaDok'])){
            $rule = 'required|is_unique[tbdokpersyaratan.namaDok]';
            $eror = [
                'required' => 'tidak boleh kosong',
                'is_unique' => 'Dokumen ini sudah ada',
            ];
        }else{
            $rule = 'required';
            $eror = [
                'required' => 'tidak boleh kosong',
            ];
        }

        if (!$this->validate([
			'namaFile' => [
                'rules' => 'max_size[namaFile,20048]|is_image[namaFile]|mime_in[namaFile,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
                ],
            'namaDok' => [
                'rules' => $rule,
                'errors' => $eror
            ]
		])) {

			$validation = \Config\Services::validation();
			return $this->fail($validation->getErrors());
		}

        // ambil file gambar
        $image = $this->request->getFile('namaFile');

         // ambil nama
        $namaImage = $image->getRandomName();
        
         // pindahkan ke folder img
        $image->move('img', $namaImage);

        if($this->persyaratanModel->save([
            'idJemaah' => $this->request->getPost('idJemaah'),
            'namaDok' => $this->request->getPost('namaDok'),
            'namaFile' => $namaImage,
            'keterangan' => $this->request->getPost('keterangan'),
        ])){
            return $this->respondCreated('persyaratan created');
        }
    }

    public function update($id = null)
    {
        // $data = $this->request->getRawInput();
        $data = $this->request->getPost();
        

        if (!$this->validate([
			'namaFile' => [
                'rules' => 'max_size[namaFile,2048]|is_image[namaFile]|mime_in[namaFile,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
                ]

		])) {
			$validation = \Config\Services::validation();
			return $this->fail($validation->getErrors());
		}

        // ambil file gambar
        $image = $this->request->getFile('namaFile');

        if ($image->getError() == 4) {
            $namaImage = $this->request->getPost('namaFileLama');
        } else {
            // generate nama file random
            $namaImage = $image->getRandomName();
            // pindahkan gambar
            $image->move('img', $namaImage);
            
            // hapus file lama
            if($image != $this->request->getPost('namaFileLama')){
                unlink('img/' .$this->request->getPost('namaFileLama'));
            }
        }

        $data['idPersyaratan'] = $id;
        $data['namaFile'] = $namaImage;

        if($this->persyaratanModel->save(
            $data
        )){
            return $this->respondCreated($data, 'persyaratan created');
        }

    }

    public function delete($idPersyaratan = null)
    {
        // $data = $this->persyaratanModel->detail($idPersyaratan);
        $data = $this->persyaratanModel->detail($idPersyaratan);
        // return $this->respond($data);
        
        
        if($data){
            
            // hapus file lama
            unlink('img/' .$data['namaFile']);

            if($this->persyaratanModel->delete($idPersyaratan)){
                return $this->respondDeleted('Deleted');
            }
            return $this->fail('Gagal');
            
        }else{
            return $this->fail('data tidak ditemukan');
            
        }
    }
}



?>