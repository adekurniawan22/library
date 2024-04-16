<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    protected $validation;
    protected $userModel;
    protected $roleModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
    }

    public function index()
    {
        if (session()->get('role_id') == 2) {
            return view('user/librarian/index', [
                'users' => $this->userModel->join('role', 'role.role_id = user.role_id')
                    ->select('user.*, role.role')
                    ->where('user.role_id = ', 3)
                    ->findAll(),
            ]);
        } else {
            return view('user/index', [
                'users' => $this->userModel->join('role', 'role.role_id = user.role_id')
                    ->select('user.*, role.role')
                    ->findAll(),
            ]);
        }
    }

    public function create()
    {
        if (session()->get('role_id') == 2) {
            return view('user/librarian/add', [
                'validation' => $this->validation,
            ]);
        } else {
            return view('user/add', [
                'validation' => $this->validation,
                'roles' => $this->roleModel->findAll()
            ]);
        }
    }

    public function store()
    {
        $this->validation->setRule('role_id', 'Role', 'required');
        $this->validation->setRule('email', 'Email', 'required');
        $this->validation->setRule('password', 'Password', 'required');
        $this->validation->setRule('full_name', 'Full Name', 'required');
        $this->validation->setRule('address', 'Address', 'required');
        $this->validation->setRule('mobile', 'Mobile', 'required');

        if (!$this->validate($this->validation->getRules())) {
            return $this->create();
        } else {
            $data = [
                'role_id' => (session()->get('role_id') == 2) ? 3 : $this->request->getVar('role_id'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'full_name' => $this->request->getVar('full_name'),
                'address' => $this->request->getVar('address'),
                'mobile' => $this->request->getVar('mobile'),
            ];

            $this->userModel->save($data);
            return redirect()->to('/user');
        }
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);
        if (session()->get('role_id') == 2) {
            return view('user/librarian/edit', [
                'user' => $user,
                'validation' => $this->validation,
            ]);
        } else {
            return view('user/edit', [
                'user' => $user,
                'roles' => $this->roleModel->findAll(),
                'validation' => $this->validation,
            ]);
        }
    }

    public function save($id)
    {
        $user = $this->userModel->find($id);
        $this->validation->setRule('role_id', 'Role', 'required');
        $this->validation->setRule('full_name', 'Full Name', 'required');
        $this->validation->setRule('address', 'Address', 'required');
        $this->validation->setRule('mobile', 'Mobile', 'required');

        if ($this->request->getVar('email') != $user['email']) {
            $this->validation->setRule('email', 'Email', 'required|valid_email|is_unique[user.email]');
        }

        if (!empty($this->request->getVar('password'))) {
            $this->validation->setRule('password', 'Password', 'required');
        }

        if (!$this->validate($this->validation->getRules())) {
            return $this->update($id);
        } else {
            $data = [
                'role_id' => $this->request->getVar('role_id'),
                'email' => $this->request->getVar('email'),
                'full_name' => $this->request->getVar('full_name'),
                'address' => $this->request->getVar('address'),
                'mobile' => $this->request->getVar('mobile'),
            ];

            if (!empty($this->request->getVar('password'))) {
                $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            }

            $this->userModel->update($id, $data);
            return redirect()->to('/user');
        }
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/user');
    }
}
