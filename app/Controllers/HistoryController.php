<?php

namespace App\Controllers;

use App\Models\BorrowingModel;
use App\Models\BookModel;
use App\Models\UserModel;

use App\Controllers\BaseController;

class HistoryController extends BaseController
{
    protected $validation;
    protected $bookModel;
    protected $borrowingModel;
    protected $userModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->bookModel = new BookModel();
        $this->borrowingModel = new BorrowingModel();
        $this->userModel = new UserModel();
        helper(['number']);
    }

    public function index()
    {
        // Set zona waktu ke Indonesia
        date_default_timezone_set('Asia/Jakarta');

        // Ambil semua data peminjaman
        $borrowings = $this->borrowingModel->where('user_id = ', session()->get('user_id'))->findAll();

        // Hitung nilai denda untuk setiap peminjaman berdasarkan tanggal borrowing_date
        foreach ($borrowings as &$borrowing) {
            // Ambil tanggal peminjaman
            $borrowingDate = strtotime($borrowing['borrowing_date']);

            // Hitung selisih waktu dengan hari ini dalam detik
            $timeDiff = time() - $borrowingDate;

            // Hitung selisih waktu dalam hari
            $daysDiff = floor($timeDiff / (24 * 60 * 60));
            // dd($daysDiff);

            // Jika melebihi 2 minggu, atur denda
            if ($daysDiff > 14) {
                $daysLate = $daysDiff - 13; // Hitung hari terlambat setelah 2 minggu
                $penalty = $daysLate * 100; // Hitung denda per hari (misalnya, 100 per hari)

                $borrowing['penalty'] = $penalty; // Set nilai denda
            } else {
                $borrowing['penalty'] = 0; // Tidak ada denda jika tidak terlambat
            }
        }

        // Kirim data peminjaman beserta nilai denda ke view
        return view('history/index', [
            'borrowings' => $borrowings,
        ]);
    }
}
