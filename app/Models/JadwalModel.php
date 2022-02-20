<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'tbjadwal';
    protected $useTimestamps = true;
    protected $primaryKey = 'idJadwal';
    protected $allowedFields = ['idPaket', 'namaPesawat', 'harga', 'status', 'slot', 'jamBerangkat'];


    public function getJadwal()
    {
            return $this
            ->join('tbpaket','tbpaket.idPaket=tbjadwal.idPaket')
            ->get()->getResultArray();
            
    }

    public function getJadwalSiap()
    {
            return $this
            ->where(['status' => 'siap'])
            ->get()->getResultArray();
            
    }

    public function getWhere($idJadwal)
    {
        return $this
        ->where(['idJadwal' => $idJadwal])
        ->first();
    }

}
