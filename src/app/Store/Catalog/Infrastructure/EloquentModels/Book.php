<?php

namespace App\Store\Catalog\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    protected $table = 'books';

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
        );
    }
}
