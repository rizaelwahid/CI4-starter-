<?php

namespace Modules\Dashboard\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table      = 'permission';
    protected $primaryKey = 'permission_id';
    protected $allowedFields = ['class', 'function', 'title', 'icon', 'color', 'is_active', 'deleted_at'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getPermission()
    {
        $this->select(['permission.*', 'menu.title AS menuTitle']);
        return $this->join('menu', 'menu.menu_id = permission.class', 'left');
    }

    public function getPermissionById($permission_id)
    {
        $this->select(['permission.*', 'menu.title AS menuTitle']);
        $this->where(['permission_id' => $permission_id]);
        return $this->join('menu', 'menu.menu_id = permission.class', 'left');
    }

    public function getRolePermissionByClassNRoleId()
    {
        $requri = \Config\Services::request();
        $class = $requri->uri->getSegment(1);
        $role_id = session()->role_id;
        $this->join('role_has_permission', 'role_has_permission.permission_id = permission.permission_id', 'left');
        return $this->getWhere(['class' => $class, 'role_has_permission.role_id' => $role_id, 'is_active' => 1, 'permission.deleted_at ' => NULL]);
    }

    public function getUserPermissionByRoleId($role_id)
    {
        return $this->join('role_has_permission', 'role_has_permission.permission_id = permission.permission_id', 'left')->getWhere(['role_has_permission.role_id' => $role_id, 'is_active' => 1])->getResultArray();
    }

    public function getTotalDeleted()
    {
        return $this->selectCount('permission_id', 'total')->onlyDeleted()->get()->getRow();
    }

    public function getDeletedData()
    {
        return $this->onlyDeleted();
    }

    public function searchDeletedData($keyword)
    {
        return $this->like('title', $keyword)->orLike('class', $keyword)->orLike('function', $keyword)->orLike('deleted_at', $keyword)->onlyDeleted();
    }
}
