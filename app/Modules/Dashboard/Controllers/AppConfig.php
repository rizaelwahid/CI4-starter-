<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;

class AppConfig extends BaseController
{
    public function index()
    {
        $db    = \Config\Database::connect();
        $query = $db->table('app_config')->get()->getResultArray();

        $LoopData = [];
        foreach ($query as $value) :
            $array    = [$value['config']  => $value['param']];
            $LoopData = array_merge($LoopData, $array);
        endforeach;

        $array = [
            'template'  => strtolower('Atlantis'),
            'request'   => \Config\Services::request()
        ];

        $data  = array_merge($LoopData, $array);
        return $data;
    }

    public function forbidden()
    {
        $appConfig = $this->index();

        $data = [
            'title'      => 'Forbidden',
            'AppConf'    => $appConfig,
            'validation' => \config\Services::validation(),
            'viewer'     => 'forbidden',
        ];

        return view('\Modules\Dashboard\Views\Layout\\' . ucfirst($appConfig['template']) . '_auth', $data);
    }

    public function maintenance()
    {
        $appConfig = $this->index();

        if (date('Y-m-d H:i:s') > $appConfig['isMaintenance']) :
            return redirect()->to('/')->withInput();
        endif;

        $data = [
            'title'      => 'Maintenance',
            'AppConf'    => $appConfig,
            'validation' => \config\Services::validation(),
            'viewer'     => 'forbidden',
        ];

        return view('\Modules\Dashboard\Views\Layout\\' . ucfirst($appConfig['template']) . '_maintenance', $data);
    }
}
