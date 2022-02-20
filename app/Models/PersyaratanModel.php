<?php

namespace App\Models;

use CodeIgniter\Model;

class PersyaratanModel extends Model
{
    protected $table = 'tbdokpersyaratan';
    protected $useTimestamps = true;
    protected $primaryKey = 'idPersyaratan';
    // tentukan field yg boleh user isi
    protected $allowedFields = ['idJemaah', 'namaDok', 'keterangan', 'namaFile'];


    public function getDetail($idJemaah)
    {
                return $this
                    ->where(['idJemaah' => $idJemaah])
                    ->get()->getResultArray();
    }

    public function detail($idPersyaratan)
    {
                return $this
                    ->where(['idPersyaratan' => $idPersyaratan])
                    ->first();
    }

    public function cekDokumen($idJemaah, $namaDok)
    {
                return $this
                    ->where(['idJemaah' => $idJemaah])
                    ->where(['namaDok' => $namaDok])
                    ->first();
    }

    



}
