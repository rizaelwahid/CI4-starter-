<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use Modules\Dashboard\Controllers\AppConfig;

use Modules\Dashboard\Models\ActivityLogModel;

class ActivityLog extends BaseController
{
    protected $ActivityLogModel;

    public function __construct()
    {
        $this->AppConfig        = new AppConfig();
        $this->ActivityLogModel = new ActivityLogModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_activity_log') ? $this->request->getVar('page_activity_log') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) :
            $searchdata = $this->ActivityLogModel->search($keyword);
        else :
            $searchdata = $this->ActivityLogModel->getActivityLog();
        endif;

        $data = [
            'title'         => 'Activity Log',
            'AppConf'       => $this->AppConfig->index(),
            'activityLog'   => $searchdata->paginate(10, 'activity_log'),
            'pager'         => $this->ActivityLogModel->pager,
            'currentPage'   => $currentPage,
            'viewer'        => ''
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];

        return view('\Modules\Dashboard\Views\ActivityLog', $data);
    }

    public function delete()
    {
        if ($this->request->getVar('activity_id')) :
            foreach ($this->request->getVar('activity_id') as $activity_id) :
                $delete = $this->ActivityLogModel->delete($activity_id);
            endforeach;
            if ($delete) :
                $activity   = 'deleted';
                $module_id  = 0;
                SaveActivityLog($module_id, $activity, NULL);

                session()->setFlashdata('yeah', 'Data success full deleted.');
                return redirect()->to('/activitylog');
            else :
                session()->setFlashdata('boo', 'We’re having trouble deleting this data.');
                return redirect()->to('/activitylog');
            endif;
        else :
            session()->setFlashdata('boo', 'No data selected!');
            return redirect()->to('/activitylog');
        endif;
    }
}
