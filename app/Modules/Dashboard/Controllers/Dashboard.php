<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use Modules\Dashboard\Controllers\AppConfig;

// use Modules\Dashboard\Models\DashboardModel;

class Dashboard extends BaseController
{
    // protected $DashboardModel;

    public function __construct()
    {
        $this->AppConfig = new AppConfig();
        // $this->DashboardModel = new DashboardModel();
    }

    public function index()
    {
        $data = [
            'Title'   => 'Dashboard',
            'AppConf' => $this->AppConfig->index(),
        ];

        $data['css']            = [''];
        $data['js']             = ['sweetalertMin'];
        $data['NewJavaScript']  = ['foo', 'bar'];

        return view('\Modules\Dashboard\Views\Dashboard', $data);
    }
}
