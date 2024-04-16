<?php

namespace App\Controllers;

use App\Models\BorrowingModel;
use App\Models\BookModel;
use App\Models\UserModel;

use App\Controllers\BaseController;

class BorrowingController extends BaseController
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
        $borrowings = $this->borrowingModel->findAll();

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
        return view('borrowing/index', [
            'borrowings' => $borrowings,
        ]);
    }



    public function create()
    {
        return view('borrowing/add', [
            'validation' => $this->validation,
            'books' => $this->bookModel->findAll(),
            'users' => $this->userModel->where('role_id =', 3)->findAll(),
        ]);
    }

    public function store()
    {
        $this->validation->setRule('borrowing_date', 'Borrowing Date', 'required');
        $this->validation->setRule('user_id', 'Member', 'required');
        $this->validation->setRule('book_id', 'Book', 'required');

        if (!$this->validate($this->validation->getRules())) {
            return $this->create();
        } else {
            $bookIds = $this->request->getVar('book_id');
            $borrowingDate = $this->request->getVar('borrowing_date');

            foreach ($bookIds as $bookId) {
                // Prepare data to be stored
                $data = [
                    'user_id' => $this->request->getVar('user_id'),
                    'book_id' => $bookId,
                    'borrowing_date' => $borrowingDate,
                    'return_date' => null,
                    'is_return' => 0,
                ];

                // Update book stock
                $this->bookModel->where('book_id', $bookId)->set('book_stock', 'book_stock - 1', FALSE)->update();

                // Save borrowing data
                $this->borrowingModel->save($data);
            }

            // Redirect to borrowing page after successful storage
            return redirect()->to('/borrowing');
        }
    }

    public function update($id)
    {
        $borrowing = $this->borrowingModel->find($id);
        return view('borrowing/edit', [
            'borrowing' => $borrowing,
            'validation' => $this->validation,
        ]);
    }

    public function save($id)
    {
        if (!$this->request->getVar('cheklist')) {
            $this->validation->setRule('return_date', 'Return Date', 'required');
        } else {
            $this->validation->setRule('return_date', 'Return Date', 'permit_empty');
        }

        if (!$this->validate($this->validation->getRules())) {
            return $this->update($id);
        } else {
            $borrowing = $this->borrowingModel->find($id);

            // Set data sesuai dengan status checkbox
            $data = [
                'return_date' => (!$this->request->getVar('cheklist')) ? $this->request->getVar('return_date') : null,
                'is_return' => (!$this->request->getVar('cheklist')) ? 1 : 0
            ];

            // Perbarui stok buku berdasarkan status checkbox
            if (!$this->request->getVar('cheklist')) {
                $this->bookModel->where('book_id', $borrowing['book_id'])->set('book_stock', 'book_stock + 1', FALSE)->update();
            } else {
                $this->bookModel->where('book_id', $borrowing['book_id'])->set('book_stock', 'book_stock - 1', FALSE)->update();
            }

            // Perbarui data peminjaman
            $this->borrowingModel->update($id, $data);

            return redirect()->to('/borrowing');
        }
    }



    public function delete($id)
    {
        $borrowing = $this->borrowingModel->find($id);
        if ($borrowing['is_return'] == 0) {
            $this->bookModel->where('book_id', $borrowing['book_id'])->set('book_stock', 'book_stock + 1', FALSE)->update();
        }
        $this->borrowingModel->delete($id);
        return redirect()->to('/borrowing');
    }
}
