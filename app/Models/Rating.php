<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rating extends Model
{
    protected $table = 'ratings';

    protected $guarded = ['id'];

    protected $fillable = ['book_id', 'author_id', 'rating'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
