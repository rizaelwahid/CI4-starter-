<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
// use Modules\Dashboard\Models\DashboardModel;

class Home extends BaseController
{
    // protected $DashboardModel;

    public function __construct()
    {
        // $this->DashboardModel = new DashboardModel();
    }

    public function index()
    {
        print 'This Is Home Page from Dashboard Module';
        exit;
    }
}
