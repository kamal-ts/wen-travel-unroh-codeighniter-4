<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketModel extends Model
{
    protected $table = 'tbpaket';
    protected $useTimestamps = true;
    protected $primaryKey = 'idPaket';

    // tentukan field yg boleh user isi
    protected $allowedFields = ['kategori', 'namaPaket', 'description', 'hargaDaftar'];


    public function getPaket()
    {
                return $this->findAll();
    }

    public function getUmroh()
    {
                return $this
                ->where(['kategori' => 'umroh'])
                ->findAll();
    }

    public function getWhere($idPaket)
    {
        return $this
        ->where(['idPaket' => $idPaket])
        ->first();
    }

    public function getPaketJadwal($idPaket)
    {
        return $this
        ->join('tbpaket','tbpaket.idPaket=tbjemaah.idPaket')
        ->where(['idPaket' => $idPaket])
        ->first();
    }
    
}
