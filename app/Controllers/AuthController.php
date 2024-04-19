<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $validation;
    protected $session;
    protected $userModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = session();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('auth/login');
    }

    public function login_action()
    {
        $this->validation->setRule('email', 'Email', 'required|valid_email');
        $this->validation->setRule('password', 'Password', 'required|min_length[8]');

        if (!$this->validate($this->validation->getRules())) {
            return $this->index();
        } else {
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $user = $this->userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                $user_data = [
                    'full_name' => $user['full_name'],
                    'user_id' => $user['user_id'],
                    'email' => $user['email'],
                    'role_id' => $user['role_id'],
                ];
                session()->set($user_data);

                switch ($user['role_id']) {
                    case 1:
                        session()->setFlashdata('success', 'Welcome back to dashboard, ' . $user["full_name"]);
                        return redirect()->to('dashboard');
                    case 2:
                        session()->setFlashdata('success', 'Welcome back to dashboard, ' . $user["full_name"]);
                        return redirect()->to('dashboard');
                    case 3:
                        session()->setFlashdata('success', 'Welcome Back, ' . $user["full_name"]);
                        return redirect()->to('book');
                    default:
                        return redirect()->to('/');
                }
            } else {
                session()->setFlashdata('error', 'Wrong email or password!');
                return $this->index();
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
