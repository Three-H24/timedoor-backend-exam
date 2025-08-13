<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\View\View;

class AuthorController extends Controller
{
    protected $Authors;

    public function __construct()
    {
        $this->Authors = new Author();
    }

    public function index(): View
    {
        $authors = $this->Authors->withCount('ratings')
            ->havingRaw('ratings_count > ?', [5])
            ->orderByDesc('ratings_count')
            ->limit(10)
            ->get();

        return view('content/famous-author', compact('authors'));
    }
}
