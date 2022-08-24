<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use Modules\Dashboard\Controllers\AppConfig;

use Modules\Dashboard\Models\UserModel;

class Auth extends BaseController
{
    protected $UserModel;

    public function __construct()
    {
        $this->AppConfig = new AppConfig();
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        if (session()->email) :
            return redirect()->to('/');
        endif;

        $appConfig = $this->AppConfig->index();

        $data = [
            'title'      => 'Login',
            'AppConf'    => $appConfig,
            'validation' => \config\Services::validation(),
            'viewer'     => '',
        ];

        return view('\Modules\Dashboard\Views\Layout\\' . ucfirst($appConfig['template']) . '_auth', $data);
    }

    public function loging()
    {
        $rules = [
            'account'     => [
                'rules'     => 'required',
                'errors'    => []
            ],
            'password'  => 'required',
        ];

        if (!$this->validate($rules)) :
            return redirect()->to('/auth/login')->withInput();
        else :
            $email      = htmlspecialchars($this->request->getVar('account'));
            $username   = htmlspecialchars($this->request->getVar('account'));
            $password   = htmlspecialchars($this->request->getVar('password'));

            $user = $this->UserModel->select('user.*, role.role')->join('role', 'role.role_id = user.role_id', 'left')->where(['user.email' => $email])->orWhere('user.username', $username)->first();

            if ($user) :
                if ($user['is_active'] == 1) :
                    if (password_verify($password, $user['password'])) :
                        $data = [
                            'user_id'   => $user['user_id'],
                            'name'      => $user['name'],
                            'username'  => $user['username'],
                            'role'      => $user['role'],
                            'avatar'    => $user['avatar'],
                            'email'     => $user['email'],
                            'role_id'   => $user['role_id']
                        ];
                        session()->set($data);
                        return redirect()->to('/dashboard');
                    else :
                        session()->setFlashdata('boo', 'The entered password not match with your account!');
                        return redirect()->to('/auth/login')->withInput();
                    endif;
                else :
                    session()->setFlashdata('boo', 'This account has been not activited!');
                    return redirect()->to('/auth/login')->withInput();
                endif;
            else :
                session()->setFlashdata('boo', 'This account is not registered!');
                return redirect()->to('/auth/login')->withInput();
            endif;
        endif;
    }

    public function logout()
    {
        session()->remove('user_id');
        session()->remove('name');
        session()->remove('username');
        session()->remove('role');
        session()->remove('avatar');
        session()->remove('email');
        session()->remove('role_id');
        session()->setFlashdata('yeah', 'You has been logged out. Your session already ended.');
        return redirect()->to('/auth/login');
    }

    public function registration()
    {
        if (session()->email) :
            return redirect()->to('/');
        endif;

        $appConfig = $this->AppConfig->index();

        if ($appConfig['isSignUp'] == 'FALSE') :
            return redirect()->to('/forbidden');
        endif;

        if (count($this->request->getPost()) <= 0) :

            $data = [
                'title'      => 'Registration',
                'AppConf'    => $appConfig,
                'validation' => \config\Services::validation(),
                'viewer'     => 'registration',
            ];

            return view('\Modules\Dashboard\Views\Layout\\' . ucfirst($appConfig['template']) . '_auth', $data);

        else :
            $appConfig  = $this->AppConfig->index();
            $db         = \Config\Database::connect();

            $rules = [
                'agree'      => [
                    'rules'     => 'required',
                    'errors'    => []
                ],
                'name'      => [
                    'rules'     => 'required|alpha_space|min_length[2]',
                    'errors'    => []
                ],
                'username'     => [
                    'rules'     => 'required|is_unique[user.username]',
                    'errors'    => [
                        'is_unique'  => 'The username field must contain a unique value, the username has taken.'
                    ]
                ],
                'email'     => [
                    'rules'     => 'required|valid_email|is_unique[user.email]',
                    'errors'    => []
                ],
                'password'  => 'required|min_length[6]',
                'repeat'    => 'required|matches[password]'
            ];

            if (!$this->validate($rules)) :
                return redirect()->to('/auth/registration')->withInput();
            endif;

            $save = $this->UserModel->save([
                'name'      => htmlspecialchars($this->request->getVar('name')),
                'username'  => htmlspecialchars($this->request->getVar('username')),
                'email'     => htmlspecialchars($this->request->getVar('email')),
                'password'  => htmlspecialchars(password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)),
                'avatar'    => 'default.jpg',
                'role_id'   => $appConfig['newRegistrationRoleId'],
                'is_active' => '0'
            ]);

            $token = base64_encode(random_bytes(32));
            $db->table('token_email')->insert([
                'email'     => htmlspecialchars($this->request->getVar('email')),
                'token'     => $token
            ]);

            $this->_sendEmail($token, 'verify');

            if ($save) :
                session()->setFlashdata('yeah', 'Congratulation! Your account has been created, Please check your email to verify!');
                return redirect()->to('/auth');
            else :
                session()->setFlashdata('boo', 'Ouch! something wrong. Try contact to your administrator');
                return redirect()->to('/auth');
            endif;
        endif;
    }

    public function forgotPassword()
    {
        $appConfig = $this->AppConfig->index();

        if ($appConfig['isForgotPassword'] == 'FALSE') :
            return redirect()->to('/forbidden');
        endif;

        if (count($this->request->getPost()) <= 0) :


            $data = [
                'title'      => 'Forgot Password',
                'AppConf'    => $appConfig,
                'validation' => \config\Services::validation(),
                'viewer'     => 'forgot',
            ];

            return view('\Modules\Dashboard\Views\Layout\\' . ucfirst($appConfig['template']) . '_auth', $data);

        else :

            $rules = [
                'email'     => [
                    'rules'     => 'required|valid_email',
                    'errors'    => []
                ]
            ];

            if (!$this->validate($rules)) :
                return redirect()->to('/auth/forgotpassword')->withInput();
            else :
                $email      = htmlspecialchars($this->request->getVar('email'));
                $db         = \Config\Database::connect();

                $user = $this->UserModel->where(['email' => $email, 'is_active' => 1])->first();
                if ($user) :

                    $token = base64_encode(random_bytes(32));
                    $db->table('token_email')->insert([
                        'email'     => htmlspecialchars($this->request->getVar('email')),
                        'token'     => $token
                    ]);

                    $this->_sendEmail($token, 'forgot');

                    session()->setFlashdata('yeah', 'Please check your email to reset your password.');
                    return redirect()->to('/auth');
                else :
                    session()->setFlashdata('boo', 'This Email is not registered or activated!');
                    return redirect()->to('/auth/forgotpassword')->withInput();
                endif;
            endif;
        endif;
    }

    private function _sendEmail($token, $type)
    {
        $appConfig = $this->AppConfig->index();

        $config = [
            'protocol'      => $appConfig['protocol'],
            'SMTPHost'      => $appConfig['SMTPHost'],
            'SMTPUser'      => $appConfig['SMTPUser'],
            'SMTPPass'      => $appConfig['SMTPPass'],
            'SMTPPort'      => intval($appConfig['SMTPPort']),
            'SMTPCrypto'    => $appConfig['SMTPCrypto'],
            'mailType'      => $appConfig['mailType'],
            'charset'       => $appConfig['charset'],
            'newline'       => "\r\n",
            'crlf'          => "\r\n"
        ];

        $email = \Config\Services::email();
        $email->initialize($config);

        $email->setFrom($appConfig['mailAlias'], $appConfig['mailName']);
        $email->setTo(htmlspecialchars($this->request->getVar('email')));

        if ($type == 'verify') :
            $email->setSubject('Account Verification');
            $email->setMessage('Click this link to verify your account : <a href="' . base_url() . '/auth/verify?email=' . htmlspecialchars($this->request->getVar('email')) . '&token=' . urlencode($token) . '">Activate</a>');
        elseif ($type == 'forgot') :
            $email->setSubject('Reset Password');
            $email->setMessage('Click this link to reset your password : <a href="' . base_url() . '/auth/reset?email=' . htmlspecialchars($this->request->getVar('email')) . '&token=' . urlencode($token) . '">Reset Password</a>');
        endif;


        if ($email->send()) :
            return true;
        else :
            echo $email->printDebugger();
            die;
        endif;
    }

    public function verify()
    {
        $email = htmlspecialchars($this->request->getVar('email'));
        $token = htmlspecialchars($this->request->getVar('token'));
        $db    = \Config\Database::connect();

        $user = $this->UserModel->where(['email' => $email])->first();

        if ($user) :
            $emailToken = $db->table('token_email')->where(['token' => $token])->get()->getResultArray();
            if ($emailToken) :
                if (time() - strtotime($emailToken['created_at']) < 60 * 60 * 1) :
                    $this->UserModel->set('is_active', 1)->where('email', $email)->update();
                    $db->table('token_email')->where('email', $email)->delete();

                    session()->setFlashdata('yeah', 'Account activation success. Email ' . $email . ' has been activated, please login!');
                    return redirect()->to('/auth/login');
                else :
                    $this->UserModel->where('email', $email)->delete();
                    $db->table('token_email')->where('email', $email)->delete();

                    session()->setFlashdata('boo', 'Account activation failed! Token Expired.');
                    return redirect()->to('/auth/login');
                endif;
            else :
                session()->setFlashdata('boo', 'Account activation failed! Token invalid.');
                return redirect()->to('/auth/login');
            endif;
        else :
            session()->setFlashdata('boo', 'Account activation failed! Wrong Email.');
            return redirect()->to('/auth/login');
        endif;
    }

    public function reset()
    {
        $email = htmlspecialchars($this->request->getVar('email'));
        $token = htmlspecialchars($this->request->getVar('token'));
        $db    = \Config\Database::connect();

        $user = $this->UserModel->where(['email' => $email])->first();

        if ($user) :
            $emailToken = $db->table('token_email')->where(['token' => $token])->get()->getResultArray();
            if ($emailToken) :
                if (time() - strtotime($emailToken['created_at']) < 60 * 60 * 1) :
                    session()->set(['reset_email' => $email]);
                    return redirect()->to('/auth/changepassword');
                else :
                    $db->table('token_email')->where('email', $email)->delete();

                    session()->setFlashdata('boo', 'Reset password failed! Token Expired.');
                    return redirect()->to('/auth/forgotpassword');
                endif;
            else :
                session()->setFlashdata('boo', 'Reset password failed! Token invalid.');
                return redirect()->to('/auth/forgotpassword');
            endif;
        else :
            session()->setFlashdata('boo', 'Reset password failed! Wrong Email.');
            return redirect()->to('/auth/forgotpassword');
        endif;
    }

    public function changePassword()
    {
        if (!session()->reset_email) :
            session()->setFlashdata('boo', 'Ouch! its seems you want to change your password. Lets reset it from your email first');
            return redirect()->to('/auth/forgotpassword');
        endif;

        if (count($this->request->getPost()) <= 0) :

            $appConfig = $this->AppConfig->index();

            $data = [
                'title'      => 'Reset Password',
                'AppConf'    => $appConfig,
                'validation' => \config\Services::validation(),
                'viewer'     => 'reset',
            ];

            return view('\Modules\Dashboard\Views\Layout\\' . ucfirst($appConfig['template']) . '_auth', $data);

        else :
            $db    = \Config\Database::connect();
            $rules = [
                'password'  => 'required|min_length[6]',
                'repeat'  => 'required|matches[password]'
            ];

            if (!$this->validate($rules)) :
                return redirect()->to('/auth/changepassword')->withInput();
            endif;

            $password   = htmlspecialchars(password_hash($this->request->getVar('password'), PASSWORD_DEFAULT));
            $email      = session()->reset_email;

            $reset = $this->UserModel->set('password', $password)->where('email', $email)->update();

            session()->remove('reset_email');

            if ($reset) :
                $db->table('token_email')->where('email', $email)->delete();
                session()->setFlashdata('yeah', 'Congratulation! Your password has been reseted, Please login!');
                return redirect()->to('/auth/login');
            else :
                session()->setFlashdata('boo', 'Ouch! something wrong. Try contact to your administrator');
                return redirect()->to('/auth/login');
            endif;
        endif;
    }
}
