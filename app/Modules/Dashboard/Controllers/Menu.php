<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use Modules\Dashboard\Controllers\AppConfig;
use CodeIgniter\I18n\Time;

use Modules\Dashboard\Models\MenuModel;
use Modules\Dashboard\Models\RoleModel;

class Menu extends BaseController
{
    protected $MenuModel;
    protected $RoleModel;

    public function __construct()
    {
        $this->AppConfig = new AppConfig();
        $this->MenuModel = new MenuModel();
        $this->RoleModel = new RoleModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Menu',
            'AppConf' => $this->AppConfig->index(),
            'viewer'  => '',
        ];

        $data['menuGrup']       = $this->MenuModel->getMenuGrup('Dashboard')->where(['deleted_at' => null])->get()->getResultArray();

        foreach ($data['menuGrup'] as &$menu) :
            $menu['menu'] = $this->MenuModel->getMenuByParentId($menu['menu_id'])->where(['deleted_at' => null])->get()->getResultArray();
            foreach ($menu['menu'] as &$menusub) :
                $menusub['menusub'] = $this->MenuModel->getMenuByParentId($menusub['menu_id'])->where(['deleted_at' => null])->get()->getResultArray();
                foreach ($menusub['menusub'] as &$menusubsub) :
                    $menusubsub['menusubsub'] = $this->MenuModel->getMenuByParentId($menusubsub['menu_id'])->where(['deleted_at' => null])->get()->getResultArray();
                endforeach;
            endforeach;
        endforeach;

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];

        return view('\Modules\Dashboard\Views\Menu', $data);
    }

    public function create()
    {
        if (count($this->request->getPost()) <= 0) :

            $data = [
                'title'         => 'Create Menu',
                'validation'    => \config\Services::validation(),
                'AppConf'       => $this->AppConfig->index(),
                'viewer'        => 'create',
            ];

            $data['css']            = [];
            $data['js']             = ['select2'];
            $data['NewJavaScript']  = ['select2Menu'];

            return view('\Modules\Dashboard\Views\Menu', $data);
        else :
            $rules = [
                'url'      => [
                    'rules'     => 'is_unique[menu.url]',
                    'errors'    => [
                        'is_unique'  => 'The url field must contain a unique value, the url has taken.'
                    ]
                ],
            ];

            if (!$this->validate($rules)) :
                return redirect()->to('/menu/create')->withInput();
            endif;

            $array = [
                'parent_id'  => htmlspecialchars($this->request->getVar('parent_id')),
                'title'      => htmlspecialchars($this->request->getVar('title')),
                'url'        => htmlspecialchars($this->request->getVar('url')),
                'icon'       => htmlspecialchars($this->request->getVar('icon')),
                'module'     => 'Dashboard',
                'is_active'  => 1,
            ];

            $save = $this->MenuModel->save($array);

            if ($save) :
                $activity       = 'create';
                $reference_id  = $this->MenuModel->getInsertID();
                SaveActivityLog($reference_id, $activity, null);

                session()->setFlashdata('yeah', 'Data Created.');
                return redirect()->to('/menu');
            else :
                session()->setFlashdata('boo', 'We’re having trouble create the data.');
                return redirect()->to('/menu');
            endif;
        endif;
    }

    public function edit()
    {
        $menu_id = htmlspecialchars($this->request->uri->getSegment(3));
        $menu    = $this->MenuModel->getMenuById($menu_id)->first();

        if (count($this->request->getPost()) <= 0) :

            $parent = $this->MenuModel->getMenuById($menu['parent_id'])->first();

            $data = [
                'title'         => 'Menu',
                'AppConf'       => $this->AppConfig->index(),
                'viewer'        => 'edit',
                'validation'    => \config\Services::validation(),
                'menu'          => $menu,
                'parent'        => $parent,
            ];

            $data['css']            = [''];
            $data['js']             = ['select2'];
            $data['NewJavaScript']  = ['select2Menu'];

            return view('\Modules\Dashboard\Views\Menu', $data);
        else :
            $menu_id = htmlspecialchars($this->request->uri->getSegment(3));

            $array = [
                'menu_id'   => $menu_id,
                'parent_id' => htmlspecialchars($this->request->getVar('parent_id')),
                'title'     => htmlspecialchars($this->request->getVar('title')),
                'url'       => htmlspecialchars($this->request->getVar('url')),
                'icon'      => htmlspecialchars($this->request->getVar('icon')),
                'is_active' => htmlspecialchars($this->request->getVar('is_active'))
            ];

            $save = $this->MenuModel->save($array);

            if ($save) :
                $activity   = 'update';
                $reference_id  = $menu_id;
                SaveActivityLog($reference_id, $activity, $menu);

                session()->setFlashdata('yeah', 'Data successfully updated.');
                return redirect()->to('/menu');
            else :
                session()->setFlashdata('boo', 'We’re having trouble updating this data.');
                return redirect()->to('/menu');
            endif;
        endif;
    }

    public function delete($menu_id)
    {
        $delete = $this->MenuModel->delete($menu_id);

        if ($delete) :
            $activity   = 'delete';
            $module_id  = $menu_id;
            SaveActivityLog($module_id, $activity, null);

            session()->setFlashdata('yeah', 'Data successfully deleted.');
            return redirect()->to('/menu');
        else :
            session()->setFlashdata('boo', 'We’re having trouble deleting this data.');
            return redirect()->to('/menu');
        endif;
    }

    public function trash()
    {
        $currentPage = $this->request->getVar('page_menu') ? $this->request->getVar('page_menu') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) :
            $searchdata = $this->MenuModel->searchDeletedData($keyword);
        else :
            $searchdata = $this->MenuModel->getDeletedData();
        endif;

        $data = [
            'title'         => 'Menu',
            'menu'          => $searchdata->paginate(10, 'menu'),
            'pager'         => $this->MenuModel->pager,
            'currentPage'   => $currentPage,
            'AppConf'       => $this->AppConfig->index(),
            'viewer'        => 'trash',
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];

        return view('\Modules\Dashboard\Views\Menu', $data);
    }

    public function restore($menu_id)
    {
        $restore = $this->MenuModel->set('deleted_at', null)->where('menu_id', $menu_id)->update();

        if ($restore) :
            $activity   = 'restore';
            $module_id  = $menu_id;
            SaveActivityLog($module_id, $activity, null);

            session()->setFlashdata('yeah', 'Data successfully restored.');
            return redirect()->to('/menu/trash');
        else :
            session()->setFlashdata('boo', 'We’re having trouble deleting this data.');
            return redirect()->to('/menu/trash');
        endif;
    }

    public function hardDelete($menu_id)
    {
        $menu   = $this->MenuModel->getMenuById($menu_id)->onlyDeleted()->first();
        $delete = $this->MenuModel->delete($menu_id, true);

        if ($delete) :
            $activity   = 'permanent delete';
            $module_id  = $menu_id;
            SaveActivityLog($module_id, $activity, $menu);

            session()->setFlashdata('yeah', 'Data success full deleted.');
            return redirect()->to('/menu/trash');
        else :
            session()->setFlashdata('boo', 'We’re having trouble deleting this data.');
            return redirect()->to('/menu/trash');
        endif;
    }

    function getMenuByTitle()
    {
        $text = htmlspecialchars($this->request->getVar('q'));
        echo json_encode($this->MenuModel->getMenuByTitle($text));
    }

    public function accessControl()
    {
        $currentPage = $this->request->getVar('page_menus') ? $this->request->getVar('page_menus') : 1;

        $data = [
            'title'         => 'Access Control',
            'AppConf'       => $this->AppConfig->index(),
            'viewer'        => 'access'
        ];

        $data['roles']      = $this->RoleModel->getRole();
        $data['menuGrup']   = $this->MenuModel->getMenuGrup('Dashboard')->where(['deleted_at' => null])->get()->getResultArray();

        foreach ($data['menuGrup'] as &$menu) :
            $menu['menu'] = $this->MenuModel->getMenuByParentId($menu['menu_id'])->where(['deleted_at' => null])->get()->getResultArray();
            foreach ($menu['menu'] as &$menusub) :
                $menusub['menusub'] = $this->MenuModel->getMenuByParentId($menusub['menu_id'])->where(['deleted_at' => null])->get()->getResultArray();
                foreach ($menusub['menusub'] as &$menusubsub) :
                    $menusubsub['menusubsub'] = $this->MenuModel->getMenuByParentId($menusubsub['menu_id'])->where(['deleted_at' => null])->get()->getResultArray();
                endforeach;
            endforeach;
        endforeach;

        $data['pager']         = $this->MenuModel->pager;
        $data['currentPage']   = $currentPage;

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = ['changeMenuPermission'];

        return view('\Modules\Dashboard\Views\Menu', $data);
    }

    public function changeMenuPermission()
    {
        $db      = \Config\Database::connect();

        $role_id = $this->request->getVar('role_id');
        $menu_id = $this->request->getVar('menu_id');
        $role    = $this->RoleModel->getRoleByID($role_id)->first();

        $query = $db->table('role_has_menu')->where([
            'role_id'       => $role_id,
            'menu_id'       => $menu_id
        ]);

        if ($query->countAllResults() == 0) :
            $result = $db->table('role_has_menu')->insert([
                'role_id'      => $role_id,
                'menu_id'      => $menu_id,
                'created_at'   => Time::now(),
                'updated_at'   => Time::now()
            ]);
        else :
            $result = $db->table('role_has_menu')->delete([
                'role_id' => $role_id,
                'menu_id' => $menu_id
            ]);
        endif;

        if ($result) :
            $activity   = 'change access';
            $module_id  = $menu_id;
            SaveActivityLog($module_id, $activity, NULL);

            session()->setFlashdata('yeah', 'It seems that you have changed the authority for role <b>' . $role['role'] . '</b>, please reconsider granting access to this role!');
        endif;
    }
}
