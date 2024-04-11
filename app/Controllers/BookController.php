<?php

namespace App\Controllers;

use App\Models\BookModel;

use App\Controllers\BaseController;

class BookController extends BaseController
{
    protected $validation;
    protected $bookModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->bookModel = new BookModel();
    }

    public function index()
    {
        return view('book/index', [
            'books' => $this->bookModel->findAll(),
        ]);
    }

    public function create()
    {
        return view('book/add', [
            'validation' => $this->validation,
        ]);
    }

    public function store()
    {
        $this->validation->setRule('book_title', 'Book Title', 'required');
        $this->validation->setRule('book_author', 'Author', 'required');
        $this->validation->setRule('book_publisher', 'Publisher', 'required');
        $this->validation->setRule('book_publication_year', 'Publication Year', 'required');
        $this->validation->setRule('book_pages', 'Pages', 'required');
        $this->validation->setRule('book_stock', 'Stock', 'required');

        if (!$this->validate($this->validation->getRules())) {
            return $this->create();
        } else {
            $data = [
                'book_title' => $this->request->getVar('book_title'),
                'book_author' => $this->request->getVar('book_author'),
                'book_publisher' => $this->request->getVar('book_publisher'),
                'book_publication_year' => $this->request->getVar('book_publication_year'),
                'book_pages' => $this->request->getVar('book_pages'),
                'book_stock' => $this->request->getVar('book_stock'),
            ];

            $this->bookModel->save($data);
            return redirect()->to('/book');
        }
    }

    public function update($id)
    {
        $book = $this->bookModel->find($id);
        return view('book/edit', [
            'book' => $book,
            'validation' => $this->validation,
        ]);
    }

    public function save($id)
    {
        $this->validation->setRule('book_title', 'Book Title', 'required');
        $this->validation->setRule('book_author', 'Author', 'required');
        $this->validation->setRule('book_publisher', 'Publisher', 'required');
        $this->validation->setRule('book_publication_year', 'Publication Year', 'required');
        $this->validation->setRule('book_pages', 'Pages', 'required');
        $this->validation->setRule('book_stock', 'Stock', 'required');

        if (!$this->validate($this->validation->getRules())) {
            return $this->create();
        } else {
            $data = [
                'book_title' => $this->request->getVar('book_title'),
                'book_author' => $this->request->getVar('book_author'),
                'book_publisher' => $this->request->getVar('book_publisher'),
                'book_publication_year' => $this->request->getVar('book_publication_year'),
                'book_pages' => $this->request->getVar('book_pages'),
                'book_stock' => $this->request->getVar('book_stock'),
            ];

            $this->bookModel->update($id, $data);
            return redirect()->to('/book');
        }
    }

    public function delete($id)
    {
        $this->bookModel->delete($id);
        return redirect()->to('/book');
    }
}
