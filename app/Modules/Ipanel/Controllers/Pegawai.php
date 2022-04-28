<?php

namespace Modules\Ipanel\Controllers;

use App\Controllers\BaseController;
// use Modules\Ipanel\Models\PegawaiModel;

class Pegawai extends BaseController
{
    // protected $pegawaiModel;

    public function __construct()
    {
        // $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        print 'This Is Pangkat Page from Ipanel Module';
        exit;
    }
}
