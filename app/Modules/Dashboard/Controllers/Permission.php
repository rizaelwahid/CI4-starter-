<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use Modules\Dashboard\Controllers\AppConfig;
use CodeIgniter\I18n\Time;

use Modules\Dashboard\Models\PermissionModel;
use Modules\Dashboard\Models\MenuModel;
use Modules\Dashboard\Models\RoleModel;

class Permission extends BaseController
{
    protected $PermissionModel;
    protected $MenuModel;
    protected $RoleModel;

    public function __construct()
    {
        $this->AppConfig = new AppConfig();
        $this->PermissionModel = new PermissionModel();
        $this->MenuModel = new MenuModel();
        $this->RoleModel = new RoleModel();
    }

    public function index()
    {
        $data = [
            'title'         => 'Permission',
            'AppConf'       => $this->AppConfig->index(),
            'viewer'        => '',
            'permissions'   => $this->PermissionModel->getPermission()->findAll(),
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];

        return view('\Modules\Dashboard\Views\Permission', $data);
    }

    public function create()
    {
        if (count($this->request->getPost()) <= 0) :

            $data = [
                'title'         => 'Permission',
                'validation'    => \config\Services::validation(),
                'AppConf'       => $this->AppConfig->index(),
                'menu'          => $this->MenuModel->findAll(),
                'viewer'        => 'create',
            ];

            $data['css']            = [''];
            $data['js']             = ['select2'];
            $data['NewJavaScript']  = ['select2'];

            return view('\Modules\Dashboard\Views\Permission', $data);

        else :

            $rules = [
                // 'class'     => 'required',
                'functionx' => 'required',
                'title'     => 'required',
                'icon'      => 'required',
            ];

            if (!$this->validate($rules)) :
                return redirect()->to('/permission/create')->withInput();
            endif;

            $array = [
                'class'     => htmlspecialchars(strtolower($this->request->getVar('class'))),
                'function'  => htmlspecialchars(strtolower($this->request->getVar('functionx'))),
                'title'     => htmlspecialchars($this->request->getVar('title')),
                'icon'      => htmlspecialchars($this->request->getVar('icon')),
                'color'     => htmlspecialchars($this->request->getVar('color')),
                'is_active' => 1
            ];

            $save = $this->PermissionModel->save($array);

            if ($save) :
                $activity   = 'create';
                $module_id  = $this->PermissionModel->getInsertID();
                SaveActivityLog($module_id, $activity, null);

                session()->setFlashdata('yeah', 'Data Created, now you can rule the Matrix.');
                return redirect()->to('/permission');
            else :
                session()->setFlashdata('boo', 'We’re having trouble create the data.');
                return redirect()->to('/permission');
            endif;

        endif;
    }

    public function edit($permission_id)
    {
        $permission = $this->PermissionModel->getPermissionById($permission_id)->first();

        if (count($this->request->getPost()) <= 0) :

            $data = [
                'title'         => 'Permission',
                'AppConf'       => $this->AppConfig->index(),
                'viewer'        => 'edit',
                'validation'    => \config\Services::validation(),
                'permission'    => $permission,
                'menu'          => $this->MenuModel->findAll()
            ];

            $data['css']            = [''];
            $data['js']             = ['select2'];
            $data['NewJavaScript']  = ['select2'];

            return view('\Modules\Dashboard\Views\Permission', $data);

        else :

            $rules = [
                // 'class'     => 'required',
                'function'  => 'required',
                'title'     => 'required',
                'icon'      => 'required',
            ];

            if (!$this->validate($rules)) :
                return redirect()->to('/permission/edit/' . $permission_id)->withInput();
            endif;

            $array = [
                'permission_id' => $permission_id,
                'class'         => htmlspecialchars(strtolower($this->request->getVar('class'))),
                'function'      => htmlspecialchars(strtolower($this->request->getVar('function'))),
                'title'         => htmlspecialchars($this->request->getVar('title')),
                'icon'          => htmlspecialchars($this->request->getVar('icon')),
                'color'         => htmlspecialchars($this->request->getVar('color')),
                'is_active'     => htmlspecialchars($this->request->getVar('is_active'))
            ];

            $save = $this->PermissionModel->save($array);

            if ($save) :
                $activity   = 'update';
                $module_id  = $permission_id;
                SaveActivityLog($module_id, $activity, $permission);

                session()->setFlashdata('yeah', 'Data successfully updated.');
                return redirect()->to('/permission');
            else :
                session()->setFlashdata('boo', 'We’re having trouble updating this data.');
                return redirect()->to('/permission');
            endif;

        endif;
    }

    public function delete($permission_id)
    {
        $delete = $this->PermissionModel->delete($permission_id);

        if ($delete) :
            $activity   = 'delete';
            $module_id  = $permission_id;
            SaveActivityLog($module_id, $activity, null);

            session()->setFlashdata('yeah', 'Data success full deleted.');
            return redirect()->to('/permission');
        else :
            session()->setFlashdata('boo', 'We’re having trouble deleting this data.');
            return redirect()->to('/permission');
        endif;
    }

    public function trash()
    {
        $currentPage = $this->request->getVar('page_permission') ? $this->request->getVar('page_permission') : 1;
        $keyword = $this->request->getVar('keyword');

        if ($keyword) :
            $searchdata = $this->PermissionModel->searchDeletedData($keyword);
        else :
            $searchdata = $this->PermissionModel->getDeletedData();
        endif;

        $data = [
            'title'         => 'Permission',
            'AppConf'       => $this->AppConfig->index(),
            'viewer'        => 'trash',
            'permissions'   => $searchdata->paginate(10, 'permission'),
            'pager'         => $this->PermissionModel->pager,
            'currentPage'   => $currentPage
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];

        return view('\Modules\Dashboard\Views\Permission', $data);
    }

    public function restore($permission_id)
    {
        $restore = $this->PermissionModel->set('deleted_at', null)->where('permission_id', $permission_id)->update();

        if ($restore) :
            $activity   = 'restore';
            $module_id  = $permission_id;
            SaveActivityLog($module_id, $activity, null);

            session()->setFlashdata('yeah', 'Data successfully restored.');
            return redirect()->to('/permission/trash');
        else :
            session()->setFlashdata('boo', 'We’re having trouble deleting this data.');
            return redirect()->to('/permission/trash');
        endif;
    }

    public function hardDelete($permission_id)
    {
        $permission = $this->PermissionModel->getPermissionById($permission_id)->onlyDeleted()->first();
        $delete     = $this->PermissionModel->delete($permission_id, true);

        if ($delete) :
            $activity   = 'permanent delete';
            $module_id  = $permission_id;
            SaveActivityLog($module_id, $activity, $permission);

            session()->setFlashdata('yeah', 'Data success full deleted.');
            return redirect()->to('/permission/trash');
        else :
            session()->setFlashdata('boo', 'We’re having trouble deleting this data.');
            return redirect()->to('/permission/trash');
        endif;
    }

    public function accesscontrol()
    {
        $data = [
            'title'         => 'Permission Access Control',
            'AppConf'       => $this->AppConfig->index(),
            'roles'         => $this->RoleModel->getRole(),
            'permission'    => $this->PermissionModel->getPermission()->get()->getResultArray(),
            'viewer'        => 'permission'
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = ['changePermission'];

        return view('\Modules\Dashboard\Views\Permission', $data);
    }

    public function changePermission()
    {
        $db      = \Config\Database::connect();

        $role_id        = $this->request->getVar('role_id');
        $permission_id  = $this->request->getVar('permission_id');
        $role           = $this->RoleModel->getRoleByID($role_id)->first();

        $query = $db->table('role_has_permission')->where([
            'role_id'          => $role_id,
            'permission_id'    => $permission_id
        ]);

        if ($query->countAllResults() < 1) :
            $result = $db->table('role_has_permission')->insert([
                'role_id'        => $role_id,
                'permission_id'  => $permission_id,
                'created_at'     => Time::now(),
                'updated_at'     => Time::now()
            ]);
        else :
            $result = $db->table('role_has_permission')->delete([
                'role_id'       => $role_id,
                'permission_id' => $permission_id
            ]);
        endif;

        if ($result) :
            $activity   = 'change permission';
            $module_id  = $permission_id;
            SaveActivityLog($module_id, $activity, NULL);

            session()->setFlashdata('yeah', 'It seems that you have changed the permission for role <b>' . $role['role'] . '</b>, please reconsider granting permission to this role!');
        endif;
    }
}
