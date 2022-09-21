<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;

use Modules\Dashboard\Models\RoleModel;

class AppConfig extends BaseController
{
    protected $RoleModel;

    public function __construct()
    {
        $this->RoleModel = new RoleModel();
    }

    public function index()
    {
        $requri     = \Config\Services::request();
        $segment2        = $requri->uri->getSegment(2);
        if ($segment2 != 'login') :
            getVisitorData();
        endif;

        $db    = \Config\Database::connect();
        $query = $db->table('app_config')->get()->getResultArray();

        $LoopData = [];
        foreach ($query as $value) :
            $array    = [$value['config']  => $value['param']];
            $LoopData = array_merge($LoopData, $array);
        endforeach;

        $array = [
            'template'  => strtolower('Atlantis')
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

    public function webbasicinfo()
    {
        if (count($this->request->getPost()) <= 0) :
            $appConfig = $this->index();

            $data = [
                'title'      => 'Web Basic Info',
                'AppConf'    => $appConfig,
                'validation' => \config\Services::validation(),
                'viewer'     => 'webbasicinfo',
            ];

            $data['css']            = [''];
            $data['js']             = ['summernote'];
            $data['NewJavaScript']  = ['summernote'];

            return view('\Modules\Dashboard\Views\website', $data);
        else :
            $rules = [
                'siteName'      => [
                    'rules'     => 'required',
                ],
                'aboutSite'      => [
                    'rules'     => 'required',
                ],
                'footerCaption'      => [
                    'rules'     => 'required',
                ],
            ];

            if (!$this->validate($rules)) :
                return redirect()->to('/webbasicinfo')->withInput();
            endif;

            $array = $this->request->getPost();
            $db         = \Config\Database::connect();

            foreach ($array as $key => $value) :
                $result[] = $db->table('app_config')->set('param', $value)->where(['config' => $key])->update();
            endforeach;

            if (in_array(false, $result)) :
                session()->setFlashdata('boo', 'We’re having trouble updating this data.');
                return redirect()->to('/webbasicinfo');
            else :
                $activity   = 'update';
                $reference_id  = 0;
                SaveActivityLog($reference_id, $activity, NULL);

                session()->setFlashdata('yeah', 'Data successfully updated.');
                return redirect()->to('/webbasicinfo');
            endif;
        endif;
    }

    public function authconfiguration()
    {
        if (count($this->request->getPost()) <= 0) :
            $appConfig = $this->index();

            $data = [
                'title'      => 'Auth Configuration',
                'AppConf'    => $appConfig,
                'validation' => \config\Services::validation(),
                'getrole'    => $this->RoleModel->getRole(),
                'viewer'     => 'authconfiguration',
            ];

            $data['css']            = [''];
            $data['js']             = ['summernote'];
            $data['NewJavaScript']  = ['summernote'];

            return view('\Modules\Dashboard\Views\website', $data);
        else :
            $rules = [
                'isSignUp'      => [
                    'rules'     => 'required',
                ],
                'isForgotPassword'      => [
                    'rules'     => 'required',
                ],
                'newRegistrationRoleId'      => [
                    'rules'     => 'required',
                ],
                'termCondRegistration'      => [
                    'rules'     => 'required',
                ],
            ];

            if (!$this->validate($rules)) :
                return redirect()->to('/authconfiguration')->withInput();
            endif;

            $array = $this->request->getPost();
            $db         = \Config\Database::connect();

            foreach ($array as $key => $value) :
                $result[] = $db->table('app_config')->set('param', $value)->where(['config' => $key])->update();
            endforeach;

            if (in_array(false, $result)) :
                session()->setFlashdata('boo', 'We’re having trouble updating this data.');
                return redirect()->to('/authconfiguration');
            else :
                $activity   = 'update';
                $reference_id  = 0;
                SaveActivityLog($reference_id, $activity, NULL);

                session()->setFlashdata('yeah', 'Data successfully updated.');
                return redirect()->to('/authconfiguration');
            endif;
        endif;
    }

    public function smtpconfiguration()
    {
        if (count($this->request->getPost()) <= 0) :
            $appConfig = $this->index();

            $data = [
                'title'      => 'SMTP Configuration',
                'AppConf'    => $appConfig,
                'validation' => \config\Services::validation(),
                'viewer'     => 'smtpconfiguration',
            ];

            $data['css']            = [''];
            $data['js']             = [''];
            $data['NewJavaScript']  = [''];

            return view('\Modules\Dashboard\Views\website', $data);
        else :
            $rules = [
                'protocol'      => [
                    'rules'     => 'required',
                ],
                'SMTPHost'      => [
                    'rules'     => 'required',
                ],
                'SMTPUser'      => [
                    'rules'     => 'required',
                ],
                'SMTPPass'      => [
                    'rules'     => 'required',
                ],
                'SMTPPort'      => [
                    'rules'     => 'required',
                ],
                'SMTPCrypto'      => [
                    'rules'     => 'required',
                ],
                'mailType'      => [
                    'rules'     => 'required',
                ],
                'charset'      => [
                    'rules'     => 'required',
                ],
                'mailAlias'      => [
                    'rules'     => 'required',
                ],
                'mailName'      => [
                    'rules'     => 'required',
                ],
            ];

            if (!$this->validate($rules)) :
                return redirect()->to('/smtpconfiguration')->withInput();
            endif;

            $array = $this->request->getPost();
            $db         = \Config\Database::connect();

            foreach ($array as $key => $value) :
                $result[] = $db->table('app_config')->set('param', $value)->where(['config' => $key])->update();
            endforeach;

            if (in_array(false, $result)) :
                session()->setFlashdata('boo', 'We’re having trouble updating this data.');
                return redirect()->to('/smtpconfiguration');
            else :
                $activity   = 'update';
                $reference_id  = 0;
                SaveActivityLog($reference_id, $activity, NULL);

                session()->setFlashdata('yeah', 'Data successfully updated.');
                return redirect()->to('/smtpconfiguration');
            endif;
        endif;
    }

    public function maintenanceconfiguration()
    {
        if (count($this->request->getPost()) <= 0) :
            $appConfig = $this->index();

            $data = [
                'title'      => 'Maintenance Configuration',
                'AppConf'    => $appConfig,
                'validation' => \config\Services::validation(),
                'getrole'    => $this->RoleModel->getRole(),
                'viewer'     => 'maintenanceconfiguration',
            ];

            $data['css']            = [''];
            $data['js']             = ['moment', 'datepicker', 'summernote'];
            $data['NewJavaScript']  = ['moment', 'datepicker', 'summernote'];

            return view('\Modules\Dashboard\Views\website', $data);
        else :
            $date = htmlspecialchars($this->request->getPost('date'));
            $time = htmlspecialchars($this->request->getPost('time'));
            $maintenanceCaption = htmlspecialchars($this->request->getPost('maintenanceCaption'));

            $dateTime   = $date . ' ' . $time;
            $dateValue  = ($dateTime == ' ') ? NULL : $dateTime;

            $db         = \Config\Database::connect();

            $result  = $db->table('app_config')->set('param', $dateValue)->where(['config' => 'isMaintenance'])->update();
            $resultB = $db->table('app_config')->set('param', $maintenanceCaption)->where(['config' => 'maintenanceCaption'])->update();

            if ($result && $resultB) :
                $activity   = 'update';
                $reference_id  = 0;
                SaveActivityLog($reference_id, $activity, NULL);

                session()->setFlashdata('yeah', 'Data successfully updated.');
                return redirect()->to('/maintenanceconfiguration');
            else :
                session()->setFlashdata('boo', 'We’re having trouble updating this data.');
                return redirect()->to('/maintenanceconfiguration');
            endif;
        endif;
    }
}
