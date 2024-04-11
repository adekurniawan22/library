<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table            = 'book';
    protected $primaryKey       = 'book_id';
    protected $allowedFields    = ['book_title', 'book_author', 'book_publisher', 'book_publication_year', 'book_pages', 'book_stock'];
}
