<?php

namespace App\Store\Catalog\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Book extends Model
{
    use HasUuids;

    protected $table = 'books';
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'isbn',
        'title',
        'description',
        'pages',
        'publish_date',
        'quantity'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(
            Author::class,
            'authors_books',
            'book_uuid',
            'author_uuid'
        )->using(BooksAuthor::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(
            Genre::class,
            'book_genre',
            'book_uuid',
            'genre_uuid'
        )->using(BooksGenres::class);
    }
}
