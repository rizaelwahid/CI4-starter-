<?php

namespace Modules\Dashboard\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'name', 'email', 'password', 'avatar', 'role_id', 'is_active', 'deleted_at'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getUser()
    {
        $this->select('user.*, role.role');

        if (session()->role_id != 1) :
            $this->where(['role.role_id !=' => 1]);
        endif;

        $this->join('role', 'role.role_id = user.role_id', 'left');
        return $this->orderBy('user.user_id', 'DESC');
    }

    public function getUserById($user_id)
    {
        $this->join('role', 'role.role_id = user.role_id', 'left');
        return $this->where(['user_id' => $user_id]);
    }

    public function search($keyword)
    {
        $this->select('user.*, role.role');

        if (session()->role_id != 1) :
            $this->where(['role.role_id !=' => 1]);
        endif;

        $this->groupStart();
        $this->like('user.name', $keyword);
        $this->orLike('user.role_id', $keyword);
        $this->orLike('user.email', $keyword);
        $this->groupEnd();
        return $this->join('role', 'role.role_id = user.role_id');
    }

    public function getTotalDeleted()
    {
        return $this->selectCount('user_id', 'total')->where(['deleted_at !=' => NULL])->get()->getRow();
    }

    public function getDeletedData()
    {
        return $this->table('user')->select('user.*, role.role')->join('role', 'role.role_id = user.role_id', 'left')->orderBy('user.deleted_at', 'DESC')->onlyDeleted();
    }

    public function searchDeletedData($keyword)
    {
        return $this->table('user')->select('user.*, role.role')->join('role', 'role.role_id = user.role_id', 'left')->like('user.name', $keyword)->orLike('user.role_id', $keyword)->orLike('user.email', $keyword)->orLike('user.deleted_at', $keyword)->onlyDeleted();
    }
}
