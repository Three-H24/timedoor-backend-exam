<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\View\View;

class ListOfBooksController extends Controller {

    protected $Book;

    public function __construct() {
        $this->Book = new Book();
    }
    public function index(): View  {

        // Ambil jumlah halaman dari dropdown (default 100)
        // $pages = (int) request()->get('pages', 100);

        $books = Book::all();

        return view('content/list-all-books', compact($books));
        
    }
}