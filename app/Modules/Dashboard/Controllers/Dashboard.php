<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use Modules\Dashboard\Controllers\AppConfig;

use Modules\Dashboard\Models\VisitorModel;
use Modules\Dashboard\Models\ActivityLogModel;

class Dashboard extends BaseController
{
    protected $VisitorModel;
    protected $ActivityLogModel;

    public function __construct()
    {
        $this->AppConfig = new AppConfig();
        $this->VisitorModel = new VisitorModel();
        $this->ActivityLogModel = new ActivityLogModel();
    }

    public function index()
    {
        $end        = new \DateTime();

        $interval   = new \DateInterval('P1D');

        $start      = new \DateTime();
        $start->modify('-1 week');

        $aWeekPeriod = new \DatePeriod($start, $interval, $end);

        $aWeekPeriodDates = [];
        foreach ($aWeekPeriod as $value) :
            array_push($aWeekPeriodDates, $value->format('Y-m-d'));
        endforeach;

        $data = [
            'title'                 => 'Dashboard',
            'AppConf'               => $this->AppConfig->index(),
            'totalVisitor'          => $this->VisitorModel->getTotalVisitor(),
            'yesterdayVisitor'      => $this->VisitorModel->getYesterdayVisitor(),
            'todayVisitor'          => $this->VisitorModel->getTodayVisitor(),
            'onlineVisitor'         => $this->VisitorModel->getOnlineVisitor(null),
            'onlineGuestVisitor'    => $this->VisitorModel->getOnlineVisitor('guest'),
            'onlineRegVisitor'      => $this->VisitorModel->getOnlineVisitor('registered'),
            'nameVisitor'           => $this->VisitorModel->getNameVisitor(),
            'weeklyUserVisitor'     => $this->VisitorModel->getNumbVisitorByPriod('guest', $aWeekPeriodDates),
            'weeklyGuestVisitor'    => $this->VisitorModel->getNumbVisitorByPriod('registered', $aWeekPeriodDates),
            'activityLog'           => $this->ActivityLogModel->getActivityLog()->limit(5)->get()->getResultArray(),
        ];

        $data['css']            = [''];
        $data['js']             = ['chartCircle', 'chart'];
        $data['NewJavaScript']  = ['chartCircle', 'chart'];

        return view('\Modules\Dashboard\Views\Dashboard', $data);
    }
}
