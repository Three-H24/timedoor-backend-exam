<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $guarded = ['id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'book_id');
    }

}
