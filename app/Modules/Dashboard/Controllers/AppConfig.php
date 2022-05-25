<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;

class AppConfig extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = [
            'SiteName'      => 'SetDash',
            'template'      => strtolower('Atlantis'),
            'footerCaption' => 'The Sat Set Codeigniter 4 Startrer &copy; ' . date('Y'),

        ];
        return $data;
    }
}
