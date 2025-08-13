<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    protected $RatingModel;

    public function __construct()
    {
        $this->RatingModel = new Rating();
    }

    /**
     * function untuk menampilkan form menambah rating
     */
    public function index(Request $request)
    {
        // Ambil semua author
        $authors = Author::all();

        return view('content/rating-index', compact('authors'));
    }

    /**
     * function untuk menyimpan data ke rating
     */
    public function insert(Request $request)
    {
        // Validasi inputan ke database 
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'author_id' => 'required|exists:authors,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        $dt = new \DateTime();
        $createdAT = $dt->format('Y-m-d H:i:s');
        $updatedAT = $createdAT;

        $this->RatingModel->book_id = request('book_id');
        $this->RatingModel->author_id = request('author_id');
        $this->RatingModel->rating = request('rating');
        $this->RatingModel->created_at = $createdAT;
        $this->RatingModel->updated_at = $updatedAT;

        // Simpan data rating ke database
        $this->RatingModel->save();

        return redirect(route('books.index'))->with('Success', 'Rating berhasil ditambahkan');
    }

    /**
     * function yang akan di gunakan di ajax
     * untuk mengambil book berdasarkan author
     */
    public function getBookByAuthor(Request $request)
    {
        $authorIds = $request->author_id;

        if (!$authorIds) {
            return response()->json([]);
        }

        $book = Book::where('author_id', $authorIds)
            ->select('id', 'book_title')
            ->get();

        return response()->json($book);
    }
}
