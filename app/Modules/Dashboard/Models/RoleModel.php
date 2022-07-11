<?php

namespace Modules\Dashboard\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table      = 'role';
    protected $primaryKey = 'role_id';
    protected $allowedFields = ['role', 'deleted_at'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getRole()
    {
        if (session()->role_id == 1) :
            return $this->findAll();
        else :
            return $this->where(['role_id !=' => 1])->get()->getResultArray();
        endif;
    }

    public function getRoleByID($role_id)
    {
        return $this->where(['role_id' => $role_id]);
    }

    public function search($keyword)
    {
        return $this->table('role')->like('role', $keyword)->orLike('role_id', $keyword);
    }

    public function getTotalDeleted()
    {
        return $this->selectCount('role_id', 'total')->onlyDeleted()->get()->getRow();
    }

    public function getDeletedData()
    {
        return $this->onlyDeleted();
    }

    public function searchDeletedData($keyword)
    {
        return $this->like('role', $keyword)->orLike('role_id', $keyword)->orLike('deleted_at', $keyword)->onlyDeleted();
    }
}
