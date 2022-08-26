<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use Modules\Dashboard\Controllers\AppConfig;

use Modules\Dashboard\Models\UserModel;
use Modules\Dashboard\Models\RoleModel;
use Modules\Dashboard\Models\PermissionModel;

class User extends BaseController
{
    protected $UserModel;
    protected $RoleModel;
    protected $PermissionModel;

    public function __construct()
    {
        $this->AppConfig = new AppConfig();
        $this->UserModel = new UserModel();
        $this->RoleModel = new RoleModel();
        $this->PermissionModel = new PermissionModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) :
            $searchdata = $this->UserModel->search($keyword);
        else :
            $searchdata = $this->UserModel->getUser();
        endif;

        $data = [
            'title'         => 'User',
            'AppConf'       => $this->AppConfig->index(),
            'user'          => $searchdata->paginate(5, 'user'),
            'pager'         => $this->UserModel->pager,
            'currentPage'   => $currentPage,
            'viewer'        => ''
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];

        return view('\Modules\Dashboard\Views\User', $data);
    }

    public function create()
    {
        if (count($this->request->getPost()) <= 0) :
            $data = [
                'title'         => 'User',
                'AppConf'       => $this->AppConfig->index(),
                'validation'    => \config\Services::validation(),
                'getrole'       => $this->RoleModel->getRole(),
                'viewer'        => 'create'
            ];

            $data['css']            = [''];
            $data['js']             = [''];
            $data['NewJavaScript']  = ['avatarPreview'];

            return view('\Modules\Dashboard\Views\User', $data);

        else :

            $rules = [
                'name'      => [
                    'rules'     => 'required|alpha_space|min_length[2]',
                    'errors'    => [
                        // 'required'  => 'Kolom {field} harus diisi',
                        // 'is_unique' => '{field} name sudah ada'
                    ]
                ],
                'username'     => [
                    'rules'     => 'required|alpha|is_unique[user.username]',
                    'errors'    => [
                        'is_unique'  => 'The username field must contain a unique value, the username has taken.'
                    ]
                ],
                'email'     => [
                    'rules'     => 'required|valid_email|is_unique[user.email]',
                    'errors'    => [
                        // 'required'  => 'Kolom {field} harus diisi',
                        // 'valid_email' => 'Format email salah',
                        // 'is_unique' => '{field} sudah ada'
                    ]
                ],
                'password'      => 'required|min_length[3]',
                'confPassword'      => [
                    'rules'     => 'required|matches[password]',
                    'errors'    => [
                        'required'  => 'The confirm password field is required. ',
                    ]
                ],
                'avatar'     => [
                    'rules'     => 'max_size[avatar,1024]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]',
                    'errors'    => [
                        'max_size' => 'The uploaded image is oversize than 1MB.',
                        'is_image' => 'The uploaded file is not a image.',
                        'mime_in'  => 'The uploaded file is not a image.'
                    ]
                ],
                'role'  => 'required|numeric'
            ];

            if (!$this->validate($rules)) :
                return redirect()->to('/user/create')->withInput();
            endif;

            $fileAvatar = $this->request->getFile('avatar');

            if ($fileAvatar->getError() == 4) :
                $avatarName = 'default.jpg';
            else :
                $avatarName = $fileAvatar->getRandomName();
                $fileAvatar->move('assets/images/avatar/', $avatarName);
            endif;

            $array  = [
                'name'      => htmlspecialchars($this->request->getVar('name')),
                'username'  => htmlspecialchars($this->request->getVar('username')),
                'email'     => htmlspecialchars($this->request->getVar('email')),
                'password'  => htmlspecialchars(password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)),
                'avatar'    => $avatarName,
                'role_id'   => htmlspecialchars($this->request->getVar('role'))
            ];

            $save   = $this->UserModel->save($array);

            if ($save) :
                $activity   = 'create';
                $module_id  = $this->UserModel->getInsertID();
                SaveActivityLog($module_id, $activity, NUll);

                session()->setFlashdata('yeah', 'Data Created, now you can rule the Matrix.');
                return redirect()->to('/user');
            else :
                session()->setFlashdata('boo', 'We’re having trouble create the data.');
                return redirect()->to('/user');
            endif;

        endif;
    }

    public function edit($user_id)
    {
        $user = $this->UserModel->getUserById($user_id)->first();

        if (count($this->request->getPost()) <= 0) :
            $data = [
                'title'         => 'Edit User',
                'AppConf'       => $this->AppConfig->index(),
                'validation'    => \config\Services::validation(),
                'user'          => $user,
                'getrole'       => $this->RoleModel->getRole(),
                'viewer'       => 'edit'
            ];

            $data['css']            = [''];
            $data['js']             = [''];
            $data['NewJavaScript']  = ['avatarPreview'];

            return view('\Modules\Dashboard\Views\User', $data);
        else :
            $rules = [
                'name'      => [
                    'rules'     => 'required|min_length[2]',
                    'errors'    => []
                ],
                'username'     => [
                    'rules'     => 'required|alpha|is_unique[user.username,user_id,' . $user_id . ']',
                    'errors'    => [
                        'is_unique'  => 'The username field must contain a unique value, the username has taken.'
                    ]
                ],
                'email'     => [
                    'rules'     => 'required|valid_email|is_unique[user.email,user_id,' . $user_id . ']',
                    'errors'    => []
                ],
                'avatar'     => [
                    'rules'     => 'max_size[avatar,1024]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]',
                    'errors'    => [
                        'max_size' => 'The uploaded image is oversize than 1MB.',
                        'is_image' => 'The uploaded file is not a image.',
                        'mime_in' => 'The uploaded file is not a image.'
                    ]
                ],
                'role'  => 'required|numeric'
            ];

            if (!$this->validate($rules)) :
                return redirect()->to('/user/edit/' . $user_id)->withInput();
            endif;

            $fileAvatar = $this->request->getFile('avatar');

            if ($fileAvatar->getError() == 4) :
                $avatarName = $this->request->getVar('avatarOld');
            else :
                $avatarName = $fileAvatar->getRandomName();
                $fileAvatar->move('assets/images/avatar', $avatarName);

                $data = $this->UserModel->find($user_id);

                if ($data['avatar'] != 'default.jpg') :
                    unlink('assets/images/avatar/' . $data['avatar']);
                endif;
            endif;

            $array = [
                'user_id'   => $user_id,
                'name'      => htmlspecialchars($this->request->getVar('name')),
                'username'  => htmlspecialchars($this->request->getVar('username')),
                'email'     => htmlspecialchars($this->request->getVar('email')),
                'avatar'    => $avatarName,
                'role_id'   => htmlspecialchars($this->request->getVar('role')),
                'is_active' => htmlspecialchars($this->request->getVar('is_active'))
            ];

            $save = $this->UserModel->save($array);

            if ($save) :
                $activity   = 'update';
                $module_id  = $user_id;
                SaveActivityLog($module_id, $activity, $user);

                session()->setFlashdata('yeah', 'Data success full updated.');
                return redirect()->to('/user');
            else :
                session()->setFlashdata('boo', 'We’re having trouble updating this data.');
                return redirect()->to('/user');
            endif;
        endif;
    }

    public function view($user_id)
    {
        $data = [
            'title'     => 'User Profile',
            'AppConf'   => $this->AppConfig->index(),
            'user'      => $this->UserModel->getUserById($user_id)->first(),
            'viewer'    => 'view'
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];
        return view('\Modules\Dashboard\Views\User', $data);
    }

    public function delete($user_id)
    {
        $delete = $this->UserModel->delete($user_id);

        if ($delete) :
            $activity   = 'delete';
            $module_id  = $user_id;
            SaveActivityLog($module_id, $activity, NULL);

            session()->setFlashdata('yeah', 'Data success full deleted.');
            return redirect()->to('/user');
        else :
            session()->setFlashdata('boo', 'We’re having trouble deleting this data.');
            return redirect()->to('/user');
        endif;
    }

    public function resetpassword($user_id)
    {
        $data = [
            'title'         => 'User',
            'AppConf'       => $this->AppConfig->index(),
            'validation'    => \config\Services::validation(),
            'user'          => $this->UserModel->getUserById($user_id)->first(),
            'viewer'       => 'reset'
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];
        return view('\Modules\Dashboard\Views\User', $data);
    }

    public function resetPasswordProcess($user_id)
    {
        $rules = [
            'password'          => 'required',
            'newpassword'       => 'required|min_length[6]',
            'repeatpassword'    => 'required|matches[newpassword]|min_length[6]',
        ];

        $segment2          = htmlspecialchars($this->request->getVar('segment2'));

        if (!$this->validate($rules)) :
            return redirect()->to('/user/' . $segment2 . '/' . $user_id)->withInput();
        endif;

        $auth              = $this->UserModel->where(['user_id' => session()->user_id])->first();

        $password          = htmlspecialchars($this->request->getVar('password'));
        $newpassword       = htmlspecialchars($this->request->getVar('newpassword'));

        if (!password_verify($password, $auth['password'])) :
            session()->setFlashdata('boo', 'Your password login is wrong, make sure you have authority to change the password.');
            return redirect()->to('/user/' . $segment2 . '/' . $user_id)->withInput();
        else :
            if ($password == $newpassword) :
                session()->setFlashdata('boo', 'The given new password cannot be same as your current password!');
                return redirect()->to('/user/' . $segment2 . '/' . $user_id)->withInput();
            else :
                $password_hash = password_hash($newpassword, PASSWORD_DEFAULT);

                $save = $this->UserModel->save([
                    'user_id'       => $user_id,
                    'password'      => $password_hash
                ]);
            endif;
        endif;

        if ($save) :
            $activity   = 'reset password';
            $module_id  = $user_id;
            SaveActivityLog($module_id, $activity, NULL);

            session()->setFlashdata('yeah', 'The user password successfully updated.');
            return redirect()->to('/user/' . $segment2 . '/' . $user_id);
        else :
            session()->setFlashdata('boo', 'We’re having trouble updating this data.');
            return redirect()->to('/user/' . $segment2 . '/' . $user_id);
        endif;
    }

    public function accountsetting($user_id)
    {
        $data = [
            'title'         => 'Account Setting',
            'AppConf'       => $this->AppConfig->index(),
            'user'          => $this->UserModel->getUserById($user_id)->first(),
            'validation'    => \config\Services::validation(),
            'viewer'        => 'accountSetting'
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];
        return view('\Modules\Dashboard\Views\User', $data);
    }

    public function colorthemes($user_id)
    {
        $logo       = $this->request->getPost('logo');
        $navbar     = $this->request->getPost('navbar');
        $sidebar    = $this->request->getPost('sidebar');
        $background = $this->request->getPost('background');

        set_cookie(['name' => 'logo', 'value' => $logo, 'expire' => \time() + 3600]);
        set_cookie(['name' => 'navbar', 'value' => $navbar, 'expire' => \time() + 3600]);
        set_cookie(['name' => 'sidebar', 'value' => $sidebar, 'expire' => \time() + 3600]);
        set_cookie(['name' => 'background', 'value' => $background, 'expire' => \time() + 3600]);

        session()->setFlashdata('yeah', 'Data Changes, now you can rule the Matrix.');

        $data = [
            'title'         => 'Account Setting',
            'AppConf'       => $this->AppConfig->index(),
            'user'          => $this->UserModel->getUserById($user_id)->first(),
            'validation'    => \config\Services::validation(),
            'viewer'        => 'accountSetting'
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];
        return view('\Modules\Dashboard\Views\User', $data);
    }

    public function trash()
    {
        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;

        $keyword = $this->request->getVar('keyword');

        if ($keyword) :
            $searchdata = $this->UserModel->searchDeletedData($keyword);
        else :
            $searchdata = $this->UserModel->getDeletedData();
        endif;

        $data = [
            'title'         => 'User',
            'AppConf'       => $this->AppConfig->index(),
            'user'          => $searchdata->paginate(5, 'user'),
            'pager'         => $this->UserModel->pager,
            'currentPage'   => $currentPage,
            'viewer'        => 'trash'
        ];

        $data['css']            = [''];
        $data['js']             = [''];
        $data['NewJavaScript']  = [''];
        return view('\Modules\Dashboard\Views\User', $data);
    }

    public function restore($user_id)
    {
        $restore = $this->UserModel->set('deleted_at', null)->where('user_id', $user_id)->update();

        if ($restore) :
            $activity   = 'restore';
            $module_id  = $user_id;
            SaveActivityLog($module_id, $activity, NULL);

            session()->setFlashdata('yeah', 'Data successfully restored.');
            return redirect()->to('/user/trash');
        else :
            session()->setFlashdata('boo', 'We’re having trouble deleting this data.');
            return redirect()->to('/user/trash');
        endif;
    }

    public function hardDelete($user_id)
    {
        $user = $this->UserModel->getUserById($user_id)->onlyDeleted()->first();
        $data = $this->UserModel->onlyDeleted()->find($user_id);

        if ($data['avatar'] != 'default.jpg') :
            unlink('assets/images/avatar/' . $data['avatar']);
        endif;

        $delete = $this->UserModel->delete($user_id, true);

        if ($delete) :
            $activity   = 'permanent delete';
            $module_id  = $user_id;
            SaveActivityLog($module_id, $activity, $user);

            session()->setFlashdata('yeah', 'Data success full deleted.');
            return redirect()->to('/user/trash');
        else :
            session()->setFlashdata('boo', 'We’re having trouble deleting this data.');
            return redirect()->to('/user/trash');
        endif;
    }
}
