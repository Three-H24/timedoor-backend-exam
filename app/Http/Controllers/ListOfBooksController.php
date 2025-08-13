<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\View\View;

class ListOfBooksController extends Controller
{

    protected $Book;

    public function __construct()
    {
        $this->Book = new Book();
    }
    public function index(): View
    {

        // Ambil jumlah halaman dari dropdown (default 100)
        $pages = (int) request()->get('per_page', 100);
        $search = request()->input('search');

        $books = $this->Book->with(['author', 'category'])
            ->withAvg('ratings', 'rating')   // hitung rata-rata rating
            ->withCount('ratings')           // hitung jumlah voters (ratings_count)
            // Filter Search kalau ada
            ->when($search, function ($query, $search) {
                $query->where('book_title', 'like', "%{$search}%")
                    ->orWhereHas('author', function ($q) use ($search) {
                        $q->where('author_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('category', 'like', "%{$search}%");
                    });
            })
            ->paginate($pages);

        return view('content/list-all-books', compact('books', 'pages', 'search'));
    }
}
