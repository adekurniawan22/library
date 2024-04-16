<?php

namespace App\Models;

use CodeIgniter\Model;

class BorrowingModel extends Model
{
    protected $table            = 'borrowing';
    protected $primaryKey       = 'borrowing_id';
    protected $allowedFields    = ['user_id', 'book_id', 'borrowing_date', 'return_date', 'is_return'];
}
