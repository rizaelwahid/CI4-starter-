<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use Modules\Dashboard\Controllers\AppConfig;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->AppConfig = new AppConfig();
    }

    public function index()
    {
        $data = [
            'title'   => 'Dashboard',
            'AppConf' => $this->AppConfig->index(),
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];

        return view('\Modules\Dashboard\Views\Dashboard', $data);
    }
}
