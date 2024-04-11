<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login_action()
    {
        echo "<pre>";
        echo var_dump($_POST);
        echo "<pre>";
    }
}
