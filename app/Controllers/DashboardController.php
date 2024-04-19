<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\UserModel;

use App\Controllers\BaseController;
use App\Models\BorrowingModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $bookModel = new BookModel();
        $userModel = new UserModel();
        $borrowingModel = new BorrowingModel();
        date_default_timezone_set('Asia/Jakarta');

        return view('dashboard/index', [
            'totalBooks' => $bookModel->countAllResults(),
            'totalUsers' => (session()->get('role_id') == 2) ? $userModel->where('role_id', 3)->countAllResults() : $userModel->countAllResults(),
            'totalLoanPenalties' => $borrowingModel->where('borrowing_date <', date('Y-m-d'))->where("is_return",0)->countAllResults(),
        ]);
    }
}
