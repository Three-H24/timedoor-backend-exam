<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';

    protected $guarded = ['id'];

    public function books()
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
    }

    public function ratings()
    {
        return $this->hasManyThrough(
            Rating::class,
            Book::class,
            'author_id', // foreign key di books
            'book_id',   // foreign key di ratings
            'id',        // local key di authors
            'id'         // local key di books
        );
    }
}
