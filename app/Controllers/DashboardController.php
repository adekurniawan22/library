<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\UserModel;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $bookModel = new BookModel();
        $userModel = new UserModel();
        return view('dashboard/index', [
            'totalBooks' => $bookModel->countAllResults(),
            'totalUsers' => $userModel->countAllResults()
        ]);
    }
}
