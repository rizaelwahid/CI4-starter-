<?php

namespace Modules\Dashboard\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table            = 'visitor';
    protected $primaryKey       = 'visitor_id';
    protected $allowedFields    = ['user_id', 'is_online', 'type', 'created_at'];

    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;

    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';


    function getTotalVisitor()
    {
        return $this->countAll('visitor_id');
    }

    function getOnlineVisitor($type)
    {
        $is_onlien  = time() - (60 * 3);
        if ($type != NULL) :
            return $this->where(['is_online >' => $is_onlien, 'type' => $type])->countAllResults();
        else :
            return $this->where('is_online >', $is_onlien)->countAllResults();
        endif;
    }
    function getYesterdayVisitor()
    {
        $yesterday  = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
        return $this->selectCount('DATE(created_at)', 'total')->where('DATE(created_at)', $yesterday)->countAllResults();
    }

    function getTodayVisitor()
    {
        $today      = date("Y-m-d");
        return $this->selectCount('DATE(created_at)', 'total')->where('DATE(created_at)', $today)->countAllResults();
    }
    public function getNumbVisitorByPriod($type, $array)
    {
        $this->select('DATE(`created_at`) AS `date`, COUNT(DATE(`created_at`)) AS `totalVisitor`');
        $this->whereIn('DATE(created_at)', $array);
        $this->where('type', $type);
        return $this->groupBy('DATE(`created_at`)')->get()->getResultArray();
    }

    function getNameVisitor()
    {
        $is_onlien  = time() - (60 * 3);
        $this->select('user.username, user.avatar, user.user_id');
        $this->join('user', 'user.user_id = visitor.user_id', 'left');
        $this->where(['is_online >' => $is_onlien, 'type' => 'registered']);
        return $this->limit(10)->get()->getResultArray();
    }
}
