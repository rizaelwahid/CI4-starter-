<?php

namespace Modules\Dashboard\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table      = 'menu';
    protected $primaryKey = 'menu_id';
    protected $allowedFields = ['parent_id', 'title', 'url', 'icon', 'module', 'is_active', 'deleted_at'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getMenuGrup($module)
    {
        return $this->where(['module' => $module, 'parent_id' => 0, 'deleted_at' => null]);
    }

    public function getMenuByParentId($menu_id)
    {
        return $this->where(['parent_id' => $menu_id]);
    }

    public function getMenuById($menu_id)
    {
        return $this->where(['menu_id' => $menu_id]);
    }

    public function getMenuByTitle($title)
    {
        $this->select('menu_id as id, title as text');
        $this->like('title', $title);
        return $this->limit(20)->get()->getResultArray();
    }

    public function getTotalDeleted()
    {
        return $this->selectCount('menu_id', 'total')->onlyDeleted()->get()->getRow();
    }

    public function getDeletedData()
    {
        return $this->onlyDeleted();
    }

    public function searchDeletedData($keyword)
    {
        return $this->like('title', $keyword)->onlyDeleted();
    }
}
