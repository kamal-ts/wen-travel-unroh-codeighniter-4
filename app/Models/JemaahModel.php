<?php

namespace App\Models;

use CodeIgniter\Model;

class JemaahModel extends Model
{
    protected $table = 'tbjemaah';
    protected $useTimestamps = true;
    protected $primaryKey = 'idJemaah';
    // tentukan field yg boleh user isi
    protected $allowedFields = ['idPaket', 'idJadwal', 'noKtp', 'noPaspor', 'namaJemaah', 'namaAyahKandung', 'namaIbuKandung', 'tempatLahir', 'tglLahir', 'alamatRumah', 'kelurahan', 'kota','kodePos', 'telponRumah', 'telponMobile', 'pekerjaan', 'ukuranPakaian', 'namaMahram', 'email', 'status','statusPerkawinan', 'statusJemaah', 'tglKembali'];

    
    public function getJemaahHaji()
    {
            
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                    ->join('tbpaket','tbpaket.idPaket=tbjemaah.idPaket')
                    ->where(['kategori' => 'haji'])
                    ->get()->getResultArray();
            
    }
    public function getIdJemaah($email)
    {
            
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                    ->where(['email' => $email])
                    ->first();
    }

    public function getJemaahUmroh()
    {
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                    ->join('tbpaket','tbpaket.idPaket=tbjemaah.idPaket')
                    ->join('tbjadwal', 'tbjadwal.idJadwal=tbjemaah.idJadwal')
                    ->where(['kategori' => 'umroh'])
                    ->get()->getResultArray();
            
    }


    public function detailJemaahHaji($idJemaah)
    {
            
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                    ->join('tbpaket','tbpaket.idPaket=tbjemaah.idPaket')
                    ->where(['idJemaah' => $idJemaah])
                    ->first();
            
    }

    public function detailJemaahUmroh($idJemaah)
    {
            
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                    ->join('tbpaket','tbpaket.idPaket=tbjemaah.idPaket')
                    ->join('tbjadwal', 'tbjadwal.idJadwal=tbjemaah.idJadwal')
                    ->where(['idJemaah' => $idJemaah])
                    ->first();
            
    }

    public function detailJemaah($idJemaah)
    {
            
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                    ->where(['idJemaah' => $idJemaah])
                    ->first();
            
    }
    public function cekEmail($email)
    {
            $data = $this->where(['email' => $email])->findAll();
            $newData = false;
            foreach($data as $isi){
                if($isi['statusJemaah'] != 'pulang'){
                    $newData = $isi;
                }else{
                    $newData = false;
                }
            }

            return $newData;
            // if()
            //     if  ($this->where(['email' => $email])
            //     ->where(['statusJemaah' => 'pulang'])
            //     ->findAll()){
            //         return false;
            //     }

            //     return $this
            //         ->where(['email' => $email])
            //         ->first();
    }

    public function getJemaahPaket($namaPaket)
    {
            
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                    ->join('tbpaket','tbpaket.idPaket=tbjemaah.idPaket')
                    ->where(['namaPaket' => $namaPaket])
                    ->get()->getResultArray();
            
    }
    public function getJemaahPaketSearch($namaPaket, $keyword)
    {
            
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                    ->join('tbpaket','tbpaket.idPaket=tbjemaah.idPaket')
                    ->where(['namaPaket' => $namaPaket])
                    ->like(['tbjemaah.created_at' => $keyword])
                    ->get()->getResultArray();
            
    }

    public function getJemaahJadwal($idJadwal)
    {
            
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                ->where(['idJadwal' => $idJadwal])
                ->get()->getResultArray();
            
    }





}
