<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'tbbuktipembayaran';
    protected $useTimestamps = true;
    protected $primaryKey = 'idBukti';
    // tentukan field yg boleh user isi
    protected $allowedFields = ['idJemaah', 'noRek', 'pemilikRek', 'namaBank', 'jumlahBayar', 'bankTujuan', 'tglTransfer', 'gambarStruk', 'statusPembayaran'];


    public function getPembayaranHaji()
    {
            
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                    ->join('tbjemaah','tbjemaah.idJemaah=tbbuktipembayaran.idJemaah')
                    ->join('tbpaket', 'tbpaket.idPaket=tbjemaah.idPaket')
                    ->where(['kategori' => 'haji'])
                    ->get()->getResultArray();
            
    }
    public function getPembayaranUmroh()
    {
            
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                    ->join('tbjemaah','tbjemaah.idJemaah=tbbuktipembayaran.idJemaah')
                    ->join('tbpaket', 'tbpaket.idPaket=tbjemaah.idPaket')
                    ->where(['kategori' => 'umroh'])
                    ->get()->getResultArray();
            
    }

    public function detailPembayaran($idBukti)
    {
            
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                    -> join('tbjemaah', 'tbjemaah.idJemaah=tbbuktipembayaran.idJemaah')
                    ->join('tbpaket', 'tbpaket.idPaket=tbjemaah.idPaket')
                    ->where(['idBukti' => $idBukti])
                    ->first();
    }

    public function jemaahPembayaranUmroh($idJemaah)
    {
            
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                    ->join('tbjemaah', 'tbjemaah.idJemaah=tbbuktipembayaran.idJemaah')
                    ->join('tbpaket', 'tbpaket.idPaket=tbjemaah.idPaket')
                    ->join('tbjadwal', 'tbjadwal.idJadwal=tbjemaah.idJadwal')
                    ->where(['tbjemaah.idJemaah' => $idJemaah])
                    ->get()->getResultArray();
            
    }
    
    public function jemaahPembayaranHaji($idJemaah)
    {
                // return $this->join('tbpaket', 'tbpaket.idPaket = tbjemaah.category_id')->findAll();
                return $this
                    ->join('tbjemaah', 'tbjemaah.idJemaah=tbbuktipembayaran.idJemaah')
                    ->join('tbpaket', 'tbpaket.idPaket=tbjemaah.idPaket')
                    ->where(['tbjemaah.idJemaah' => $idJemaah])
                    ->get()->getResultArray();
    }

    public function getDetail($idJemaah)
    {
                return $this
                    ->where(['idJemaah' => $idJemaah])
                    ->get()->getResultArray();
    }






}
