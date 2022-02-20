<?php

namespace App\Models;

use CodeIgniter\Model;

class PorsiModel extends Model
{
    protected $table = 'tbporsi';
    protected $useTimestamps = true;
    // tentukan field yg boleh user isi
    protected $allowedFields = ['idJemaah', 'nomorPorsi', 'hargaPelunasan', 'tglBerangkat'];


    public function getPorsi()
    {
                return $this
                    ->join('tbjemaah','tbjemaah.idJemaah=tbporsi.idJemaah')
                    ->get()->getResultArray();
            
    }

    public function getWherePorsi($idJemaah)
    {
                return $this
                    ->where(['idJemaah' => $idJemaah])
                    ->first();
    }

    public function getWhereid($id)
    {
                return $this
                    ->where(['id' => $id])
                    ->first();
    }

    



}
