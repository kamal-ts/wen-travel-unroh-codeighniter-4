<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
    public $createjemaah = [
        'noKtp' => 'required|numeric',
        'noPaspor' => 'required|alpha_numeric',
        'namaJemaah' => 'required',
        'namaAyahKandung' => 'required',
        'namaIbuKandung' => 'required',
        'tempatLahir' => 'required',
        'tglLahir' => 'required',
        'alamatRumah' => 'required',
        'kelurahan' => 'required',
        'kota' => 'required',
        'kodePos' => 'required|numeric',
        'telponRumah' => 'required|numeric',
        'telponMobile' => 'required|numeric',
        'pekerjaan' => 'required',
        'ukuranPakaian' => 'required',
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
            'rules' => 'numeric',
            'errors' => [
                'numeric' => 'jadwal tidak ada'
            ]
        ],

    ];
    public $update_jemaah = [
        'noKtp' => 'required|numeric',
        'noPaspor' => 'required|alpha_numeric',
        'namaJemaah' => 'required',
        'namaAyahKandung' => 'required',
        'namaIbuKandung' => 'required',
        'tempatLahir' => 'required',
        'tglLahir' => 'required',
        'alamatRumah' => 'required',
        'kelurahan' => 'required',
        'kota' => 'required',
        'kodePos' => 'required|numeric',
        'telponRumah' => 'required|numeric',
        'telponMobile' => 'required|numeric',
        'pekerjaan' => 'required',
        'ukuranPakaian' => 'required',
        'statusPerkawinan' => 'required',
    ];


    public $createpersyaratan = [
        
        'namaFile' => [
            'rules' => 'max_size[namaFile,2048]|is_image[namaFile]|mime_in[namaFile,image/png,image/jpg,image/jpeg]',
            'errors' => [
                'max_size' => 'ukuran gambar terlalu besar',
                'is_image' => 'yang anda pilih bukan gambar',
                'mime_in' => 'yang anda pilih bukan gambar'
            ]

        ]

    ];

    
    public $updatepersyaratan = [
        
        

        'namaFile' => [
            'rules' => 'max_size[namaFile,2048]|is_image[namaFile]|mime_in[namaFile,image/png,image/jpg,image/jpeg]',
            'errors' => [
                'max_size' => 'ukuran gambar terlalu besar',
                'is_image' => 'yang anda pilih bukan gambar',
                'mime_in' => 'yang anda pilih bukan gambar'
            ]

        ]
        

    ];

}
