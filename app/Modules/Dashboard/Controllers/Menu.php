<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
// use Modules\Dashboard\Models\MenuModel;

class Menu extends BaseController
{
    // protected $MenuModel;

    public function __construct()
    {
        // $this->MenuModel = new MenuModel();
    }

    public function index()
    {
        print 'This Is Menu Page from Dashboard Module';
        exit;
    }
}
