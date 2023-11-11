<?php

namespace App\Store\Catalog\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BooksAuthor extends Pivot
{
    use HasUuids;

    protected $table = 'authors_books';
    protected $primaryKey = 'uuid';
}
