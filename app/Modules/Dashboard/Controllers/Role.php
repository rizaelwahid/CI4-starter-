<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use Modules\Dashboard\Controllers\AppConfig;

use Modules\Dashboard\Models\PermissionModel;
use Modules\Dashboard\Models\RoleModel;
use Modules\Dashboard\Models\MenuModel;

class Role extends BaseController
{
    protected $PermissionModel;
    protected $RoleModel;
    protected $MenuModel;

    public function __construct()
    {
        $this->AppConfig = new AppConfig();
        $this->PermissionModel = new PermissionModel();
        $this->RoleModel = new RoleModel();
        $this->MenuModel = new MenuModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_role') ? $this->request->getVar('page_role') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) :
            $searchdata = $this->RoleModel->search($keyword);
        else :
            $searchdata = $this->RoleModel;
        endif;

        $data = [
            'title'         => 'Role',
            'AppConf'       => $this->AppConfig->index(),
            'role'          => $searchdata->paginate(5, 'role'),
            'pager'         => $this->RoleModel->pager,
            'currentPage'   => $currentPage,
            'viewer'        => '',
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];

        return view('\Modules\Dashboard\Views\Role', $data);
    }

    public function create()
    {
        if (count($this->request->getPost()) <= 0) :
            $data = [
                'title'         => 'Role',
                'AppConf'       => $this->AppConfig->index(),
                'validation'    => \config\Services::validation(),
                'viewer'        => 'create',
            ];

            $data['css']            = [''];
            $data['js']             = [''];
            $data['NewJavaScript']  = [''];

            return view('\Modules\Dashboard\Views\Role', $data);
        else :
            $rules = [
                'role'  => 'required|alpha_space|min_length[2]|is_unique[role.role]'
            ];

            if (!$this->validate($rules)) :
                return redirect()->to('/role/create')->withInput();
            endif;

            $array = [
                'role'  => htmlspecialchars($this->request->getVar('role'))
            ];

            $save = $this->RoleModel->save($array);

            if ($save) :
                $activity   = 'create';
                $module_id  = $this->RoleModel->getInsertID();
                SaveActivityLog($module_id, $activity, NULL);

                session()->setFlashdata('yeah', 'Data Created, now you can rule the Matrix.');
                return redirect()->to('/role');
            else :
                session()->setFlashdata('boo', 'We’re having trouble create the data.');
                return redirect()->to('/role');
            endif;
        endif;
    }

    public function delete($role_id)
    {
        $delete = $this->RoleModel->delete($role_id);

        if ($delete) :
            $activity   = 'delete';
            $module_id  = $role_id;
            SaveActivityLog($module_id, $activity, NULL);

            session()->setFlashdata('yeah', 'Data success full deleted.');
            return redirect()->to('/role');
        else :
            session()->setFlashdata('boo', 'We’re having trouble deleting this data.');
            return redirect()->to('/role');
        endif;
    }

    public function edit($role_id)
    {
        $role = $this->RoleModel->getRoleByID($role_id)->first();
        if (count($this->request->getPost()) <= 0) :
            $data = [
                'title'         => 'Role',
                'AppConf'       => $this->AppConfig->index(),
                'validation'    => \config\Services::validation(),
                'role'          => $role,
                'viewer'        => 'edit'
            ];

            $data['css']            = [''];
            $data['js']             = [''];
            $data['NewJavaScript']  = [''];

            return view('\Modules\Dashboard\Views\Role', $data);
        else :
            $rules = [
                'role'  => 'required|alpha_space|min_length[2]|is_unique[role.role,role_id,' . $role_id . ']'
            ];

            if (!$this->validate($rules)) :
                return redirect()->to('/role/edit/' . $role_id)->withInput();
            endif;

            $save = $this->RoleModel->save([
                'role_id'   => $role_id,
                'role'  => htmlspecialchars($this->request->getVar('role'))
            ]);

            if ($save) :
                $activity   = 'update';
                $module_id  = $role_id;
                SaveActivityLog($module_id, $activity, $role);

                session()->setFlashdata('yeah', 'Data success full updated.');
                return redirect()->to('/role');
            else :
                session()->setFlashdata('boo', 'We’re having trouble updating this data.');
                return redirect()->to('/role');
            endif;
        endif;
    }

    public function trash()
    {
        $currentPage = $this->request->getVar('page_role') ? $this->request->getVar('page_role') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) :
            $searchdata = $this->RoleModel->searchDeletedData($keyword);
        else :
            $searchdata = $this->RoleModel->getDeletedData();
        endif;

        $data = [
            'title'         => 'Role',
            'AppConf'       => $this->AppConfig->index(),
            'role'          => $searchdata->paginate(5, 'role'),
            // 'role'          => $searchdata,
            'pager'         => $this->RoleModel->pager,
            'currentPage'   => $currentPage,
            'viewer'        => 'trash'
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];

        return view('\Modules\Dashboard\Views\Role', $data);
    }

    public function restore($role_id)
    {
        $restore = $this->RoleModel->set('deleted_at', null)->where('role_id', $role_id)->update();

        if ($restore) :
            $activity   = 'restore';
            $module_id  = $role_id;
            SaveActivityLog($module_id, $activity, NULL);

            session()->setFlashdata('yeah', 'Data successfully restored.');
            return redirect()->to('/role/trash');
        else :
            session()->setFlashdata('boo', 'We’re having trouble deleting this data.');
            return redirect()->to('/role/trash');
        endif;
    }

    public function hardDelete($role_id)
    {
        $role = $this->RoleModel->getRoleByID($role_id)->onlyDeleted()->first();
        $delete = $this->RoleModel->delete($role_id, true);

        if ($delete) :
            $activity   = 'permanent delete';
            $module_id  = $role_id;
            SaveActivityLog($module_id, $activity, $role);

            session()->setFlashdata('yeah', 'Data success full deleted.');
            return redirect()->to('/role/trash');
        else :
            session()->setFlashdata('boo', 'We’re having trouble deleting this data.');
            return redirect()->to('/role/trash');
        endif;
    }
}
