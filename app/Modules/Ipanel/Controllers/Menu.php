<?php

namespace Modules\Ipanel\Controllers;

use App\Controllers\BaseController;
// use Modules\Ipanel\Models\MenuModel;

class Menu extends BaseController
{
    // protected $MenuModel;

    public function __construct()
    {
        // $this->MenuModel = new MenuModel();
    }

    public function index()
    {
        print 'This Is Menu Page from Ipanel Module';
        exit;
    }
}
