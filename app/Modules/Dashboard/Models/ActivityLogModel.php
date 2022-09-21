<?php

namespace Modules\Dashboard\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table      = 'activity_log';
    protected $primaryKey = 'activity_id';
    protected $allowedFields = ['deleted_at'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getActivityLog($activity_id = false)
    {
        if ($activity_id == false) :
            $this->select('activity_log.*, user.name, menu.title');
            $this->join('user', 'user.user_id = activity_log.user_id', 'left');
            $this->join('menu', 'menu.menu_id = activity_log.menu_id', 'left');
            return $this->orderBy('activity_log.activity_id', 'DESC');
        endif;
        $this->join('menu', 'menu.menu_id = activity_log.menu_id', 'left');
        return $this->where(['activity_id' => $activity_id])->first();
    }

    public function search($keyword)
    {
        $this->select('activity_log.*, user.name, menu.title');
        $this->join('user', 'user.user_id = activity_log.user_id', 'left');
        $this->join('menu', 'menu.menu_id = activity_log.menu_id', 'left');
        return $this->like('user.name', $keyword)->orLike('activity', $keyword);
    }

    public function getTotalDeleted()
    {
        return $this->selectCount('user_id', 'total')->where(['deleted_at !=' => NULL])->get()->getRow();
    }

    public function getDeletedData()
    {
        return $this->table('activity_log')->select('activity_log.*, user.name')->join('user', 'user.user_id = activity_log.user_id', 'left')->orderBy('activity_log.activity_id', 'DESC')->onlyDeleted();
    }

    public function searchDeleted($keyword)
    {
        return $this->join('user', 'user.user_id = activity_log.user_id', 'left')->like('user.name', $keyword)->orLike('activity', $keyword)->onlyDeleted();
    }
}
